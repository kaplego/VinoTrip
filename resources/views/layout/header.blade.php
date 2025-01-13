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
            <li class="@if (($active ?? '') == 'routes-des-vins') active @endif">
                <a href="/routes-des-vins">Routes des Vins</a>
            </li>
            @if(Helpers::AuthIsRole(Role::ServiceVente))
                <li class="@if (($active ?? '') == 'reservation') active @endif">
                    <a href="/reservation"> Voir Reservation Commande</a>
                </li>
            @endif

        </nav>
    </menu>
</header>
