
<!doctype html>
<html lang="en">
   <head>
  <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SocialV - Responsive Bootstrap 4 Admin Dashboard Template</title>
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/typography.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
    <div id="container-inside">
        <div id="circle-small"></div>
        <div id="circle-medium"></div>
        <div id="circle-large"></div>
        <div id="circle-xlarge"></div>
        <div id="circle-xxlarge"></div>
    </div>

    
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-md-6 text-center pt-5">
                <div class="sign-in-detail text-white">
                    <div class="owli" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                        <div class="item">                  
                            <h4 class="mb-1 text-white">A Propos</h4>
                            <p>Bienvenue sur notre plateforme de gestion de tontine ! Vous êtes à quelques clics de pouvoir suivre et gérer vos contributions et vos retraits dans le cadre de votre tontine. Notre objectif est de rendre vos transactions transparentes et sécurisées.</p>
                        </div>
                      
                        <div class="item">
                        <img src="{{asset('images/login/tontine.jpeg')}}" class="img-fluid mb-4" alt="logo">
                        <h4 class="mb-1 text-white">Sécurité et Simplicité</h4>
                            <p>Nous mettons un point d'honneur à garantir la sécurité de vos données personnelles et financières. Notre plateforme est simple d'utilisation, pour que vous puissiez gérer vos finances collectives sans souci.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 bg-white pt-5">
                <div class="sign-in-from">
                    <h1 class="mb-0">Accès à votre Compte</h1>
                    <p> Connectez-vous dès maintenant pour accéder à toutes les informations liées à votre tontine. Consultez l’historique de vos paiements, suivez l’évolution de votre épargne et effectuez vos actions rapidemen</p>
                    <form class="user" method="POST" action="{{ route('inscription.register') }}">
                                @csrf
                                <div class="form-group row">
                                    {{-- champs prénom --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="prenom" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre prénom"
                                            value="{{ old('prenom') }}">
                                        @error('prenom')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="nom" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre nom" value="{{ old('nom') }}">
                                        @error('nom')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- champs prénom --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Votre Email" value="{{ old('email') }}">
                                        @error('email')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="telephone" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre téléphone"
                                            value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="dateNaissance"
                                            class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Votre date de naissance" value="{{ old('dateNaissance') }}">

                                        @error('dateNaissance')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="adresse" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Votre adresse"
                                            value="{{ old('adresse') }}">
                                        @error('adresse')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="cni" class="form-control form-control-user"
                                        id="exampleFirstName" placeholder="Votre numéro national d'indentification"
                                        value="{{ old('cni') }}">
                                    @error('cni')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-user" id="exampleRepeatPassword"
                                            placeholder="Repeat Password">
                                        @error('password_confirmation')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                           
                        <div class="d-inline-block w-100">
                            <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                <input type="checkbox" class="custom-control-input" id="terms" required>
                                <label class="custom-control-label" for="terms">I accept <a href="#">Terms and Conditions</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Sign Up</button>
                        </div>
                        <div class="sign-info">
                            <span class="dark-color d-inline-block line-height-2">Already Have an Account? <a href="">Log In</a></span>
                            <ul class="iq-social-media">
                                <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


      </div>
    

    
  </body>
</html>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


    <!-- Backend Bundle JavaScript -->
<script src="{{ asset('assets/js/libs.min.js') }}"></script>

<script src="{{ asset('assets/vendor/lodash/lodash.min.js') }}"></script>

<!-- Utilities Functions -->
<script src="{{ asset('assets/js/setting/utility.js') }}"></script>

<!-- Settings Script -->
<script src="{{ asset('assets/js/setting/setting.js') }}"></script>

<!-- Settings Init Script -->
<script src="{{ asset('assets/js/setting/setting-init.js') }}" defer></script>

<!-- Slider JavaScript -->
<script src="{{ asset('assets/js/slider.js') }}"></script>

<!-- Masonry JavaScript --> 
<script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>

<!-- SweetAlert JavaScript -->
<script src="{{ asset('assets/js/enchanter.js') }}"></script>

<!-- Sweet-alert Script -->
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}" async></script>
<script src="{{ asset('assets/js/sweet-alert.js') }}" defer></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/js/charts/weather-chart.js') }}"></script>

<!-- App JavaScript -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Flatpickr Script -->
<script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>

<!-- fslightbox Script -->
<script src="{{ asset('assets/js/fslightbox.js') }}" defer></script> 

<!-- Vanilla Script -->
<script src="{{ asset('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Lottie Script -->
<script src="{{ asset('assets/js/lottie.js') }}"></script>

<!-- Select2 Script -->
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!-- eCommerce Script -->
<script src="{{ asset('assets/js/ecommerce.js') }}"></script>


</body>

</html>
