<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Introuvable - Pharmacy FEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pharmacy: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen overflow-hidden relative">

    <div class="absolute top-0 left-0 w-full h-full -z-10 overflow-hidden opacity-40">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-pharmacy-100 rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-emerald-100 rounded-full filter blur-3xl animate-bounce delay-1000"></div>
    </div>

    <div class="max-w-xl w-full mx-4 text-center p-8 md:p-12 bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-100">
        
        <h1 class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-700 tracking-widest animate-bounce">
            404
        </h1>

        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full text-red-600 my-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-slate-800 mb-2">
            Oups ! Page introuvable
        </h2>
        
        <p class="text-slate-500 mb-8 max-w-sm mx-auto text-sm md:text-base">
            Désolé, la page que vous recherchez n'existe pas ou a été déplacée. Vérifiez l'URL ou retournez à votre espace.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <?php if (isset($_SESSION['user_id'])): ?>
            <?php else: ?>
                <a href="login.php" class="px-6 py-3 bg-pharmacy-600 hover:bg-pharmacy-700 text-white font-medium rounded-xl shadow-md shadow-pharmacy-100 transition-all duration-200 inline-flex items-center justify-center gap-2">
                    Se connecter
                </a>
            <?php endif; ?>

            <button onclick="window.history.back()" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition-all duration-200">
                Page précédente
            </button>
        </div>

        <div class="mt-12 text-xs text-slate-400 font-medium tracking-wide uppercase">
            Pharmacy FEFO System &copy; <?= date('Y') ?>
        </div>
    </div>

</body>
</html>