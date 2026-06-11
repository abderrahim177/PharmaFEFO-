<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2=family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl border border-slate-100 flex overflow-hidden min-h-[550px]">
        
        <div class="w-1/2 bg-slate-900 p-10 flex-col justify-between text-slate-300 hidden md:flex">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-mortar-pestle text-teal-400 text-xl"></i>
                <span class="text-lg font-medium tracking-wide text-white">PharmaStock</span>
            </div>
            
            <div class="space-y-3">
                <h2 class="text-2xl font-medium text-white tracking-tight">Gestion intelligente des stocks & FEFO.</h2>
                <p class="text-sm text-slate-400 leading-relaxed">Accédez à votre espace sécurisé pour gérer les réceptions, suivre les péremptions et optimiser la dispensation.</p>
            </div>

            <div class="text-xs text-slate-500">
                &copy; 2026 PharmaStock. Tous droits réservés.
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-4 md:hidden">
                    <i class="fa-solid fa-mortar-pestle text-teal-500 text-lg"></i>
                    <span class="text-base font-medium tracking-wide text-slate-900">PharmaStock</span>
                </div>
                <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Bienvenue</h1>
                <p class="text-xs text-slate-400 mt-1">Connectez-vous pour accéder à votre tableau de bord.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <?php 
                    $error_msg = "Une erreur est survenue.";
                    if ($_GET['error'] == 'email_not_found') {
                        $error_msg = "Cette adresse email n'existe pas dans notre système.";
                    } elseif ($_GET['error'] == 'bad_password') {
                        $error_msg = "Le mot de passe que vous avez saisi est incorrect.";
                    } elseif ($_GET['error'] == 'empty') {
                        $error_msg = "Veuillez remplir tous les champs obligatoires.";
                    } elseif ($_GET['error'] == 'role_not_assigned') {
                        $error_msg = "Votre compte n'a pas de rôle valide assigné.";
                    } elseif ($_GET['error'] == 'server_error') {
                        $error_msg = "Erreur de connexion au serveur. Veuillez réessayer.";
                    }
                ?>
                <div id="error-box" class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 p-3.5 rounded-xl text-xs transition-all duration-300 opacity-100 scale-100">
                    <i class="fa-solid fa-circle-exclamation text-red-500 text-sm mt-0.5"></i>
                    <div>
                        <span class="font-semibold block mb-0.5">Erreur d'authentification</span>
                        <p class="text-red-600/90 leading-relaxed"><?= htmlspecialchars($error_msg); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <form action='../../src/controller/autoController.php' method="post" class="space-y-4">
                <div>
                    <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input id="email" name="email" type="email" placeholder="nom@clinique.ma" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider">Mot de passe</label>
                        <a href="#" class="text-[11px] text-teal-600 hover:underline">Oublié ?</a>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input id="password" name="password" type="password" placeholder="••••••••" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 rounded-sm border-slate-300 text-teal-600 focus:ring-teal-500/30 accent-teal-600">
                    <label for="remember" class="ml-2 text-xs text-slate-500 select-none cursor-pointer">Se souvenir de cet appareil</label>
                </div>

                <button name="submit" type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 rounded-lg transition text-sm cursor-pointer shadow-xs mt-2">
                    Se connecter
                </button>
            </form>

            <p class="text-xs text-slate-400 text-center mt-8">
                Nouvel utilisateur ? <a href="#" class="text-teal-600 font-medium hover:underline">Demander un accès</a>
            </p>
        </div>

    </div>

    <script>
        const errorBox = document.getElementById('error-box');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function hideError() {
            if (errorBox) {
                // Animation smooth dyal l-khtifa2
                errorBox.classList.remove('opacity-100', 'scale-100');
                errorBox.classList.add('opacity-0', 'scale-95');
                
                setTimeout(() => {
                    errorBox.style.display = 'none';
                }, 300);
            }
        }

        // Daba mli l-inputs 3ndhom l-id, had l-events ghadi ikhdmou perfectly
        if (emailInput) {
            emailInput.addEventListener('input', hideError);
        }
        if (passwordInput) {
            passwordInput.addEventListener('input', hideError);
        }
    </script>
</body>
</html>