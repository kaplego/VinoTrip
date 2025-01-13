<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\Role;
use App\Models\Categorieparticipant;
use App\Models\Categoriesejour;
use App\Models\Categorievignoble;
use App\Models\Cave;
use App\Models\Descriptioncommande;
use App\Models\Photo;
use App\Models\VDescriptioncommande;
use App\Models\Duree;
use App\Models\Etape;
use App\Models\Hebergement;
use App\Models\Hotel;
use App\Models\Sejour;
use App\Models\Localite;
use App\Models\Theme;
use Cookie;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use DB;

use App\Models\Visite;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class SejourController extends Controller
{
    public function list()
    {
        return view('sejours.list', [
            'sejours' => Sejour::orderBy('idsejour')->where('publie', '=', true)->get(),
            'categoriesejour' => Categoriesejour::all(),
            'categorieparticipant' => Categorieparticipant::all(),
            'categoriesvignoble' => Categorievignoble::all(),
            'localites' => Localite::all(),
            'durees' => Duree::all(),

        ]);
    }

    public function one($id)
    {
        $sejour = Sejour::find($id);

        if ($sejour == null)
            return redirect('/sejours');

        if (!$sejour->publie && !Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect('/sejours');

        $history = explode(',', Cookie::get('sejours_history'));
        if ($sejour->publie) {
            if ($history[0] === '')
                $history = [];

            $history = array_filter($history, function ($item) use ($sejour) {
                return $item !== (string) $sejour->idsejour;
            });

            $history[] = (string) $sejour->idsejour;
            $history = array_slice($history, 0, 5);
        }
        Cookie::queue(Cookie::make(
            'sejours_history',
            implode(',', $history),
            60 * 24
        ));

        return view('sejours.summary', [
            'sejour' => $sejour,
            'hebergement' => Hebergement::all(),
            'visite' => Visite::all(),
            'hotel' => Hotel::all(),
            'cave' => Cave::all(),
            'history' => Sejour::whereIn('idsejour', array_slice($history, 0, -1))->get()->reverse(),
            'sejouraime' => Sejour::where('idcategorievignoble', '=', $sejour->idcategorievignoble)
                ->where('idsejour', '!=', $sejour->idsejour)
                ->where('idcategoriesejour', '=', $sejour->idcategoriesejour)
                ->limit(4)
                ->get(),
        ]);
    }

    public function edit($id)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect("/sejour/$id");

        $sejour = Sejour::find($id);

        if ($sejour == null)
            return redirect('/sejours');

        return view('sejours.summary', [
            'sejour' => $sejour,
            'hebergement' => Hebergement::all(),
            'visite' => Visite::all(),
            'hotel' => Hotel::all(),
            'cave' => Cave::all(),
            'editing' => true
        ]);
    }

    public function apitogglehebergement(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect('/');

        $iddescriptioncommande = $request->input('iddescriptioncommande');
        $newidhebergement = $request->input('newidhebergement');

        $descriptioncommande = Descriptioncommande::find($iddescriptioncommande);
        $titrehotelancien = $descriptioncommande->hebergement->hotel->nompartenaire;
        $descriptioncommande->idhebergement = $newidhebergement;
        $descriptioncommande->disponibilitehebergement = false;
        $descriptioncommande->update();


        // $iddescrcommande= $request->input("unedescription");
        // $descrcommande = Descriptioncommande::find( $iddescrcommande);
        // $descrcommande->disponibilitehebergement = false;
        // $descrcommande->update();

        $titrehotelnouveau = $descriptioncommande->hebergement->hotel->nompartenaire;
        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'PbHeberg',
            'titrehotelancien' => $titrehotelancien,
            'titrehotelnouveau' => $titrehotelnouveau,

        ], "Équipe vinotrip changement d'hebergement "));

        return redirect("/reservation");

    }
    public function choixhebergement(Request $request, $id)
    {
        $iddescription = $request->input('iddescriptioncomande');
        $idhebergement = $request->input('idhebergement');

        $sejour = Sejour::find($id);

        if (!$idhebergement || !$sejour || ($iddescription && !Descriptioncommande::where('idsejour', '=', $id)->find($iddescription)))
            return back();

        return view("sejours.edit-list-hebergement", [
            'sejour' => $sejour,
            'hebergements' => Hebergement::all(),
            'iddescriptioncommande' => $request->input('iddescriptioncommande'),
            'idhebergement' => $idhebergement,
        ]);
    }

    public function createview()
    {
        if (!Helpers::AuthIsRole(Role::Dirigeant))
            return redirect('/connexion');

        $placeholder = Sejour::inRandomOrder()->first();

        return view('sejours.create', [
            'placeholder' => $placeholder,
            'hebergements' => Hebergement::all(),
            'categoriesparticipant' => Categorieparticipant::all(),
            'categoriessejour' => Categoriesejour::all(),
            'themes' => Theme::all(),
            'durees' => Duree::all(),
            'vignobles' => Categorievignoble::all(),
            'localites' => Localite::all()
        ]);
    }

    public function create(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::Dirigeant))
            return response(null, 401);

        $hebergements = Hebergement::all()->pluck('idhebergement')->toArray();
        $categoriesparticipant = Categorieparticipant::all()->pluck('idcategorieparticipant')->toArray();
        $categoriessejour = Categoriesejour::all()->pluck('idcategoriesejour')->toArray();
        $themes = Theme::all()->pluck('idtheme')->toArray();
        $durees = Duree::all()->pluck('idduree')->toArray();
        $vignobles = Categorievignoble::all()->pluck('idcategorievignoble')->toArray();

        $inputs = $request->validate([
            'titre' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:4096'],
            'price' => ['nullable', 'numeric', 'between:0,999999.99'],
            'categorie-participant' => ['required', Rule::in($categoriesparticipant)],
            'categorie-sejour' => ['required', Rule::in($categoriessejour)],
            'theme' => ['required', Rule::in($themes)],
            'duree' => ['required', Rule::in($durees)],
            'vignoble' => ['required', Rule::in($vignobles)],
            'photo' => ['nullable', 'file', 'image', 'max:1024'],
            'etapes' => ['array'],
            'etapes.*.titre' => ['required', 'string'],
            'etapes.*.description' => ['required', 'string'],
            'etapes.*.image' => ['required', 'file', 'image', 'max:1024'],
            'etapes.*.hebergement' => ['required', Rule::in($hebergements)],
        ], [
            'photo.max' => 'La photo doit avoir un poids de maximum 1 Mo.',
            'etapes.*.titre' => "Le titre de l'étape est requis.",
            'etapes.*.description' => "La description de l'étape est requise.",
            'etapes.*.image.required' => "La photo de l'étape est requise.",
            'etapes.*.image.max' => "La photo doit avoir un poids de maximum 1 Mo.",
        ]);

        $localites = Localite::where('idcategorievignoble', '=', $request->input('vignoble'))->pluck('idlocalite')->toArray();

        $inputs = array_merge(
            $inputs,
            $request->validate([
                'localite' => [
                    Rule::requiredIf(sizeof($localites) >= 0),
                    Rule::in(['null', ...$localites])
                ]
            ])
        );

        $sejour = Sejour::create([
            'titresejour' => $inputs['titre'] ?? '',
            'photosejour' => $inputs['photo-link'] ?? '',
            'descriptionsejour' => $inputs['description'] ?? '',
            'idcategoriesejour' => $inputs['categorie-sejour'],
            'idduree' => $inputs['duree'],
            'idtheme' => $inputs['theme'],
            'idcategorievignoble' => $inputs['vignoble'],
            'idcategorieparticipant' => $inputs['categorie-participant'],
            'idlocalite' => $request->input('localite') === 'null' ? null : $request->input('localite'),
            'prixsejour' => $inputs['price'] ?? 0
        ]);

        $file = $request->file('photo');
        if ($file) {
            $filename = "sejour$sejour->idsejour." . $file->extension();

            if (Helpers::Upload($file, $filename, 'sejour')) {
                $sejour->update(['photosejour' => $filename]);
            } else
                return back()->withErrors([
                    'photo' => "Une erreur s'est produite."
                ]);
        }

        foreach ($inputs['etapes'] as $k => $etape) {
            $etapebd = Etape::create([
                'idhebergement' => $etape['hebergement'],
                'idsejour' => $sejour->idsejour,
                'titreetape' => $etape['titre'],
                'descriptionetape' => $etape['description'],
                'photoetape' => '',
                'urletape' => '',
                'videoetape' => ''
            ]);

            $file = $etape['image'];

            $filename = "etape$etapebd->idetape." . $file->extension();

            if (Helpers::Upload($file, $filename, 'etape')) {
                $etapebd->update(['photoetape' => $filename]);
            } else
                return back()->withErrors([
                    "etape.$k.image" => "Une erreur s'est produite."
                ]);
        }

        return redirect("/sejour/$sejour->idsejour");
    }
    public function updatephoto(Request $request, $idsejour)
    {
        $inputs = $request->validate([
            'photo-upload' => ['required', 'file', 'image', 'max:1024'],
        ], [
            'photo-upload.max' => 'La photo doit avoir un poids de maximum 1 Mo.',
        ]);

        $sejour = Sejour::find($idsejour);

        $photo = Photo::create([
            'photo' => '',
            'idsejour' => $sejour->idsejour
        ]);

        $file = $request->file('photo-upload');
        $filename = "sejour$sejour->idsejour-$photo->idphoto." . $file->extension();

        if (Helpers::Upload($file, $filename, 'sejour')) {
            $photo->update(['photo' => $filename]);
        } else
            return back()->withErrors([
                'photo-upload' => "Une erreur s'est produite."
            ]);

        return redirect("/sejour/$sejour->idsejour");
    }

    public function update(Request $request, $idsejour)
    {
        $inputs = $request->validate([
            'titre' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:4096'],
            'prix' => ['nullable', 'numeric', 'between:0,999999.99']
        ], [
            'photo-upload.max' => 'La photo doit avoir un poids de maximum 1 Mo.',
        ]);

        $sejour = Sejour::find($idsejour);

        $sejour->update([
            'titresejour' => $inputs['titre'] ?? '',
            'descriptionsejour' => $inputs['description'] ?? '',
            'prixsejour' => $inputs['prix'] ?? 0
        ]);

        return back();
    }

    public function validateview()
    {
        if (!Helpers::AuthIsRole(Role::Dirigeant) && !Helpers::AuthIsRole(Role::ServiceVente))
            return redirect('/connexion');

        return view('sejours.validate', [
            'sejours' => Sejour::orderBy('idsejour')->where('publie', '=', false)->get()
        ]);
    }

    public function publier($id)
    {
        if (!Helpers::AuthIsRole(Role::Dirigeant))
            return redirect('/connexion');

        $sejour = Sejour::find($id);
        $sejour->update([
            'publie' => true
        ]);

        return back();
    }

    public function discount(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return redirect('/connexion');

        $sejour = Sejour::find($request->input('idsejour'));

        if (!$sejour)
            return redirect('/connexion');

        $request->validate([
            'nouveauprixsejour' => ['nullable', 'numeric', 'min:0', "max:$sejour->prixsejour"]
        ]);

        $sejour->nouveauprixsejour = $request->input('nouveauprixsejour') == $sejour->prixsejour
            ? null
            : $request->request->get('nouveauprixsejour');
        $sejour->update();

        return back();
    }
    public function editing(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente)) {
            return redirect('/connexion');
        }

        return view('sejours.editing', [
            'sejours' => Sejour::where('publie', false)
                ->orderBy('idsejour')
                ->get()
        ]);
    }


    public function mailpossibilite(Request $request)
    {
        $credentials = $request->validate(['idsejour' => ['required']]);

        $sejour = Sejour::find($credentials['idsejour']);

        foreach($sejour->etape as $etape){
                Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
                    'type' => 'PossibiliteHebergement',
                    'nomhotel' => $etape->hebergement->hotel->nompartenaire
                ], "Équipe vinotrip changement d'hebergement "));

            }



        return back()->with('success', 'Les hébergements ont bien été contactés.');
    }
}
