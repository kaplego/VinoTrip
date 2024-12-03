<header>
    <a id="header-logo" href="/">
        <img src="/assets/images/vinotrip.png" alt="" class="logo">
        <span class="text">Créateurs de séjours oenotouristiques</span>
    </a>
    <menu>
        <nav>
            <li>
                <i data-lucide="send"></i>
                Contact
            </li>
            <li>
                <i data-lucide="gift"></i>
                Bénéficiaire Cadeau
            </li>
            <li>
                <a href="/authentification">
                    <i data-lucide="circle-user-round"></i>
                    @if (!Auth::check())
                        Mon compte
                    @else
                        {{Auth::user()->nomclient}} {{Auth::user()->prenomclient}}
                    @endif

                </a>
            <li>
                <a href="/panier">
                    <i data-lucide="shopping-cart"></i>
                    Panier
                </a>
            </li>
        </nav>
        <nav id="nav-site">
            <li class="@if (($active ?? '') == 'sejours-list') active @endif">
                <a href="/sejours">Tous nos séjours</a>
            </li>
            <li class="@if (($active ?? '') == 'destinations') active @endif">
                <a href="/destinations">Destinations</a>
            </li>
            <li class="@if (($active ?? '') == 'thematiques') active @endif">
                <a href="/thematiques">Thématiques</a>
            </li>
            <li class="@if (($active ?? '') == 'cadeaux') active @endif">
                <a href="/cadeaux">Coffret cadeau</a>
            </li>
        </nav>
    </menu>
</header>
