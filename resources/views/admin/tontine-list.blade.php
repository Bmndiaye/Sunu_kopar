
<!doctype html>
<html lang="en" class="theme-fs-md" data-bs-theme-color="default" dir="ltr">

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
  <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" /></head>

<body class=" ">
  <!-- loader Start -->
  <div id="loading">
        <div id="loading-center">
        </div>
  </div>
  <!-- loader END -->
  <!-- Wrapper Start -->


  <main class="main-content">
    <div class="position-relative">
      <div class="iq-top-navbar border-bottom">
     
      </div>      <div>
        <div class="position-relative">
        </div>
        <div class="content-inner " id="page_layout">
<div class="container">
   <div class="row">
       <div class="mb-2">
           <h4>Bienvenu</h4>
            <p>Listes Des Tontines</p>
       </div>
      <div class="col-sm-6 col-md-4">

        <div class="card cardhover">
          <div class="card-body">
             <!-- Image placeholder -->
             <div class="mb-3">
                <div style="background-color: #f2f2f2; width: 200px; height: 120px; display: flex; justify-content: center; align-items: center; color: #999;">
                   200x120
                </div>
             </div>
             <!-- Status badge -->
             <h5 class="badge bg-success text-white">Terminée</h5>
             <!-- Tontine title -->
             <h3 class="mt-2">Tontine Familiale</h3>
             <!-- Creator info -->
             <p class="text-muted">Créée par Fatou Sow</p>
             <!-- Description -->
             <div class="mt-2">
                <p class="mb-0">Tontine entre membres de la famille avec cotisation de 25,000 FCFA par mois.</p>
             </div>
             <!-- Participants and amount -->
             <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="bg-light p-2 rounded">
                   <strong>8 participants</strong><br>
                   <strong>200,000 FCFA / tour</strong>
                </div>
                <!-- Eye icon -->
                <div class="border rounded p-2">
                   <i class="material-symbols-outlined">visibility</i>
                </div>
             </div>
          </div>
       </div>
        
      </div>

      
      <div class="col-sm-6 col-md-4">
        <div class="card cardhover">
          <div class="card-body">
             <!-- Image placeholder -->
             <div class="mb-3">
                <div style="background-color: #f2f2f2; width: 200px; height: 120px; display: flex; justify-content: center; align-items: center; color: #999;">
                   200x120
                </div>
             </div>
             <!-- Status badge -->
             <h5 class="badge bg-info text-white">En cours</h5>
             <!-- Tontine title -->
             <h3 class="mt-2">Tontine Mensuelle</h3>
             <!-- Creator info -->
             <p class="text-muted">Créée par Amadou Diop</p>
             <!-- Description -->
             <div class="mt-2">
                <p class="mb-0">Tontine mensuelle avec versement de 50,000 FCFA par membre. Tour actuel: 3/12</p>
             </div>
             <!-- Participants and amount -->
             <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="bg-light p-2 rounded">
                   <strong>15 participants</strong><br>
                   <strong>750,000 FCFA / tour</strong>
                </div>
                <!-- Eye icon -->
                <div class="border rounded p-2">
                   <i class="material-symbols-outlined">visibility</i>
                </div>
             </div>
          </div>
       </div>
       
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card cardhover">
          <div class="card-body">
             <!-- Image placeholder -->
             <div class="mb-3">
                <div style="background-color: #f2f2f2; width: 200px; height: 120px; display: flex; justify-content: center; align-items: center; color: #999;">
                   200x120
                </div>
             </div>
             <!-- Status badge -->
             <h5 class="badge bg-danger text-white">En attend</h5>
             <!-- Tontine title -->
             <h3 class="mt-2">Tontine Mensuelle</h3>
             <!-- Creator info -->
             <p class="text-muted">Créée par Amadou Diop</p>
             <!-- Description -->
             <div class="mt-2">
                <p class="mb-0">Tontine mensuelle avec versement de 50,000 FCFA par membre. Tour actuel: 3/12</p>
             </div>
             <!-- Participants and amount -->
             <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="bg-light p-2 rounded">
                   <strong>15 participants</strong><br>
                   <strong>750,000 FCFA / tour</strong>
                </div>
                <!-- Eye icon -->
                <div class="border rounded p-2">
                 
                   <a href="{{route('admin.detailTontine')}}">
                   <i class="material-symbols-outlined">visibility
                
                </i>

                    
</a>
                </div>
             </div>
          </div>
       </div>
       
      </div>
   </div>

</div>
        </div>
      </div>

      
        </div>
  </main>

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
  

</body>

</html>