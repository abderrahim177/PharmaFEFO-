<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-4 md:hidden">
                    <i class="fa-solid fa-mortar-pestle text-teal-500 text-lg"></i>
                    <span class="text-base font-medium tracking-wide text-slate-900">PharmaStock</span>
                </div>
                <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Bienvenue</h1>
                <p class="text-xs text-slate-400 mt-1">Connectez-vous pour accéder à votre tableau de bord.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="mb-4 p-3 rounded-lg border text-[11px] font-medium flex items-center gap-2 transition">
                    <?php 
                        switch ($_GET['error']) {
                            case 'empty':
                                echo '<div class="bg-amber-50 border-amber-200 text-amber-700 w-full flex items-center gap-2 p-1 rounded"><i class="fa-solid fa-circle-exclamation"></i> Veuillez remplir tous les champs.</div>';
                                break;
                            case 'wrong_credentials':
                                echo '<div class="bg-rose-50 border-rose-200 text-rose-700 w-full flex items-center gap-2 p-1 rounded"><i class="fa-solid fa-circle-xmark"></i> Email ou mot de passe incorrect.</div>';
                                break;
                            case 'account_inactive':
                                echo '<div class="bg-amber-50 border-amber-200 text-amber-700 w-full flex items-center gap-2 p-1 rounded"><i class="fa-solid fa-user-lock"></i> Votre compte est actuellement inactif. Contactez l\'admin.</div>';
                                break;
                            case 'role_not_assigned':
                                echo '<div class="bg-rose-50 border-rose-200 text-rose-700 w-full flex items-center gap-2 p-1 rounded"><i class="fa-solid fa-triangle-exclamation"></i> Rôle non reconnu ou non assigné.</div>';
                                break;
                            case 'server_error':
                                echo '<div class="bg-rose-50 border-rose-200 text-rose-700 w-full flex items-center gap-2 p-1 rounded"><i class="fa-solid fa-server"></i> Erreur serveur. Veuillez réessayer plus tard.</div>';
                                break;
                        }
                    ?>
                </div>
            <?php endif; ?>

            <form action='../../src/controller/autoController.php' method="post" class="space-y-4">
                <div>
                    <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input name="email" type="email" required placeholder="nom@clinique.ma" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider">Mot de passe</label>
                        <a href="#" class="text-[11px] text-teal-600 hover:underline">Oublié ?</a>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input name="password" type="password" required placeholder="••••••••" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 rounded-sm border-slate-300 text-teal-600 focus:ring-teal-500/30 accent-teal-600">
                    <label for="remember" class="ml-2 text-xs text-slate-500 select-none cursor-pointer">Se souvenir de cet appareil</label>
                </div>

                <button name="submit" type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 rounded-lg transition text-sm cursor-pointer shadow-sm mt-2">
                    Se connecter
                </button>
            </form>

            <p class="text-xs text-slate-400 text-center mt-8">
                Nouvel utilisateur ? <a href="#" class="text-teal-600 font-medium hover:underline">Demander un accès</a>
            </p>
        </div>

    </div>

</body>
</html>