<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PharmaStock</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; font-weight: 400; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-950 text-slate-400 flex flex-col justify-between p-4 hidden md:flex">
        <div>
            <div class="flex items-center gap-3 px-2 py-4 border-b border-slate-900">
                <i class="fa-solid fa-key text-indigo-400 text-xl"></i>
                <span class="text-lg font-medium tracking-wide text-white">PharmaStock</span>
            </div>
            <nav class="mt-6 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-700 rounded-lg text-white font-medium transition">
                    <i class="fa-solid fa-gears w-5 text-sm"></i> Configuration
                </a>
                <a href="table_users.php" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-900 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-users-gear w-5 text-sm"></i> Utilisateurs
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-900 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-database w-5 text-sm"></i> Base Claude Bernard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-900 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-file-invoice-dollar w-5 text-sm"></i> Pertes Financières
                </a>
            </nav>
        </div>
        <div class="border-t border-slate-900 pt-4 flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-sm font-medium text-white">AD</div>
            <div>
                <p class="text-sm font-medium text-slate-200">Admin Principal</p>
                <p class="text-xs text-indigo-400">Console Root</p>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-lg font-medium text-slate-800">Console d'Administration</h1>
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 uppercase tracking-wider">
                <span class="h-2 w-2 bg-emerald-500 rounded-full"></span> Claude Bernard connecté
            </div>
        </header>

        <!-- CONTAINER -->
        <div class="p-6 space-y-6 max-w-7xl w-full mx-auto">
            
            <!-- RAPPORT FINANCIER MENSUEL DES PERTES -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 pb-4 mb-4 gap-4">
                    <div>
                        <h3 class="text-base font-medium text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-indigo-600 text-sm"></i> Analyse Financière du Gaspillage
                        </h3>
                        <p class="text-xs text-slate-400">Lots basculés en statut expiré ce mois-ci.</p>
                    </div>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1.5 px-3 rounded-lg text-xs flex items-center gap-2 transition cursor-pointer">
                        <i class="fa-solid fa-file-export text-[10px]"></i> Exporter le Rapport
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-slate-50/50 p-4 rounded-lg border border-slate-100">
                        <span class="text-xs text-slate-400 block uppercase tracking-wider">Valeur Perdue</span>
                        <span class="text-xl font-semibold text-rose-600 mt-1 block">4 210,50 DH</span>
                    </div>
                    <div class="bg-slate-50/50 p-4 rounded-lg border border-slate-100">
                        <span class="text-xs text-slate-400 block uppercase tracking-wider">Boîtes Détruites</span>
                        <span class="text-xl font-semibold text-slate-800 mt-1 block">142 Unités</span>
                    </div>
                    <div class="bg-slate-50/50 p-4 rounded-lg border border-slate-100">
                        <span class="text-xs text-slate-400 block uppercase tracking-wider">Efficacité FEFO</span>
                        <span class="text-xl font-semibold text-emerald-600 mt-1 block">96.4 %</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- ACCÈS ACTEURS -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs">
                    <h3 class="text-base font-medium text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-user-shield text-slate-500 text-sm"></i> Droits d'Accès Système
                    </h3>
                    <div class="space-y-2.5">
                        <div class="p-2.5 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50/30">
                            <div>
                                <p class="text-xs font-medium text-slate-700">Préparateur / Gestionnaire</p>
                                <p class="text-[11px] text-slate-400">Réception, Scan Lot, Sorties FEFO</p>
                            </div>
                            <span class="text-[10px] text-teal-700 bg-teal-50 px-2 py-0.5 rounded-sm font-medium">Actif</span>
                        </div>
                        <div class="p-2.5 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50/30">
                            <div>
                                <p class="text-xs font-medium text-slate-700">Pharmacien / Biologiste</p>
                                <p class="text-[11px] text-slate-400">Validation, Retours, Configuration seuils</p>
                            </div>
                            <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-sm font-medium">Actif</span>
                        </div>
                    </div>
                </div>

                <!-- INTEGRATION CLAUDE BERNARD -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-medium text-slate-800 mb-1 flex items-center gap-2">
                            <i class="fa-solid fa-cloud-arrow-down text-indigo-600 text-sm"></i> Base Claude Bernard
                        </h3>
                        <p class="text-xs text-slate-400 mb-4">Synchronisation automatique des monographies et interactions.</p>
                        
                        <div class="bg-indigo-50/50 border border-indigo-100/60 p-3.5 rounded-lg text-xs text-indigo-900">
                            Synchronisation globale effectuée ce jour à 04:00 AM.
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button class="flex-1 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium py-2 rounded-lg transition cursor-pointer">
                            Forcer Sync
                        </button>
                        <button class="border border-slate-200 text-slate-600 text-xs font-medium py-2 px-3 rounded-lg hover:bg-slate-50 transition cursor-pointer">
                            Logs API
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>