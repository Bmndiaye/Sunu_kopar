<!doctype html>
<html lang="en" class="theme-fs-md">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>🎲 Tirage au sort de la Tontine</title>
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

    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">🎲 Tirage au sort de la Tontine</h1>

                <div class="text-center mb-4">
                    <button id="drawButton" class="btn btn-primary btn-lg">
                        🎉 Lancer le tirage
                    </button>
                </div>

                <div id="winnerSection" class="alert alert-success text-center d-none">
                    <h2>🎊 Gagnant :</h2>
                    <h3 id="winnerName" class="fw-bold"></h3>
                </div>

                <div class="row">
                @foreach ($participants as $participant)
                    <div class="col-md-4">
                        <div class="card participant shadow-sm mb-3" data-name="{{ $participant->user->prenom }} {{ $participant->user->nom }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $participant->user->prenom }} {{ $participant->user->nom }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById("drawButton").addEventListener("click", function() {
        let tontineId = 1; // Remplace par l'ID réel de la tontine
        let winnerNameEl = document.getElementById("winnerName");
        let winnerSectionEl = document.getElementById("winnerSection");
        let participants = document.querySelectorAll(".participant");

        // Réinitialisation des styles
        participants.forEach(p => p.classList.remove("border-success", "bg-light", "highlight", "zoom"));

        // Animation de tirage au sort
        let animationInterval = setInterval(() => {
            let randomIndex = Math.floor(Math.random() * participants.length);
            let randomParticipant = participants[randomIndex];

            // Ajout d'une classe temporaire pour l'effet visuel
            participants.forEach(p => p.classList.remove("highlight", "zoom"));
            randomParticipant.classList.add("highlight", "zoom");

            winnerNameEl.innerText = randomParticipant.getAttribute("data-name");
        }, 100);

        // Arrêt de l'animation et envoi de la requête après 2 secondes
        setTimeout(() => {
            clearInterval(animationInterval);

            fetch(`/tirage/${tontineId}`, {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            })
            .then(response => response.json())
            .then(data => {
                if (data.winner) {
                    winnerNameEl.innerText = data.winner;
                    winnerSectionEl.classList.remove("d-none");

                    // Mettre en évidence le gagnant
                    let winnerElement = Array.from(participants).find(el => el.getAttribute("data-name") === data.winner);
                    if (winnerElement) {
                        winnerElement.classList.add("border-success", "bg-light");
                    }
                } else {
                    alert(data.message); // Message si plus de participants disponibles
                }
            })
            .catch(error => {
                alert("Une erreur est survenue lors du tirage, veuillez réessayer.");
                console.error("Erreur:", error);
            });
        }, 2000);
    });
    </script>

    <style>
        .highlight {
            background-color: yellow !important;
            transition: background-color 0.2s ease-in-out;
        }

        .zoom {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .border-success {
            border: 2px solid green;
        }

        .bg-light {
            background-color: lightgreen !important;
        }
    </style>

    <script src="../assets/js/libs.min.js"></script>
    <script src="../assets/js/app.js"></script>

  </body>
</html>
