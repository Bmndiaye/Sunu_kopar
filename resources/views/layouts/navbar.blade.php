<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* Styles pour le menu déroulant du profil */
.user-dropdown .sub-drop {
  width: 320px;
  padding: 0;
}

/* Effet de survol pour les éléments du menu */
.hover-item {
  padding: 8px 12px;
  border-radius: 8px;
  transition: all 0.2s ease;
  text-decoration: none;
}

.hover-item:hover {
  background-color: rgba(var(--bs-primary-rgb), 0.1);
  transform: translateX(3px);
}

/* Style pour l'avatar */
.avatar-60 {
  width: 60px;
  height: 60px;
  object-fit: cover;
}

/* Style pour le badge en ligne */
.bg-success.rounded-circle {
  width: 12px;
  height: 12px;
}

/* Style pour les icônes */
.material-symbols-outlined.bg-light-subtle {
  border-radius: 8px;
  font-size: 20px;
}

/* Style pour le bouton de déconnexion */
.btn-soft-danger {
  background-color: rgba(var(--bs-danger-rgb), 0.1);
  color: var(--bs-danger);
  transition: all 0.3s ease;
}

.btn-soft-danger:hover {
  background-color: var(--bs-danger);
  color: white;
}

/* Animation pour le menu déroulant */
.sub-drop {
  animation: fadeInDown 0.3s ease-in-out;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Style pour la section d'informations utilisateur */
.user-info {
  background-color: rgba(var(--bs-light-rgb), 0.3);
  border-radius: 8px;
  padding: 8px;
  margin-bottom: 16px;
}

.user-info .material-symbols-outlined {
  font-size: 22px;
}

/* Ajustements responsifs */
@media (max-width: 576px) {
  .user-dropdown .sub-drop {
    width: 280px;
  }
}
  </style>
</head>
<body>
<div class="iq-top-navbar border-bottom">
  <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar p-lg-0">
    <div class="container-fluid navbar-inner">
      <div class="d-flex align-items-center pb-2 pb-lg-0 d-xl-none">
        <a href="#" class="d-flex align-items-center iq-header-logo navbar-brand d-block d-xl-none">
          <svg width="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.67733 9.50001L7.88976 20.2602C9.81426 23.5936 14.6255 23.5936 16.55 20.2602L22.7624 9.5C24.6869 6.16666 22.2813 2 18.4323 2H6.00746C2.15845 2 -0.247164 6.16668 1.67733 9.50001ZM14.818 19.2602C13.6633 21.2602 10.7765 21.2602 9.62181 19.2602L9.46165 18.9828L9.46597 18.7275C9.48329 17.7026 9.76288 16.6993 10.2781 15.8131L12.0767 12.7195L14.1092 16.2155C14.4957 16.8803 14.7508 17.6132 14.8607 18.3743L14.9544 19.0239L14.818 19.2602ZM16.4299 16.4683L19.3673 11.3806C18.7773 11.5172 18.172 11.5868 17.5629 11.5868H13.7316L15.8382 15.2102C16.0721 15.6125 16.2699 16.0335 16.4299 16.4683ZM20.9542 8.63193L21.0304 8.5C22.1851 6.5 20.7417 4 18.4323 4H17.8353L17.1846 4.56727C16.6902 4.99824 16.2698 5.50736 15.9402 6.07437L13.8981 9.58676H17.5629C18.4271 9.58676 19.281 9.40011 20.0663 9.03957L20.9542 8.63193ZM14.9554 4C14.6791 4.33499 14.4301 4.69248 14.2111 5.06912L12.0767 8.74038L10.0324 5.22419C9.77912 4.78855 9.48582 4.37881 9.15689 4H14.9554ZM6.15405 4H6.00746C3.69806 4 2.25468 6.50001 3.40938 8.50001L3.4915 8.64223L4.37838 9.04644C5.15962 9.40251 6.00817 9.58676 6.86672 9.58676H10.2553L8.30338 6.22943C7.9234 5.57587 7.42333 5.00001 6.8295 4.53215L6.15405 4ZM5.07407 11.3833L7.88909 16.2591C8.05955 15.7565 8.28025 15.2702 8.54905 14.8079L10.4218 11.5868H6.86672C6.26169 11.5868 5.66037 11.5181 5.07407 11.3833Z" fill="currentColor" />
          </svg>
          <h3 class="logo-title d-none d-sm-block" data-setting="app_name">Teranga Cash</h3>
        </a>
        <a class="sidebar-toggle" data-toggle="sidebar" data-active="true" href="javascript:void(0);">
          <div class="icon material-symbols-outlined iq-burger-menu"> menu </div>
        </a>
      </div>
      <div class="d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between product-offcanvas">
          <div class="offcanvas offcanvas-end shadow-none iq-product-menu-responsive d-none d-xl-block" tabindex="-1" id="offcanvasBottomNav">
            <div class="offcanvas-body">
              <ul class="iq-nav-menu list-unstyled">
                <li class="nav-item">
                  <a class="nav-link menu-arrow justify-content-start " href="#">
                    <span class="nav-text">Home</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="iq-search-bar device-search position-relative d-none d-lg-block">
          <form action="#" class="searchbox open-modal-search">
            <a class="search-link" href="javascript:void(0);">
              <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="7.82491" cy="7.82495" r="6.74142" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12.5137 12.8638L15.1567 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
            <input type="text" class="text search-input form-control bg-light-subtle" placeholder="Search for people or groups...">
          </form>
        </div>
      </div>
      <ul class="navbar-nav navbar-list">
        <li class="nav-item d-lg-none">
          <div class="iq-search-bar device-search">
            <form action="#" class="searchbox open-modal-search ">
              <a class="d-lg-none d-flex text-body" href="javascript:void(0);">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="7.82491" cy="7.82495" r="6.74142" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                  <path d="M12.5137 12.8638L15.1567 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </a>
            </form>
            <div class="search-modal-custom">
              <div class="search-modal-content">
                <div class="py-2 px-3">
                  <div class="d-lg-none w-100">
                    <form action="#" class="searchbox" data-bs-toggle="modal" data-bs-target="#searchmodal">
                      <a class="search-link" href="javascript:void(0);">
                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="7.82491" cy="7.82495" r="6.74142" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M12.5137 12.8638L15.1567 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </a>
                      <input type="text" class="text search-input form-control bg-primary-subtle" placeholder="Search here...">
                    </form>
                  </div>
                  <div class="d-none d-lg-flex align-items-center justify-content-between w-100">
                    <h4 class="modal-title" id="exampleModalFullscreenLabel">Recent</h4>
                    <a class="text-dark" href="javascript:void(0);">Clear All</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center" id="group-drop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="material-symbols-outlined">group</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="javascript:void(0);" class="search-toggle dropdown-toggle d-flex align-items-center" id="notification-drop" data-bs-toggle="dropdown">
            <span class="material-symbols-outlined position-relative">notifications
              <span class="bg-primary text-white notification-badge"></span>
            </span>
          </a>
          <div class="sub-drop dropdown-menu header-notification" aria-labelledby="notification-drop">
            <div class="card m-0 shadow">
              <div class="card-header d-flex justify-content-between px-0 pb-4 mx-5 border-bottom">
                <div class="header-title">
                  <h5 class="fw-semibold">Notifications</h5>
                </div>
                <h6 class="material-symbols-outlined">settings</h6>
              </div>
              <div class="card-body">
                <div class="item-header-scroll">
                  <a href="javascript:void(0);">
                    <div class="d-flex gap-3 mb-4">
                      <img class="avatar-32 rounded-pill" src="data:image/png;base64,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" alt="">
                      <div>
                        <h6 class="font-size-14">Pete Sariya <span class="text-body fw-normal">voted for</span> combination of colors from your brand palette </h6>
                        <small class="text-body fw-500">1 month ago</small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);">
                    <div class="d-flex gap-3 mb-4">
                      <img class="avatar-32 rounded-pill" src="#" alt="" loading="lazy">
                      <div>
                        <h6 class="font-size-14">Dima Davydov <span class="text-body fw-normal">replied to your</span>
                          <span class="text-primary fw-semibold">comment</span>
                        </h6>
                        <small class="text-body fw-500">1 month ago</small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);">
                    <div class="d-flex gap-3 mb-4">
                      <img class="avatar-32 rounded-pill" src="../assets/images/user/03.jpg" alt="" loading="lazy">
                      <div>
                        <h6 class="font-size-14">Esther Howard <span class="text-body fw-normal">reacted comment in to your </span>
                          <span class="text-primary fw-semibold">post</span>.
                        </h6>
                        <small class="text-body fw-500">19 min ago</small>
                      </div>
                    </div>
                  </a>
                </div>  
                <button type="button" class="btn btn-primary fw-500 w-100">View All Notifications</button>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item d-none d-lg-none">
          <a href="#" class="dropdown-toggle d-flex align-items-center" id="mail-drop-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-symbols-outlined">mail</i>
            <span class="mobile-text ms-3">Message</span>
          </a>
        </li>
        <li class="nav-item dropdown user-dropdown">
          <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" id="drop-down-arrow" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="data:image/png;base64,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" class="img-fluid rounded-circle avatar-48 border border-2 me-3" alt="user" loading="lazy">
          </a>
          <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
            <div class="card shadow-none m-0">
              <!-- En-tête du profil avec bannière -->
              <div class="card-header bg-primary text-white p-3 position-relative">
                <div class="d-flex align-items-center">
                  @if($authUser)
                  <div class="position-relative">
                    <img src="#" class="img-fluid rounded-circle avatar-60 border border-3 border-white" alt="user">
                    <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-white" style="width: 12px; height: 12px;"></span>
                  </div>
                  <div class="ms-3">
                    <h5 class="mb-0 text-white">{{ $authUser->prenom }} {{ $authUser->nom }}</h5>
                    <p class="mb-0 text-white-50 small">Membre depuis {{ date('M Y', strtotime($authUser->created_at)) }}</p>
                  </div>
                  @endif
                </div>
              </div>
              
              <!-- Informations de l'utilisateur -->
              <div class="card-body p-3">
                <div class="user-info border-bottom pb-3 mb-3">
                  @if($authUser)
                  <div class="d-flex align-items-center py-2">
                    <span class="material-symbols-outlined text-primary me-3">email</span>
                    <div>
                      <p class="text-muted mb-0 small">Email</p>
                      <p class="mb-0 fw-medium">{{ $authUser->email }}</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center py-2">
                    <span class="material-symbols-outlined text-primary me-3">phone</span>
                    <div>
                      <p class="text-muted mb-0 small">Téléphone</p>
                      <p class="mb-0 fw-medium">{{ $authUser->telephone }}</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center py-2">
                    <span class="material-symbols-outlined text-primary me-3">calendar_today</span>
                    <div>
                      <p class="text-muted mb-0 small">Membre depuis</p>
                      <p class="mb-0 fw-medium">{{ date('d M Y', strtotime($authUser->created_at)) }}</p>
                    </div>
                  </div>
                  @endif
                </div>
                
                <!-- Menu d'actions -->
                <div class="user-actions">
                 
                  <a href="#" class="d-flex align-items-center mb-3 text-body hover-item">
                    <span class="material-symbols-outlined bg-light-subtle p-2 rounded text-primary me-3">settings</span>
                    <span>Paramètres</span>
                  </a>
                  <a href="#" class="d-flex align-items-center mb-3 text-body hover-item">
                    <span class="material-symbols-outlined bg-light-subtle p-2 rounded text-primary me-3">history</span>
                    <span>Activités récentes</span>
                  </a>
                  <a href="#" class="d-flex align-items-center mb-4 text-body hover-item">
                    <span class="material-symbols-outlined bg-light-subtle p-2 rounded text-primary me-3">help</span>
                    <span>Aide & Support</span>
                  </a>
                </div>
                
                <!-- Bouton de déconnexion -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="btn btn-soft-danger w-100 d-flex align-items-center justify-content-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon material-symbols-outlined">logout</i>
                        <span class="item-name">logout</span>
                    </a>               
                   
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>
</body>
</html>
