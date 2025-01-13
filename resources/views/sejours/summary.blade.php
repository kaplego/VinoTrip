@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', $sejour->titresejour . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours/summary.css">
    <meta name="description" content="{{ $sejour->descriptionsejour }}">
    <meta property="twitter:card" content="https://vinotrip.lmgt.me/storage/sejour/{{ $sejour->photosejour }}">
    <meta property="og:image" content="https://vinotrip.lmgt.me/storage/sejour/{{ $sejour->photosejour }}">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1;
        $cpt = 0;
    @endphp
    <main class="container">
        @php
            $breadcrumReplaceLink = ['/sejour' => '/sejours'];
            $breadcrumReplaceName = ['/sejour' => 'Sejours', "/sejour/$sejour->idsejour" => $sejour->titresejour];
        @endphp
        @include('layout.breadcrumb')

        @isset($editing)
            <div class="alert alert-warning">
                <i data-lucide="pencil-ruler"></i>
                <span class="text">Vous êtes en train de modifier ce séjour.</span>
                <a class="button" href="/sejour/{{ $sejour->idsejour }}">Quitter le mode d'édition</a>
            </div>
        @endisset

        @if (!$sejour->publie)
            <form class="alert alert-warning" action="/api/sejour/{{ $sejour->idsejour }}/publish" method="POST">
                @csrf
                <i data-lucide="lock"></i>
                <span class="text">Le séjour n'est pas encore publié.</span>
                <button class="button" type="submit">Publier le séjour</button>
            </form>
        @endif

        @error('avis')
            <div class="alert alert-danger">
                <i data-lucide="ban"></i>
                <span class="text">{{ $message }}</span>
            </div>
        @enderror

        <section id="sejour">
            <div id="photo">
                <img src="/storage/sejour/{{ $sejour->photosejour }}" />
                @foreach ($sejour?->photos as $photo)
                    <img src="/storage/sejour/{{ $photo->photo }}" />
                @endforeach
                @isset($editing)
                    <form action="/api/sejour/{{ $sejour->idsejour }}/update/photo" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-control input-control-image">
                            <div class="image">
                                <img src="">
                                <div class="hover"></div>
                            </div>
                            <div class="input-container">
                                <input id="photo-upload" type="file" name="photo-upload" value="{{ old('photo-upload') }}"
                                    accept="image/png, image/jpeg" autocomplete="off" />
                                <button class="button" disabled type="button" id="photo-upload-remove"><i
                                        data-lucide="image-off"></i></button>
                            </div>
                            @error('photo-upload')
                                <p class="alert alert-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="button" type="submit">Valider les modifications</button>
                    </form>
                @endisset
            </div>
            @isset($editing)
                <form id="description" action="/api/sejour/{{ $sejour->idsejour }}/update" method="POST">
                    <input name="titre" class="title input-control-inline" placeholder="Titre"
                        value="{{ $sejour->titresejour }}" />
                    <hr>
                    <h4 class="prix">À partir de <span class="euros"><input name="prix" class="input-control-inline"
                                type="number" placeholder="Prix" value="{{ $sejour->prixsejour }}" /> € /
                            personne</span></h4>
                    <div class="input-control input-control-text input-control-full">
                        <textarea name="description" class="description" placeholder="Description du séjour...">{{ $sejour->descriptionsejour }}</textarea>
                    </div>
                @else
                    <div id="description">
                        <h1 class="title">{{ $sejour->titresejour }}</h1>
                        <hr>
                        @if (isset($sejour->nouveauprixsejour))
                            <h4 class="prix" style="text-decoration-line: line-through;">À partir de <span
                                    class="euros">{{ $sejour->prixsejour }}€ /
                                    personne</span></h4>
                            <h4 class="prix" style="color: red; text-decoration-line:underline;">À partir de
                                {{ $sejour->nouveauprixsejour }}€ / personne</br>
                                Profitez de
                                {{ round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 1) }}%
                                de réduction !
                            </h4>
                        @else
                            <h4 class="prix">À partir de <span class="euros">{{ $sejour->prixsejour }}€ / personne</span>
                            </h4>
                        @endif
                        <p class="description">{{ $sejour->descriptionsejour }}</p>
                    @endisset
                    <div id="categories">
                        <p>{{ $sejour->categorievignoble->libellecategorievignoble }}</p>
                        <p>{{ $sejour->duree->libelleduree }}</p>
                        <p>{{ $sejour->categoriesejour->libellecategoriesejour }}</p>
                        <p>{{ $sejour->theme->libelletheme }}</p>
                    </div>
                    <div class="buttons buttons-advanced">
                        @if ($sejour->publie)
                            <a class="button" href="/personnaliser/{{ $sejour->idsejour }}">
                                <i data-lucide="shopping-basket"></i>
                                <span class="text">Personnaliser ou offrir</span>
                            </a>

                            @if (Auth::check())
                                <button class="button" href="/sejours/{{ $sejour->idsejour }}/avis" id="ecrire-avis">
                                    <i data-lucide="message-square-quote"></i>
                                    <span class="text">Écrire un avis</span>
                                </button>
                            @endif

                            @if (Auth::check())
                                @if (Auth::user()->favoris->contains($sejour))
                                    <form method="post" action="/api/client/favoris/delete">
                                        @csrf
                                        <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                                        <button class="button" type="submit">
                                            <i data-lucide="heart-off"></i>
                                            <span class="text">Retirer des favoris</span>
                                        </button>
                                    </form>
                                @else
                                    <form method="post" action="/api/client/favoris/add">
                                        @csrf
                                        <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                                        <button class="button" type="submit">
                                            <i data-lucide="heart"></i>
                                            <span class="text">Ajouter aux favoris</span>
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endif

                        @if (Helpers::AuthIsRole(Role::ServiceVente) || Helpers::AuthIsRole(Role::Dirigeant))
                            @isset($editing)
                                <button class="button" type="submit">
                                    <i data-lucide="save"></i>
                                    <span class="text">Sauvegarder</span>
                                </button>
                            @else
                                <a class="button" href="/sejour/{{ $sejour->idsejour }}/edit">
                                    <i data-lucide="pencil-ruler"></i>
                                    <span class="text">Modifier séjour</span>
                                </a>
                            @endisset
                            <button class="reduction button" data-idsejour="{{ $sejour->idsejour }}">
                                <i data-lucide="badge-percent"></i>
                                <span class="text">Promotion</span>
                            </button>
                        @endif
                    </div>
                </div>
        </section>

        <hr>

        <h2 class="titreg">Le programme détaillé de votre séjour</h2>

        <section id="etapes">
            @foreach ($sejour->etape as $etape)
                <article class="etape">
                    <h2>Étape {{ $jour }} : {{ $etape->titreetape }}</h2>
                    <p>{{ $etape->descriptionetape }}</p>
                    <img class="image" src="/storage/etape/{{ $etape->photoetape }}" />
                </article>
                @php
                    $jour++;
                @endphp
            @endforeach
        </section>

        <hr>
        <h2 class="titreg">Les hébergements proposés</h2>

        <section id="hebergements">
            @foreach ($sejour->etape as $etape)
                <article class="hebergement">
                    <img class="imgheberg"
                        src="/assets/images/hebergement/{{ $etape->hebergement->photohebergement }}"></img>
                    <p class="descrheberg">{{ $etape->hebergement->descriptionhebergement }}</p>
                    <a class="lienheberg" href="{{ $etape->hebergement->lienhebergement }}"
                        target="_blank">{{ $etape->hebergement->hotel->nompartenaire }}</a>
                    @isset($editing)
                        <form action="/sejour/{{ $sejour->idsejour }}/edit/hebergement" method="POST">
                            @csrf
                            <input type="hidden" name="idhebergement" value="{{ $etape->hebergement->idhebergement }}" />
                            <input type="hidden" name="idetape" value="{{ $etape->idetape }}" />
                            <button class="button" type="submit">
                                @if ($etape->hebergement->disponibilitehebergement == true)
                                    <i data-lucide="trash-2"></i>
                                @else
                                    <i data-lucide="rotate-cw"></i>
                                @endif
                            </button>
                        </form>
                    @endisset
                </article>
            @endforeach
        </section>

        @if (!$sejour->publie && (Helpers::AuthIsRole(Role::ServiceVente) || Helpers::AuthIsRole(Role::Dirigeant)))
            @if (\Session::has('success'))
                <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
            @endif
            <form action="/sejour/mailpossibilite/" method="POST">
                @csrf
                <input value={{$sejour->idsejour}} name="idsejour" id="idsejour" class="hidden">
                <button type="submit" class="button">Contactez les hotels</button>
            </form>
        @endif

        <hr>
        <h2 class="titreg">Les châteaux et les domaines</h2>

        <section id="chateaux">
            @foreach ($sejour->etape as $etape)
                <article class="unchateaux">
                    @foreach ($etape->visite as $unevisite)
                        <img class="imgchateaux" src="/assets/images/visite/{{ $unevisite->photovisite }}"></img>
                        <p class="descrchateaux">{{ $unevisite->descriptionvisite }}</p>
                        @foreach ($unevisite->cave as $unecave)
                            <a class="lienchateaux" href="https://www.vinotrip.com/fr/partenaires/25-domaine-trapet"
                                target="_blank">{{ $unecave->nompartenaire }}</a>
                        @endforeach
                    @endforeach
                </article>
            @endforeach
        </section>


        @foreach ($sejour->avis as $avis)
            @php
                $cpt++;
            @endphp
        @endforeach
        @if ($cpt != 0)
            <hr>
            <h2 class="titreg">Les avis</h2>
            <section id="avis">
                @foreach ($sejour->avis as $avis)
                    <article class="avis">
                        <div class="stars">
                            <i data-lucide="star" fill="currentColor" class="checked"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($avis->noteavis >= 2) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($avis->noteavis >= 3) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($avis->noteavis >= 4) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($avis->noteavis == 5) checked @endif"></i>
                            {{ $avis->noteavis }}/5 &nbsp;&nbsp;
                        </div>
                        <p class="titre">
                            @php
                                $text = $avis->client->prenomclient;
                                $sub = substr($text, 0, 1);
                            @endphp
                            {{ $avis->client->nomclient }} {{ $sub }}. &nbsp;|&nbsp; {{ $avis->titreavis }}
                        </p>
                        <div class="description">
                            @if ($avis->photoavis)
                                <img src="/storage/avis/{{ $avis->photoavis }}" alt="Photo" class="photo">
                            @endif
                            <p>{{ $avis->descriptionavis }}</p>
                        </div>
                        <div class="buttons">
                            @if (Helpers::AuthIsRole(Role::ServiceVente) || Helpers::AuthIsRole(Role::Dirigeant))
                                <form method="post"
                                    action="/api/sejour/{{ $sejour->idsejour }}/avis/{{ $avis->idavis }}/reply">
                                    @csrf
                                    <div class="input-control input-control-text">
                                        <input type="text" name="reply" required placeholder="Répondre" />
                                    </div>
                                    <button class="button button-sm" type="submit">
                                        <i data-lucide="reply"></i>
                                    </button>
                                </form>
                            @endif
                            <button class="button button-sm signaler">Signaler l'avis</button>
                        </div>
                        @foreach ($avis->reponse as $reponse)
                            <div class="reponse">
                                <span class="titre">Réponse de VinoTrip<i data-lucide="badge-check"></i></span>
                                <span class="description">{{ $reponse->descriptionreponse }}</span>
                            </div>
                        @endforeach
                    </article>
                @endforeach
            </section>
        @endif


        @if (Helpers::AuthIsRole(Role::ServiceVente) || Helpers::AuthIsRole(Role::Dirigeant))
            <form class="overlay hidden" id="reduc" method="post" action="/api/sejour/discount">
                @csrf
                <div class="overlay-content">
                    <h2>Indiquer le nouveau prix voulu :</h2><br />
                    <input type="hidden" name="idsejour" id="reduc-idsejour">

                    <div class="input-control input-control-text required">
                        <label for="reduc-nouvprix">Nouveau prix (€)</label>
                        <input type="number" basevalue="{{ $sejour->nouveauprixsejour ?? $sejour->prixsejour }}"
                            step="0.01" value="{{ $sejour->nouveauprixsejour ?? $sejour->prixsejour }}"
                            min="0" max="{{ $sejour->prixsejour }}" name="nouveauprixsejour"
                            id="reduc-nouvprix">
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="reduc-pourcentage">Réduction (%)</label>
                        <input type="number"
                            basevalue="{{ $sejour->prixsejour == 0 ? 0 : round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 2) }}"
                            step="0.01"
                            value="{{ $sejour->prixsejour == 0 ? 0 : round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 2) }}"
                            min="0" max="100" name="pourcentagereduction" id="reduc-pourcentage">
                    </div>

                    <div id="reduction-buttons" class="buttons">
                        <button type="button" class="button" id="reduc-annuler">Annuler</button>
                        <button type="submit" class="button">Appliquer</button>
                    </div>
                </div>
            </form>
        @endif

        @if (Auth::check())
            <form class="overlay hidden" id="publier-avis" method="post"
                action="/api/sejour/{{ $sejour->idsejour }}/avis" enctype="multipart/form-data">
                @csrf
                <div class="overlay-content">
                    <h2>Créer un avis</h2>
                    <div class="input-control input-control-image required">
                        <label for="pavis-photo">Photo</label>
                        <div class="image">
                            <img src="" id="pavis-photo-img">
                            <div class="hover"></div>
                        </div>
                        <div class="input-container">
                            <input type="file" accept="image/*" name="photo" id="pavis-photo">
                            <button class="button" disabled type="button" id="photo-upload-remove"><i
                                    data-lucide="image-off"></i></button>
                        </div>
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="pavis-note">Note de l'avis (/5)</label>
                        <input type="number" min="1" step="1" max="5" name="note"
                            id="pavis-note">
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="pavis-titre">Titre de l'avis</label>
                        <input type="text" name="titre" id="pavis-titre" minlength="5" maxlength="50">
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="pavis-description">Description</label>
                        <input type="text" name="description" id="pavis-description" minlength="10"
                            maxlength="2048">
                    </div>

                    <div id="reduction-buttons">
                        <button type="button" class="button" id="pavis-annuler">Annuler</button>
                        <button type="submit" class="button">Confirmer</button>
                    </div>
                </div>
            </form>
        @endif

        @if (isset($sejouraime) && sizeof($sejouraime) > 0)
            <hr>
            <h2 class="titreg">Également dans cette région</h2>
            <section id="aime">
                @foreach ($sejouraime as $aime)
                    <article class="aime"> <img src="/storage/sejour/{{ $aime->photosejour }}" alt=""
                            class="photo">
                        <p class="titre">{{ $aime->titresejour }}</p>
                        <p class="prix">À partir de <span class="euros">{{ $aime->prixsejour }}€</span> par personne
                        </p>
                        <a class="button button-sm" href="/sejour/{{ $aime->idsejour }}">Détails</a>
                    </article>
                @endforeach
            </section>
        @endif

        @if (isset($history) && sizeof($history) > 0)
            <hr>
            <h2 class="titreg">Séjours récemment visités</h2>
            <section id="history">
                @foreach ($history as $hsejour)
                    <article class="history" data-open="/sejour/{{ $hsejour->idsejour }}">
                        <img src="/storage/sejour/{{ $hsejour->photosejour }}" alt="" class="photo">
                        <p class="titre">{{ $hsejour->titresejour }}</p>
                        <p class="prix">À partir de <span class="euros">{{ $hsejour->prixsejour }}€</span> par
                            personne</p>
                        <a class="button button-sm" href="/sejour/{{ $hsejour->idsejour }}">Détails</a>
                    </article>
                @endforeach
            </section>
        @endif
    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/avis.js" defer></script>
    <script src="/assets/js/sejours/summary.js" defer type="module"></script>
@endsection
