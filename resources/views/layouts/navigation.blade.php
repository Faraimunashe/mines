<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Home</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashbard
                    </a>
                </li>
                <li class="app-sidebar__heading">Options</li>
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('admin-minerals') }}">
                            <i class="metismenu-icon pe-7s-diamond"></i>
                            Minerals
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-mines') }}">
                            <i class="metismenu-icon pe-7s-culture"></i>
                            Mines
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-consults') }}">
                            <i class="metismenu-icon pe-7s-note2"></i>
                            Consults
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-consultants') }}">
                            <i class="metismenu-icon pe-7s-smile"></i>
                            Consultants
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-clients') }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Clients
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-subscriptions') }}">
                            <i class="metismenu-icon fa fa-angle-double-up"></i>
                            Subscriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-sales') }}">
                            <i class="metismenu-icon pe-7s-cash"></i>
                            Sales
                        </a>
                    </li>
                @elseif (Auth::user()->hasRole('mine'))
                    @if (!is_null(mine()))
                        <li>
                            <a href="{{ route('mine-minerals') }}">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Minerals
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mine-bids') }}">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                Bidding
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mine-sales') }}">
                                <i class="metismenu-icon pe-7s-cash"></i>
                                Sales
                            </a>
                        </li>
                    @endif
                @elseif (Auth::user()->hasRole('consultant'))
                    @if (!is_null(consultant()))
                        <li>
                            <a href="{{ route('consultant-consults') }}">
                                <i class="metismenu-icon fa fa-clipboard"></i>
                                Consults
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('consultant-consults') }}">
                                <i class="metismenu-icon fa fa-comments"></i>
                                Consultation
                            </a>
                        </li>
                    @endif
                @else
                    @if (!is_null(client()))
                        <li>
                            <a href="{{ route('client-bidding') }}">
                                <i class="metismenu-icon fa fa-clipboard"></i>
                                Bidding
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client-consults') }}">
                                <i class="metismenu-icon fa fa-comments"></i>
                                Consultants
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client-purchases') }}">
                                <i class="metismenu-icon pe-7s-cash"></i>
                                Purchases
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
