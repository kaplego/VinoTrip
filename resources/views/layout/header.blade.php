<header>
    <a id="header-logo" href="/">
        <img src="/assets/images/vinotrip.png" alt="" class="logo">
        <span class="text">Créateurs de séjours oenotouristiques</span>
    </a>
    <menu>
        <nav id="nav-client">
            <li class="@if (($active ?? '') == 'contact') active @endif">
                <a href="/contact">
                    <i data-lucide="send"></i>
                    Contact
                </a>
            </li>
            <li class="@if (($active ?? '') == 'cadeau') active @endif">
                <a href="/cadeau">
                    <i data-lucide="gift"></i>
                    Bénéficiaire Cadeau
                </a>
            </li>
            <li class="@if (($active ?? '') == 'compte') active @endif">
                <a href="/connexion">
                    <i data-lucide="circle-user-round"></i>
                    @if (!Auth::check())
                        <span>Connexion</span>
                    @else
                        <span>{{ Auth::user()->nomclient }} {{ Auth::user()->prenomclient }}</span>
                    @endif
                </a>
            <li class="@if (($active ?? '') == 'panier') active @endif">
                <a href="/panier">
                    <i data-lucide="shopping-cart"></i>
                    Panier
                </a>
            </li>
        </nav>
        <nav id="nav-site">
            <li class="@if (($active ?? '') == 'sejours-list') active @endif">
                <a href="/sejours">Tous nos Séjours</a>
            </li>
            <li class="@if (($active ?? '') == 'destinations') active @endif">
                <a href="/destinations">Destinations</a>
            </li>
            <li class="@if (($active ?? '') == 'thematiques') active @endif">
                <a href="/thematiques">Thématiques</a>
            </li>
            <li class="@if (($active ?? '') == 'route-des-vins') active @endif">
                <a href="/route-des-vins">Route des Vins</a>
            </li>
            <li class="@if (($active ?? '') == 'cadeaux') active @endif">
                <a href="/cadeaux">Coffret Cadeau</a>
            </li>
            @if(Auth::check() && Auth::user()->idrole == 3)
                <li class="@if (($active ?? '') == 'reservation') active @endif">
                    <a href="/reservation"> Voir Reservation Commande</a>
                </li>
            @endif

        </nav>
    </menu>
</header>
