<!doctype html>
<html lang="en" class="theme-fs-md">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Responsive Bootstrap 5 Admin Dashboard</title>
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../assets/css/libs.min.css">
    <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
  </head>
  <body>
    <div class="wrapper">
      <section class="sign-in-page">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-md-6 overflow-hidden position-relative">
              <div class="bg-primary w-100 h-100 position-absolute top-0 bottom-0 start-0 end-0"></div>
              <div class="container-inside z-1">
                <div class="main-circle circle-small"></div>
                <div class="main-circle circle-medium"></div>
                <div class="main-circle circle-large"></div>
                <div class="main-circle circle-xlarge"></div>
                <div class="main-circle circle-xxlarge"></div>
              </div>
              <div class="sign-in-detail container-inside-top">
                <div class="swiper swiper-general overflow-hidden" data-slide="1" data-laptop="1" data-tab="1" data-mobile="1" data-mobile-sm="1" data-autoplay="true" data-loop="true" data-navigation="false" data-pagination="true" data-space="16">
                  <ul class="swiper-wrapper list-inline m-0 p-0">
                    <li class="swiper-slide">
                      <img src="../assets/images/login/1.jpg" class="signin-img img-fluid mb-5 rounded-3" alt="image">
                      <h2 class="mb-3 text-white fw-semibold">Power UP Your Friendship</h2>
                      <p class="font-size-16 text-white mb-0">It is a long established fact that a reader will be<br/> distracted by the readable content.</p>
                    </li>
                    <li class="swiper-slide">
                      <img src="../assets/images/login/2.jpg" class="signin-img img-fluid mb-5 rounded-3" alt="image"> 
                      <h2 class="mb-3 text-white fw-semibold">Connect with the world</h2>
                      <p class="font-size-16 text-white mb-0">It is a long established fact that a reader will be<br/> distracted by the readable content.</p>
                    </li>
                    <li class="swiper-slide">
                      <img src="../assets/images/login/3.jpg" class="signin-img img-fluid mb-5 rounded-3" alt="image">
                      <h2 class="mb-3 text-white fw-semibold">Together Is better</h2>
                      <p class="font-size-16 text-white mb-0">It is a long established fact that a reader will be<br/> distracted by the readable content.</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="sign-in-from text-center">
                <a href="../index.html" class="d-inline-flex align-items-center justify-content-center gap-2">
                  <h2 class="logo-title">Tontine</h2>
                </a>
                <p class="mt-3 font-size-16">Welcome to Tontine, a platform to connect with<br/> the social world</p>
                
                <!-- Formulaire de connexion -->
                <form method="POST" action="{{ route('auth.store') }}" class="mt-5">
                  @csrf  <!-- Token CSRF pour la sécurité -->
                  
                  <!-- Affichage des erreurs -->
                  @if(session('error'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                  @endif

                  <div class="form-group text-start">
                    <h6 class="form-label fw-bold">Email Address</h6>
                    <input type="email" name="email" class="form-control mb-0" placeholder="Your Email" value="{{ old('email') }}" required>
                  </div>

                  <div class="form-group text-start">
                    <h6 class="form-label fw-bold">Your Password</h6>
                    <input type="password" name="password" class="form-control mb-0" placeholder="Password" required>
                  </div>

                  <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check d-inline-block m-0">
                      <input type="checkbox" class="form-check-input">
                      <h6 class="form-check-label fw-500 font-size-14">I accept <a class="fw-light ms-1">Terms and Conditions</a></h6>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary mt-4 fw-semibold text-uppercase w-100">Sign In</button>

                  <h6 class="mt-5">Don't have an account? <a href="">Sign Up</a></h6>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/libs.min.js"></script>
    <script src="../assets/js/app.js"></script>
  </body>
</html>
