<!doctype html>
<html lang="fr" class="theme-fs-md">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>🎲 Tirage au sort de la Tontine</title>
    <link rel="stylesheet" href="../assets/css/libs.min.css">
    <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />


  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
 



 <link rel="stylesheet"
     href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
     rel="stylesheet">

         <!-- flatpickr css -->
<style>

</style>

</head>
<body class="bg-light">
@include('layouts.sidebar')
@include('layouts.navbar')
    @php
        $userCanDraw = auth()->user()->hasRole('GERANT'); // Seuls les gérants peuvent tirer
    @endphp

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header bg-primary text-white py-2">
                <h1 class="card-title text-center mb-0">
                    <i class="fas fa-dice me-2"></i> Tirage au sort de la Tontine
                </h1>
            </div>
            <div class="card-body p-4">
            @if(auth()->user()->hasRole('GERANT'))
    <div class="text-center mb-5">
        <button id="drawButton" class="btn btn-primary btn-lg shadow px-5 py-3 rounded-pill animate__animated animate__pulse animate__infinite">
            <i class="fas fa-random me-2"></i> Lancer le tirage
        </button>
    </div>
@endif

                <div id="winnerSection" class="alert alert-success text-center py-4 px-5 position-relative {{ $dernierGagnant ? '' : 'd-none' }}">
                    <div class="confetti-container"></div>
                    <h2 class="mb-3"><i class="fas fa-trophy text-warning me-2"></i> Dernier Gagnant</h2>
                    <h3 id="winnerName" class="fw-bold display-5 my-3 animate__animated animate__tada">
                        {{ $dernierGagnant->user->prenom ?? '' }} {{ $dernierGagnant->user->nom ?? '' }}
                    </h3>
                    <div class="winner-badge position-absolute">
                        <i class="fas fa-crown"></i>
                    </div>
                </div>

                <!-- Section Participants -->
                <div class="mb-5 mt-4">
                    <h3 class="text-center mb-4 position-relative">
                        <span class="section-title">
                            <i class="fas fa-users me-2"></i> Participants
                        </span>
                    </h3>
                    
                    <div class="row justify-content-center">
                        @foreach ($participants as $participant)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card participant h-60 border-0 rounded-lg shadow-sm" 
                                    data-name="{{ $participant->user->prenom }} {{ $participant->user->nom }}">
                                    <div class="card-body text-center p-4">
                                        <div class="avatar-wrapper mb-3">
                                            <div class="avatar mx-auto">
                                                <div class="initials">
                                                    {{ substr($participant->user->prenom, 0, 1) }}{{ substr($participant->user->nom, 0, 1) }}
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="card-title fw-bold mb-1">{{ $participant->user->prenom }}</h5>
                                        <p class="card-text">{{ $participant->user->nom }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="my-5 gradient-hr">

                <!-- Section Historique -->
                <div class="history-section mt-5">
                    <h3 class="text-center mb-4">
                        <span class="section-title">
                            <i class="fas fa-history me-2"></i> Historique des gagnants
                        </span>
                    </h3>
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                        <ul class="list-group list-group-flush">
                            @foreach ($gagnants as $gagnant)
                                <li class="list-group-item py-3 history-item">
                                    <div class="d-flex align-items-center">
                                        <div class="medal-icon me-3">
                                            <i class="fas fa-medal text-warning"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $gagnant->user->prenom }} {{ $gagnant->user->nom }}</strong>
                                            <div class="text-muted small">
                                                <i class="far fa-calendar-alt me-1"></i> 
                                                {{ $gagnant->created_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($userCanDraw)
    <script>
        document.getElementById("drawButton").addEventListener("click", function() {
            let tontineId = 1;
            let winnerNameEl = document.getElementById("winnerName");
            let winnerSectionEl = document.getElementById("winnerSection");
            let participants = document.querySelectorAll(".participant");
            let drawButton = document.getElementById("drawButton");
            
            // Désactiver le bouton pendant le tirage
            drawButton.disabled = true;
            drawButton.classList.remove("animate__pulse", "animate__infinite");
            drawButton.classList.add("animate__tada");
            
            // Réinitialiser les styles précédents
            participants.forEach(p => p.classList.remove("border-success", "bg-light", "highlight", "zoom", "winner-card"));

            // Cacher temporairement la section gagnant pendant l'animation
            winnerSectionEl.classList.add("d-none");
            
            // Animation du tirage
            let animationInterval = setInterval(() => {
                let randomIndex = Math.floor(Math.random() * participants.length);
                let randomParticipant = participants[randomIndex];

                participants.forEach(p => p.classList.remove("highlight", "zoom"));
                randomParticipant.classList.add("highlight", "zoom");

                winnerNameEl.innerText = randomParticipant.getAttribute("data-name");
            }, 100);

            setTimeout(() => {
                clearInterval(animationInterval);
                
                // Effectuer le tirage réel via API
                fetch(`/tirage/${tontineId}`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.winner) {
                        // Afficher le gagnant
                        winnerNameEl.innerText = data.winner;
                        winnerSectionEl.classList.remove("d-none");
                        
                        // Créer l'effet de confettis
                        createConfetti();

                        // Mettre en évidence la carte du gagnant
                        let winnerElement = Array.from(participants).find(el => el.getAttribute("data-name") === data.winner);
                        if (winnerElement) {
                            winnerElement.classList.add("winner-card");
                            
                            // Faire défiler jusqu'au gagnant si nécessaire
                            winnerElement.scrollIntoView({ behavior: "smooth", block: "center" });
                        }
                    } else {
                        alert(data.message);
                    }
                    
                    // Réactiver le bouton
                    drawButton.disabled = false;
                    drawButton.classList.remove("animate__tada");
                    drawButton.classList.add("animate__pulse", "animate__infinite");
                })
                .catch(error => {
                    alert("Une erreur est survenue lors du tirage, veuillez réessayer.");
                    console.error("Erreur:", error);
                    
                    // Réactiver le bouton en cas d'erreur
                    drawButton.disabled = false;
                    drawButton.classList.remove("animate__tada");
                    drawButton.classList.add("animate__pulse", "animate__infinite");
                });
            }, 2000);
        });

        // Fonction pour créer l'effet de confettis
        function createConfetti() {
            const confettiContainer = document.querySelector('.confetti-container');
            confettiContainer.innerHTML = '';
            
            const colors = ['#ff4136', '#0074d9', '#2ecc40', '#ffdc00', '#b10dc9', '#ff851b'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confettiContainer.appendChild(confetti);
            }
        }
    </script>
    @endif

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Styles généraux */
        .card {
            transition: all 0.3s ease;
        }
        
        .section-title {
            position: relative;
            padding: 0.5rem 1.5rem;
            background-color: #f8f9fa;
            border-radius: 30px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            display: inline-block;
            font-size: 1.2rem;
        }
        
        .gradient-hr {
            height: 3px;
            background-image: linear-gradient(to right, transparent, #007bff, transparent);
            border: none;
            opacity: 0.3;
        }
        
        /* Styles pour le bouton de tirage */
        #drawButton {
            transition: all 0.3s ease;
            background-image: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
        }
        
        #drawButton:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,123,255,0.3) !important;
        }
        
        /* Styles pour la section gagnant */
        #winnerSection {
            border-radius: 15px;
            background-color: #d4edda;
            border-color: #c3e6cb;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .winner-badge {
            top: 10px;
            right: 10px;
            background-color: #ffc107;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        /* Styles pour les cartes de participants */
        .participant {
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .participant:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        .avatar-wrapper {
            perspective: 1000px;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
            transition: transform 0.5s;
        }
        
        .initials {
            font-size: 24px;
            font-weight: bold;
        }
        
        .participant:hover .avatar {
            transform: rotateY(180deg);
        }
        
        /* Styles pour l'animation du tirage */
        .highlight { 
            background-color: #fff5e6 !important; 
            transition: all 0.2s; 
            box-shadow: 0 0 20px rgba(255, 193, 7, 0.6) !important;
        }
        
        .zoom { 
            transform: scale(1.05); 
            z-index: 10;
        }
        
        .winner-card { 
            border: none !important;
            background: linear-gradient(145deg, #e9f7ef, #d4edda) !important; 
            box-shadow: 0 0 30px rgba(46, 204, 113, 0.5) !important;
            transform: scale(1.05);
            z-index: 20;
        }
        
        .winner-card .avatar {
            background-color: #28a745;
            transform: scale(1.1);
            animation: winner-pulse 2s infinite;
        }
        
        @keyframes winner-pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }
        
        /* Styles pour l'historique */
        .history-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .history-item:hover {
            background-color: #f8f9fa;
            border-left-color: #ffc107;
        }
        
        .medal-icon {
            width: 35px;
            height: 35px;
            background-color: #fff8e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Styles pour les confettis */
        .confetti-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 15px;
            background-color: #f00;
            opacity: 0.7;
            border-radius: 0;
            animation: fall 5s linear infinite;
        }
        
        @keyframes fall {
            0% {
                top: -50px;
                transform: rotate(0deg) translateX(0);
                opacity: 1;
            }
            100% {
                top: 100%;
                transform: rotate(360deg) translateX(100px);
                opacity: 0;
            }
        }
    </style>



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