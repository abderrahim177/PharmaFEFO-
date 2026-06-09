<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - PharmaStock</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2=family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 min-h-screen flex items-center justify-center p-4">

    <!-- LOGIN CONTAINER -->
    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl border border-slate-100 flex overflow-hidden min-h-[550px]">
        
        <!-- LEFT SIDE: BRAND CONTENT -->
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

        <!-- RIGHT SIDE: FORM -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            <div class="mb-8">
                <!-- Mobile Logo -->
                <div class="flex items-center gap-2 mb-4 md:hidden">
                    <i class="fa-solid fa-mortar-pestle text-teal-500 text-lg"></i>
                    <span class="text-base font-medium tracking-wide text-slate-900">PharmaStock</span>
                </div>
                <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Bienvenue</h1>
                <p class="text-xs text-slate-400 mt-1">Connectez-vous pour accéder à votre tableau de bord.</p>
            </div>

            <form action='../../src/controller/autoController.php' method="post" class="space-y-4">
                <!-- Identifiant / Email -->
                <div>
                    <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input name="email" type="email" placeholder="nom@clinique.ma" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <!-- Mot de passe -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider">Mot de passe</label>
                        <a href="#" class="text-[11px] text-teal-600 hover:underline">Oublié ?</a>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input name="password" type="password" placeholder="••••••••" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50 transition">
                    </div>
                </div>

                <!-- Se souvenir de moi -->
                <div class="flex items-center">
                    <input  type="checkbox" id="remember" class="w-4 h-4 rounded-sm border-slate-300 text-teal-600 focus:ring-teal-500/30 accent-teal-600">
                    <label Akses-for="remember" class="ml-2 text-xs text-slate-500 select-none cursor-pointer">Se souvenir de cet appareil</label>
                </div>

                <!-- Bouton Connexion -->
                <button name="submit" type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 rounded-lg transition text-sm cursor-pointer shadow-xs mt-2">
                    Se connecter
                </button>
            </form>

            <!-- Pied de page formulaire -->
            <p class="text-xs text-slate-400 text-center mt-8">
                Nouvel utilisateur ? <a href="#" class="text-teal-600 font-medium hover:underline">Demander un accès</a>
            </p>
        </div>

    </div>

</body>
</html>