<header>
    <div id="header-content" class="container">
        <a id="header-logo" href="{{ route('welcome') }}">
            <img src="/assets/images/vinotrip.png" alt="" class="logo">
            <span class="text">Créateurs de séjours oenotouristiques</span>
        </a>
        <nav>
            <li class="@if (($active ?? '') == 'sejours-list') active @endif">
                <a href="{{ route('sejours') }}">
                    <i data-lucide="map"></i>
                    Tous nos Séjours
                </a>
            </li>
            <li class="@if (($active ?? '') == 'routes-des-vins') active @endif">
                <a href="{{ route('routes-vins') }}">
                    <i data-lucide="route"></i>
                    Routes des Vins
                </a>
            </li>
            <li class="@if (($active ?? '') == 'aide') active @endif">
                <a href="{{ route('aide') }}">
                    <i data-lucide="life-buoy"></i>
                    Aide
                </a>
            </li>
            <div class="separator"></div>
            <li class="@if (($active ?? '') == 'compte') active @endif">
                <a href="{{ route('login') }}">
                    <i data-lucide="circle-user-round"></i>
                    @if (!Auth::check())
                        <span>Connexion</span>
                    @else
                        <span>{{ Auth::user()->nomclient }} {{ Auth::user()->prenomclient }}</span>
                    @endif
                </a>
            </li>
            <li class="@if (($active ?? '') == 'panier') active @endif">
                <a href="{{ route('panier') }}">
                    <i data-lucide="shopping-cart"></i>
                    Panier
                </a>
            </li>
            @if(Helpers::AuthIsRole(Role::ServiceVente))
                <li class="@if (($active ?? '') == 'reservations') active @endif">
                    <a href="{{ route('reservations') }}">
                        <i data-lucide="notebook-text"></i>
                        Réservations
                    </a>
                </li>
            @endif
        </nav>
    </div>
</header>
