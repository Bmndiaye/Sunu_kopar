<!-- resources/views/tirage/index.blade.php -->
<!doctype html>
<html lang="fr" class="theme-fs-md">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>🎲 Tirage au sort de la Tontine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --info-color: #17a2b8;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f0f2f5;
            color: #444;
        }
        
        .app-container {
            max-width: 1200px;
            margin: 2rem auto;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 1.2rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-primary:disabled {
            background: linear-gradient(135deg, #6c757d, #495057);
            cursor: not-allowed;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            padding: 0 15px;
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        .section-title:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, transparent, var(--primary-color), transparent);
        }
        
        /* Styles pour les cartes de participants */
        .participant-card {
            transition: all 0.3s ease;
        }
        
        .participant {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
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
            background-color: var(--success-color);
            transform: scale(1.1);
            animation: winner-pulse 2s infinite;
        }
        
        @keyframes winner-pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }
        
        /* Styles pour la section gagnant */
        .winner-section {
            background-color: #d4edda;
            border-color: #c3e6cb;
            border-radius: 15px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .winner-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--warning-color);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
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
        
        /* Style pour l'historique */
        .history-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .history-item:hover {
            background-color: #f8f9fa;
            border-left-color: var(--warning-color);
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
        
        .nav-tabs {
            border-bottom: none;
        }
        
        .nav-tabs .nav-link {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            margin-right: 0.5rem;
            color: var(--dark-color);
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
        
        .nav-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }
        
        .tab-content {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            text-align: center;
            color: var(--secondary-color);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="card shadow-lg mb-4">
            <div class="card-header">
                <h1 class="card-title text-center mb-0">
                    <i class="fas fa-dice me-2"></i> Tirage au sort de la Tontine
                </h1>
            </div>
            <div class="card-body p-4">
                @if(auth()->user()->hasRole('GERANT'))
                <div class="tontine-selection mb-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm rounded-lg">
                                <div class="card-body">
                                    <h4 class="text-center mb-3">
                                        <i class="fas fa-hand-pointer me-2"></i> Sélection de la tontine
                                    </h4>
                                    <div class="form-group">
                                        <select id="tontineSelect" class="form-select form-select-lg">
                                            <option value="">-- Sélectionner une tontine --</option>
                                            @foreach ($tontines as $tontine)
                                                <option value="{{ $tontine->id }}">{{ $tontine->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mb-5">
                    <button id="drawButton" class="btn btn-primary btn-lg animate__animated animate__pulse animate__infinite" disabled>
                        <i class="fas fa-random me-2"></i> Lancer le tirage
                    </button>
                </div>
                @endif

                <div id="winnerSection" class="winner-section {{ $dernierGagnant ? '' : 'd-none' }} mb-5">
                    <div class="confetti-container"></div>
                    <h2 class="mb-3"><i class="fas fa-trophy text-warning me-2"></i> Dernier Gagnant</h2>
                    <h3 id="winnerName" class="fw-bold display-5 my-3 animate__animated animate__tada">
                        {{ $dernierGagnant->user->prenom ?? '' }} {{ $dernierGagnant->user->nom ?? '' }}
                    </h3>
                    <div class="winner-badge">
                        <i class="fas fa-crown"></i>
                    </div>
                    <p id="tontineName" class="text-muted mt-2">
                        @if($dernierGagnant && $dernierGagnant->tontine)
                            Tontine: {{ $dernierGagnant->tontine->nom }}
                        @endif
                    </p>
                </div>

                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="participants-tab" data-bs-toggle="tab" data-bs-target="#participants" type="button" role="tab" aria-controls="participants" aria-selected="true">
                            <i class="fas fa-users me-2"></i> Participants
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">
                            <i class="fas fa-history me-2"></i> Historique
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="participants" role="tabpanel" aria-labelledby="participants-tab">
                        <h3 class="section-title text-center mb-4">
                            <span id="participantsTitle">Participants</span>
                        </h3>
                        
                        @foreach ($participants as $participant)
    @if ($participant->user)
        <div class="col-lg-4 col-md-6 mb-4 participant-card" data-tontine-id="{{ $participant->tontine?->id ?? 'inconnue' }}">
            <div class="card participant h-100" data-name="{{ $participant->user->prenom }} {{ $participant->user->nom }}">
                <div class="card-body text-center p-4">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar">
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
    @endif
@endforeach

                    </div>
                    
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <h3 class="section-title text-center mb-4">
                            Historique des gagnants
                        </h3>
                        
                        @if($gagnants->isEmpty())
                            <div class="empty-state">
                                <i class="fas fa-history"></i>
                                <h4>Aucun tirage effectué</h4>
                                <p>L'historique des tirages s'affichera ici</p>
                            </div>
                        @else
                            <div class="list-group" id="historyList">
                                @foreach ($gagnants as $gagnant)
                                    <div class="list-group-item history-item" data-tontine-id="{{ $gagnant->idtontine }}">
                                        <div class="d-flex align-items-center">
                                            <div class="medal-icon me-3">
                                                <i class="fas fa-medal text-warning"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $gagnant->user->prenom }} {{ $gagnant->user->nom }}</h5>
                                                <p class="mb-0 text-muted">
                                                    <small>
                                                        <i class="fas fa-calendar-alt me-1"></i> {{ $gagnant->created_at->format('d/m/Y à H:i') }}
                                                        <i class="fas fa-tag ms-2 me-1"></i> {{ $gagnant->tontine->nom }}
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
       // Fixed JavaScript for tontine draw functionality
$(document).ready(function() {
    // CSRF Token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Tontine selection handling
    $('#tontineSelect').on('change', function() {
        const tontineId = $(this).val();
        
        // Enable/disable draw button
        if (tontineId) {
            $('#drawButton').prop('disabled', false);
            $('#participantsTitle').text('Participants de la tontine');
        } else {
            $('#drawButton').prop('disabled', true);
            $('#participantsTitle').text('Participants');
        }
        
        // Filter displayed participants
        $('.participant-card').each(function() {
            if (tontineId === '' || $(this).data('tontine-id') == tontineId) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        
        // Filter draw history
        $('.history-item').each(function() {
            if (tontineId === '' || $(this).data('tontine-id') == tontineId) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Draw animation and execution
    $('#drawButton').on('click', function() {
        const tontineId = $('#tontineSelect').val();
        
        if (!tontineId) {
            alert('Veuillez sélectionner une tontine');
            return;
        }
        
        // Disable button during draw
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Tirage en cours...');
        
        // Random selection animation
        const participants = $('.participant-card:visible');
        let count = 0;
        const maxCount = 15; // Number of iterations for animation
        let interval;
        
        // Function to highlight a random participant
        function highlightRandom() {
            // Reset all participants
            $('.participant-card .card').removeClass('highlight zoom');
            
            // Select a random participant
            const randomIndex = Math.floor(Math.random() * participants.length);
            $(participants[randomIndex]).find('.card').addClass('highlight zoom');
            
            count++;
            
            // End animation, perform actual draw
            if (count >= maxCount) {
                clearInterval(interval);
                
                // AJAX call to perform draw
                $.ajax({
                    url: `/tirage/effectuer/${tontineId}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Reset all cards
                            $('.participant-card .card').removeClass('highlight zoom winner-card');
                            
                            // Highlight winner
                            const winnerName = response.winner;
                            const winnerCard = $(`.card[data-name="${winnerName}"]`);
                            
                            winnerCard.addClass('winner-card');
                            
                            // Update winner section
                            $('#winnerName').text(winnerName);
                            $('#tontineName').text('Tontine: ' + response.tontine);
                            $('#winnerSection').removeClass('d-none');
                            
                            // Create confetti
                            createConfetti();
                            
                            // Reload page after delay to update history
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        } else {
                            alert('Erreur lors du tirage: ' + response.message);
                            $('#drawButton').prop('disabled', false).html('<i class="fas fa-random me-2"></i> Lancer le tirage');
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'Une erreur est survenue lors du tirage.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        
                        alert(errorMsg);
                        $('#drawButton').prop('disabled', false).html('<i class="fas fa-random me-2"></i> Lancer le tirage');
                    }
                });
            }
        }
        
        // Start animation
        interval = setInterval(highlightRandom, 200);
    });
    
    // Function to create confetti effect
    function createConfetti() {
        const confettiContainer = $('.confetti-container');
        const colors = ['#f94144', '#f3722c', '#f8961e', '#f9c74f', '#90be6d', '#43aa8b', '#577590'];
        
        // Clear existing confetti
        confettiContainer.empty();
        
        // Create 100 confetti pieces
        for (let i = 0; i < 100; i++) {
            const left = Math.random() * 100;
            const width = Math.random() * 8 + 5;
            const height = width * 1.5;
            const bg = colors[Math.floor(Math.random() * colors.length)];
            const delay = Math.random() * 5;
            
            const confetti = $('<div>').addClass('confetti').css({
                'left': left + '%',
                'width': width + 'px',
                'height': height + 'px',
                'background-color': bg,
                'animation-delay': delay + 's'
            });
            
            confettiContainer.append(confetti);
        }
    }
    
    // Create confetti if a winner is displayed
    if (!$('#winnerSection').hasClass('d-none')) {
        createConfetti();
    }
});
    </script>
</body>
</html>