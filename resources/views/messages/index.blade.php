<!doctype html>
<html lang="en" dir="ltr" class="theme-fs-md">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SocialV | Responsive Bootstrap 5 Admin Dashboard Template</title>
      <!-- Config Options -->
      <!-- End Config Options -->
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      <link rel="stylesheet" href="../assets/css/libs.min.css">
      <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
      <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
          rel="stylesheet">
      <!-- flatpickr css -->
      <link rel="stylesheet" href="../assets/vendor/flatpickr/dist/flatpickr.min.css" />
      <!-- Sweetlaert2 css -->
      <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" />
      
      <!-- vanillajs css -->
      <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
      
      <!-- zuck -->
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" />  </head>
  <body class="iq-chat-theme">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <aside class="sidebar sidebar-chat sidebar-base border-end shadow-none" data-sidebar="responsive">
    
        </div>
      
        <div class="sidebar-footer"></div>
    </aside>   
     <main class="main-content">
     <div class="container-fluid content-inner p-0" id="page_layout">
    <div class="tab-content" id="myTabContent">
        <div class="card tab-pane mb-0 fade show active" id="user-content-101" role="tabpanel">
            <div class="chat-head">
                <header class="d-flex justify-content-between align-items-center pt-3 ps-3 pe-3 pb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-block d-xl-none">
                          
                        </div>
                        <div class="avatar chat-user-profile m-0">
                            <img src="../assets/images/chat/avatar/01.png" alt="avatar" class="avatar-50 rounded-pill" loading="lazy">
                            <div class="iq-profile-badge bg-success"></div>
                        </div>
                        <div>
                            <h5 class="mb-0"></h5>
                            <small class="text-capitalize fw-500"> membres</small>
                        </div>
                    </div>
                    
                    <div class="chat-header-icons d-inline-flex ms-auto">
                        <a href="#" class="chat-icon-phone bg-primary-subtle d-flex align-items-center justify-content-center">
                            <i class="material-symbols-outlined md-18">phone</i>
                        </a>
                        <a href="#" class="chat-icon-video bg-primary-subtle d-flex align-items-center justify-content-center">
                            <i class="material-symbols-outlined md-18">videocam</i>
                        </a>
                        <a href="#" class="chat-icon-delete bg-primary-subtle d-flex align-items-center justify-content-center">
                            <i class="material-symbols-outlined md-18">delete</i>
                        </a>
                        <span class="dropdown bg-primary-subtle d-flex align-items-center justify-content-center">
                            <svg class="icon-20 nav-hide-arrow cursor-pointer pe-0" id="dropdownMenuButton-09" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu" width="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20.6788C10 21.9595 11.0378 23 12.3113 23C13.5868 23 14.6265 21.9595 14.6265 20.6788C14.6265 19.3981 13.5868 18.3576 12.3113 18.3576C11.0378 18.3576 10 19.3981 10 20.6788ZM10 12.0005C10 13.2812 11.0378 14.3217 12.3113 14.3217C13.5868 14.3217 14.6265 13.2812 14.6265 12.0005C14.6265 10.7198 13.5868 9.67929 12.3113 9.67929C11.0378 9.67929 10 10.7198 10 12.0005ZM12.3113 5.64239C11.0378 5.64239 10 4.60192 10 3.3212C10 2.04047 11.0378 1 12.3113 1C13.5868 1 14.6265 2.04047 14.6265 3.3212C14.6265 4.60192 13.5868 5.64239 12.3113 5.64239Z" fill="currentColor"></path>
                            </svg>
                            <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-09">
                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="material-symbols-outlined md-18 me-1">push_pin</i>Épingler</a>
                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="material-symbols-outlined md-18 me-1">delete_outline</i>Supprimer la conversation</a>
                                <a class="dropdown-item d-flex align-items-center" href="#"><i class="material-symbols-outlined md-18 me-1">watch_later</i>Bloquer</a>
                            </span>
                        </span>
                    </div>
                </header>
            </div>     
            <div class="card-body chat-body bg-body">
                <div class="chat-day-title">
                    <span class="main-title">{{ date('d M Y') }}</span>
                </div>
                
                @forelse($messages as $message)
                    <div class="iq-message-body {{ $message->user_id == auth()->id() ? 'iq-current-user' : 'iq-other-user' }}">
                        <div class="chat-profile text-center">
                            <img src="../assets/images/chat/avatar/01.png " alt="chat-user" class="avatar-40 rounded-pill" loading="lazy">
                            <small class="iq-chating p-0 mb-0 d-block">{{ $message->created_at->format('H:i') }}</small>
                        </div>
                        <div class="iq-chat-text">
                            <div class="d-flex align-items-center justify-content-{{ $message->user_id == auth()->id() ? 'end' : 'start' }} gap-1 gap-md-2">
                                @if($message->user_id != auth()->id())
                                    <div class="iq-chating-content d-flex align-items-center">
                                        <p class="mr-2 mb-0">
                                            <strong>{{ $message->user->nom }}</strong>: {{ $message->contenu }}
                                            @if($message->est_modifie)
                                                <small class="text-muted">(modifié)</small>
                                            @endif
                                        </p>
                                    </div>
                                    <a href="#" class="material-symbols-outlined font-size-20 text-dark reply" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Répondre">reply</a>
                                    <div class="dropdown cursor-pointer more" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Plus">
                                        <div class="lh-1" id="post-option" data-bs-toggle="dropdown">
                                            <span class="material-symbols-outlined text-dark">more_vert</span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option">
                                            <a class="dropdown-item" href="#" onclick="copyToClipboard('{{ $message->contenu }}')">
                                                <span class="material-symbols-outlined align-middle font-size-20 me-1">content_copy</span>Copier le message
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="dropdown cursor-pointer more" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Plus">
                                        <div class="lh-1" id="post-option" data-bs-toggle="dropdown">
                                            <span class="material-symbols-outlined text-dark">more_vert</span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option">
                                            <a class="dropdown-item" href="#" onclick="copyToClipboard('{{ $message->contenu }}')">
                                                <span class="material-symbols-outlined align-middle font-size-20 me-1">content_copy</span>Copier le message
                                            </a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editMessageModal{{ $message->id }}">
                                                <span class="material-symbols-outlined align-middle font-size-20 me-1">edit</span>Modifier
                                            </a>
                                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <span class="material-symbols-outlined align-middle font-size-20 me-1">delete</span>Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-chating-content d-flex align-items-center">
                                        <p class="mr-2 mb-0">
                                            {{ $message->contenu }}
                                            @if($message->est_modifie)
                                                <small class="text-muted">(modifié)</small>
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour éditer un message -->
                    @if($message->user_id == auth()->id())
                    <div class="modal fade" id="editMessageModal{{ $message->id }}" tabindex="-1" aria-labelledby="editMessageModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMessageModalLabel">Modifier le message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('messages.update', $message->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <textarea class="form-control" name="contenu" rows="3" required>{{ $message->contenu }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted">Aucun message pour le moment. Soyez le premier à écrire !</p>
                    </div>
                @endforelse
            </div>
            <div class="card-footer px-3 py-3 border-top rounded-0">
                <form class="d-flex align-items-center" action="{{ route('user.messages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tontine_id" value="{{ $tontine->id ?? '' }}">

                    <div class="chat-attagement d-flex">
                        <a href="#" class="d-flex align-items-center pe-3"> 
                            <svg class="icon-24" width="24" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_156_599)">
                                    <path d="M20.4853 4.01473C18.2188 1.74823 15.2053 0.5 12 0.5C8.79469 0.5 5.78119 1.74823 3.51473 4.01473C1.24819 6.28119 0 9.29469 0 12.5C0 15.7053 1.24819 18.7188 3.51473 20.9853C5.78119 23.2518 8.79469 24.5 12 24.5C15.2053 24.5 18.2188 23.2518 20.4853 20.9853C22.7518 18.7188 24 15.7053 24 12.5C24 9.29469 22.7518 6.28119 20.4853 4.01473ZM12 23.0714C6.17091 23.0714 1.42856 18.3291 1.42856 12.5C1.42856 6.67091 6.17091 1.92856 12 1.92856C17.8291 1.92856 22.5714 6.67091 22.5714 12.5C22.5714 18.3291 17.8291 23.0714 12 23.0714Z" fill="currentcolor"></path>
                                    <path d="M9.40398 9.3309C8.23431 8.16114 6.33104 8.16123 5.16136 9.3309C4.88241 9.60981 4.88241 10.0621 5.16136 10.3411C5.44036 10.62 5.89266 10.62 6.17157 10.3411C6.78432 9.72836 7.78126 9.7284 8.39392 10.3411C8.53342 10.4806 8.71618 10.5503 8.89895 10.5503C9.08171 10.5503 9.26457 10.4806 9.40398 10.3411C9.68293 10.0621 9.68293 9.60986 9.40398 9.3309Z" fill="currentcolor"></path>
                                    <path d="M18.8384 9.3309C17.6688 8.16123 15.7655 8.16114 14.5958 9.3309C14.3169 9.60981 14.3169 10.0621 14.5958 10.3411C14.8748 10.62 15.3271 10.62 15.606 10.3411C16.2187 9.72836 17.2156 9.72831 17.8284 10.3411C17.9679 10.4806 18.1506 10.5503 18.3334 10.5503C18.5162 10.5503 18.699 10.4806 18.8384 10.3411C19.1174 10.0621 19.1174 9.60986 18.8384 9.3309Z" fill="currentcolor"></path>
                                    <path d="M18.3335 13.024H5.6668C5.2723 13.024 4.95251 13.3438 4.95251 13.7383C4.95251 17.6243 8.11409 20.7859 12.0001 20.7859C15.8862 20.7859 19.0477 17.6243 19.0477 13.7383C19.0477 13.3438 18.728 13.024 18.3335 13.024ZM12.0001 19.3573C9.14366 19.3573 6.77816 17.215 6.42626 14.4525H17.574C17.2221 17.215 14.8566 19.3573 12.0001 19.3573Z" fill="currentcolor"></path>
                                </g>
                                <defs>
                                    <clipPath>
                                        <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="#" class="d-flex align-items-center pe-3">
                            <svg class="icon-24" width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.00021 21.5V18.3391" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.00021 14.3481V14.3481C6.75611 14.3481 4.9384 12.5218 4.9384 10.2682V5.58095C4.9384 3.32732 6.75611 1.5 9.00021 1.5C11.2433 1.5 13.061 3.32732 13.061 5.58095V10.2682C13.061 12.5218 11.2433 14.3481 9.00021 14.3481Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M17 10.3006C17 14.7394 13.418 18.3383 9 18.3383C4.58093 18.3383 1 14.7394 1 10.3006" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M11.0689 6.25579H13.0585" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10.0704 9.59344H13.0605" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                    <input type="text" class="form-control me-3" name="contenu" placeholder="Tapez votre message" required>
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <svg class="icon-20" width="18" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.8325 6.67463L8.10904 12.4592L1.59944 8.38767C0.66675 7.80414 0.860765 6.38744 1.91572 6.07893L17.3712 1.55277C18.3373 1.26963 19.2326 2.17283 18.9456 3.142L14.3731 18.5868C14.0598 19.6432 12.6512 19.832 12.0732 18.8953L8.10601 12.4602" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg><span class="d-none d-lg-block ms-1">Envoyer</span>
                    </button>
                </form>
            </div> 
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Message copié !');
    }, function() {
        alert('Erreur lors de la copie');
    });
}
</script>
    </main>
    <!-- Wrapper End-->
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/libs.min.js"></script>
    <!-- Lodash Utility -->
    <script src="../assets/vendor/lodash/lodash.min.js"></script>
    <!-- Utilities Functions -->
    <script src="../assets/js/setting/utility.js"></script>
    <!-- Settings Script -->
    <script src="../assets/js/setting/setting.js"></script>
    <!-- Settings Init Script -->
    <script src="../assets/js/setting/setting-init.js" defer></script>
    <!-- slider JavaScript -->
    <script src="../assets/js/slider.js"></script>
    <!-- masonry JavaScript --> 
    <script src="../assets/js/masonry.pkgd.min.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/enchanter.js"></script>
    <!-- Sweet-alert Script -->
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js" async></script>
    <script src="../assets/js/sweet-alert.js" defer></script>
    <!-- Chart Custom JavaScript -->
    <!-- app JavaScript -->
    <script src="../assets/js/charts/weather-chart.js"></script>
    <script src="../assets/js/app.js"></script>
    <!-- Flatpickr Script -->
    <script src="../assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
    <!-- fslightbox Script -->
    <script src="../assets/js/fslightbox.js" defer></script> 
    <!-- vanilla Script -->
    <script src="../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
    <!--lottie Script -->
    <script src="../assets/js/lottie.js"></script>
    <!--select2 Script -->
    <script src="../assets/js/select2.js"></script>
    <!--ecommerce Script -->
    <script src="../assets/js/ecommerce.js"></script>
    
    <script src="../assets/js/chat.js" defer></script>  </body>
</html>


    
