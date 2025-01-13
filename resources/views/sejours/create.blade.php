@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', 'Créer un séjour - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours/create.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container">
        @php
            $bcCustomLink = 'sejours/creer';
        @endphp
        @include('layout.breadcrumb')
        <h1>Créer un séjour</h1>
        <hr class="separateur-titre">
        <form action="/api/sejours/create" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <h2>Séjour</h2>
            <div class="columns">
                <div class="column">
                    <div class="input-control input-control-text required">
                        <label for="titre">Titre du séjour</label>
                        <input id="titre" type="text" name="titre" value="{{ old('titre') }}"
                            placeholder="{{ $placeholder->titresejour }}" />
                        @error('titre')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="description">Description du séjour</label>
                        <textarea id="description" type="text" name="description" placeholder="{{ $placeholder->descriptionsejour }}"
                            rows="3" autocapitalize="sentences">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="price">Prix du séjour (€)</label>
                        <input id="price" type="number" name="price" value="{{ old('price') }}"
                            placeholder="{{ $placeholder->prixsejour }}" min="0" step="0.01" max="999999.99" />
                        @error('price')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select required">
                        <label for="categorie-participant">Catégorie participant</label>
                        <select name="categorie-participant" id="categorie-participant">
                            @foreach ($categoriesparticipant as $cparticipant)
                                <option value="{{ $cparticipant->idcategorieparticipant }}"
                                    @if (old('categorie-participant') == $cparticipant->idcategorieparticipant) selected @endif>
                                    {{ $cparticipant->libellecategorieparticipant }}</option>
                            @endforeach
                        </select>
                        @error('categorie-participant')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select required">
                        <label for="categorie-sejour">Catégorie du séjour</label>
                        <select name="categorie-sejour" id="categorie-sejour">
                            @foreach ($categoriessejour as $csejour)
                                <option value="{{ $csejour->idcategoriesejour }}"
                                    @if (old('categorie-sejour') == $csejour->idcategoriesejour) selected @endif>
                                    {{ $csejour->libellecategoriesejour }}</option>
                            @endforeach
                        </select>
                        @error('categorie-sejour')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select required">
                        <label for="theme">Thème du séjour</label>
                        <select name="theme" id="theme">
                            @foreach ($themes as $theme)
                                <option value="{{ $theme->idtheme }}" @if (old('theme') == $theme->idtheme) selected @endif>
                                    {{ $theme->libelletheme }}</option>
                            @endforeach
                        </select>
                        @error('theme')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select required">
                        <label for="duree">Durée du séjour</label>
                        <select name="duree" id="duree">
                            @foreach ($durees as $duree)
                                <option value="{{ $duree->idduree }}" @if (old('duree') == $duree->idduree) selected @endif>
                                    {{ $duree->libelleduree }}</option>
                            @endforeach
                        </select>
                        @error('duree')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="column">
                    <div class="input-control input-control-image required" id="photo">
                        <label for="photo-upload">Photo du séjour</label>
                        <div class="image">
                            <img src="" alt="" id="photo-img">
                            <div class="hover"></div>
                        </div>
                        <div class="input-container" id="photo-upload-container">
                            <input id="photo-upload" type="file" name="photo" value="{{ old('photo') }}"
                                accept="image/png, image/jpeg" autocomplete="off" />
                            <button class="button" disabled id="photo-upload-remove"><i
                                    data-lucide="image-off"></i></button>
                        </div>
                        @error('photo')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select required">
                        <label for="vignoble">Vignoble</label>
                        <select name="vignoble" id="vignoble">
                            @foreach ($vignobles as $vignoble)
                                <option value="{{ $vignoble->idcategorievignoble }}"
                                    @if (old('vignoble') == $vignoble->idcategorievignoble) selected @endif>
                                    {{ $vignoble->libellecategorievignoble }}</option>
                            @endforeach
                        </select>
                        @error('vignoble')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-select" id="localite-control" class="">
                        <label for="localite">Localité</label>
                        <select name="localite" id="localite">
                            <option value="null">Aucune localité</option>
                            @foreach ($localites as $localite)
                                <option data-vignoble="{{ $localite->idcategorievignoble }}"
                                    class="@if (old('vignoble') != $vignoble->idcategorievignoble) hidden @endif"
                                    value="{{ $localite->idlocalite }}" @if (old('vignoble') == $vignoble->idcategorievignoble && old('localite') == $localite->idlocalite) selected @endif>
                                    {{ $localite->libellelocalite }}</option>
                            @endforeach
                        </select>
                        @error('localite')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="separateur-section">
            <div class="columns">
                <div class="column">
                    <h2 id="etapes-titre">Étapes</h2>
                    <button class="button" type="button" id="add-etape">Ajouter une étape</button>
                </div>
                <div class="column"></div>
            </div>
            <br />
            <section id="etapes">
                @php
                    $i = 0;
                @endphp
                @foreach (old('etapes', []) as $etape)
                    <article class="etape" id="etape-{{ $i }}">
                        <div class="image input-control input-control-image">
                            <div class="image">
                                <img />
                                <div class="hover"></div>
                            </div>
                            <div class="input-container">
                                <input type="file" accept="image/png, image/jpeg"
                                    name="etapes[{{ $i }}][image]">
                            </div>
                        </div>
                        <input class="titre" type="text" name="etapes[{{ $i }}][titre]"
                            value="{{ $etape['titre'] }}">
                        <textarea class="description" name="etapes[{{ $i }}][description]" rows="3">{{ $etape['description'] }}</textarea>
                        <div class="hebergement input-control input-control-select">
                            <label for="hebergement-{{ $i }}">Hébergement</label>
                            <select name="etapes[{{ $i }}][hebergement]"
                                id="hebergement-{{ $i }}">
                                @foreach ($hebergements as $hebergement)
                                    <option value="{{ $hebergement->idhebergement }}"
                                        @if ($etape['hebergement'] == $hebergement->idhebergement) selected @endif>
                                        {{ $hebergement->idhebergement }}.
                                        {{ $hebergement->descriptionhebergement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="button btn-supprimer" data-etape="{{ $i }}" type="button"
                            disabled="">
                            <i data-lucide="trash-2"></i>
                        </button>
                        <div class="errors">
                            @error("etapes.$i.image")
                                <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                            @enderror
                            @error("etapes.$i.titre")
                                <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                            @enderror
                            @error("etapes.$i.description")
                                <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </article>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </section>
            <button class="button" type="submit">Créer le séjour</button>
        </form>
    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script>
        const hebergements = @json($hebergements);
    </script>
    <script src="/assets/js/sejours/create.js" defer></script>
@endsection
