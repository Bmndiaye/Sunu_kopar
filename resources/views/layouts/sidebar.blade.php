<aside class="sidebar sidebar-default sidebar-base navs-rounded-all " id="first-tour" data-toggle="main-sidebar" data-sidebar="responsive">
    <div class="sidebar-header d-flex align-items-center justify-content-start position-relative">
        <a href="#" class="d-flex align-items-center gap-2 iq-header-logo">
            <!-- Logo et Titre -->
            <svg width="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="..."></path>
            </svg>
            <h3 class="logo-title" data-setting="app_name">Système Tontine</h3>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <span class="menu-btn d-inline-block is-active">
                <i class="right-icon material-symbols-outlined icon-rtl">chevron_left</i>
            </span>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="">
                        <i class="icon material-symbols-outlined">dashboard</i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                
                <!-- Section SUPER_ADMIN -->
             <!-- Section SUPER_ADMIN -->
@if(Auth::user()->hasRole('SUPER_ADMIN'))
<li>
    <hr class="hr-horizontal">
</li>
<li class="nav-item static-item">
    <a class="nav-link static-item disabled" href="#" tabindex="-1">
        <span class="default-icon">SUPER_ADMIN</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#admin-user-menu" role="button" aria-expanded="false" aria-controls="admin-user-menu">
        <i class="icon material-symbols-outlined">admin_panel_settings</i>
        <span class="item-name">Gestion Utilisateurs</span>
        <i class="right-icon material-symbols-outlined">chevron_right</i>
    </a>
    <ul class="sub-nav collapse" id="admin-user-menu" data-bs-parent="#sidebar-menu">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users') }}">
                <i class="icon material-symbols-outlined">group</i>
                <span class="item-name">Liste des utilisateurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.roles') }}">
                <i class="icon material-symbols-outlined">security</i>
                <span class="item-name">Gestion des rôles</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#admin-system-menu" role="button" aria-expanded="false" aria-controls="admin-system-menu">
        <i class="icon material-symbols-outlined">settings_applications</i>
        <span class="item-name">Configuration Système</span>
        <i class="right-icon material-symbols-outlined">chevron_right</i>
    </a>
    <ul class="sub-nav collapse" id="admin-system-menu" data-bs-parent="#sidebar-menu">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon material-symbols-outlined">tune</i>
                <span class="item-name">Paramètres système</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon material-symbols-outlined">backup</i>
                <span class="item-name">Sauvegardes</span>
            </a>
        </li>
    </ul>
</li>
<!-- Logs Système -->
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="icon material-symbols-outlined">receipt_long</i>
        <span class="item-name">Logs système</span>
    </a>
</li>
@endif
                <!-- Section GERANT -->
                @if(Auth::user()->hasRole('GERANT'))
                    <li>
                        <hr class="hr-horizontal">
                    </li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">GERANT</span>
                        </a>
                    </li>
                    <!-- Gestion Tontines -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tontine-menu" role="button" aria-expanded="false" aria-controls="tontine-menu">
                            <i class="icon material-symbols-outlined">account_balance</i>
                            <span class="item-name">Gestion Tontines</span>
                            <i class="right-icon material-symbols-outlined">chevron_right</i>
                        </a>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.user-list') }}">
                                    <i class="icon material-symbols-outlined">group</i>
                                    <span class="item-name">Liste des utilisateurs</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.user-list') }}">
                                    <i class="icon material-symbols-outlined">group</i>
                                    <span class="item-name">Liste des utilisateurs</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gerant.tontines') }}">
                                    <i class="icon material-symbols-outlined">group</i>
                                    <span class="item-name">Liste des Tontines</span>
                                </a>
                            </li>


                            
                          <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.calendrier') }}">
                                    <i class="icon material-symbols-outlined">group</i>
                                    <span class="item-name">Espace Cotisation</span>
                                </a>
                            </li>

                                                     
    <li class="nav-item">
        <a class="nav-link " href="{{ route('tirage.index') }}">
            <i class="icon material-symbols-outlined">casino</i>
            <span class="item-name">Tirage au sort</span>
        </a>
    </li>
<li>
<li>
<a class="nav-link" href="{{ route('messages.index') }}">
        <i class="icon material"></i>
        <span class="item-name">Discussion</span>

        @if(!empty($unreadMessagesCount) && $unreadMessagesCount > 0)
            <span class="badge bg-danger ms-2">{{ $unreadMessagesCount }}</span>
        @endif
    </a>
</li>



</li>
    
                    </li>
                @endif
                
                <!-- Section PARTICIPANT -->
                @if(Auth::user()->hasRole('PARTICIPANT'))
    <li>
        <hr class="hr-horizontal">
    </li>
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="#" tabindex="-1">
            <span class="default-icon">PARTICIPANT</span>
        </a>
    </li>
    <!-- Mes Tontines -->

    <li class="nav-item">
                                <a class="nav-link" href="{{ route('gerant.tontines') }}">
                                    <i class="icon material-symbols-outlined">group</i>
                                    <span class="item-name">Liste des Tontines</span>
                                </a>
                            </li>
                            
    <li class="nav-item">
        <a class="nav-link " href="{{ route('tirage.index') }}">
            <i class="icon material-symbols-outlined">casino</i>
            <span class="item-name">Tirage au sort</span>
        </a>
    </li>
    <!-- Mes Cotisations -->
    <li class="nav-item">
        <a class="nav-link " href="#">
            <i class="icon material-symbols-outlined">paid</i>
            <span class="item-name">Mes Cotisations</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.calendrier') }}">
            <i class="icon material-symbols-outlined">group</i>
             <span class="item-name">Espaces Cotisations</span>
                                </a>
    </li>
    <li>
    <a class="nav-link" href="{{ route('messages.index') }}">
        <i class="icon material"></i>
        <span class="item-name">Discussion</span>

        @if(!empty($unreadMessagesCount) && $unreadMessagesCount > 0)
            <span class="badge bg-danger ms-2">{{ $unreadMessagesCount }}</span>
        @endif
    </a>
</li>

                          
@endif


                <!-- Utilitaires -->
                <li>
                    <hr class="hr-horizontal">
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="icon material-symbols-outlined">history</i>
                        <span class="item-name">Historique</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon material-symbols-outlined">logout</i>
                        <span class="item-name">Déconnexion</span>
                    </a>
               </li>

            </ul>
        </div>
    </div>
</aside>
