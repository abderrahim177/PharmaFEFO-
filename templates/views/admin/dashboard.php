<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PharmaStock</title>
    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Inter (Plus moderne et compact que Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-sm">

    <!-- SIDEBAR -->
    <aside class="w-60 bg-slate-900 text-slate-400 flex flex-col justify-between hidden md:flex border-r border-slate-800 shrink-0">
        <div>
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-800/60">
                <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-xs">
                    <i class="fa-solid fa-prescription-bottle-medical text-xs"></i>
                </div>
                <span class="text-sm font-semibold tracking-tight text-white">PharmaStock</span>
            </div>
            
            <nav class="mt-4 px-3 space-y-0.5">
                <a href="dashboard.php" class="flex items-center justify-between px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-gears text-xs opacity-70"></i> Dashboard
                    </div>
                </a>
                <a href="table_users.php" class="flex items-center justify-between px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-users-gear text-xs opacity-70"></i> Users
                    </div>
                </a>
                <a href="Medication.php" class="flex items-center justify-between px-3 py-2 bg-indigo-600/10 text-indigo-400 rounded-md font-medium text-xs transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-database text-xs"></i> Medication Management 
                    </div>
                    <span class="text-[10px] bg-emerald-500/10 text-emerald-400 px-1.5 py-0.5 rounded-full font-medium">Sync</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-file-invoice-dollar text-xs opacity-70"></i> Pertes Financières
                    </div>
                </a>
            </nav>
        </div>

        <div class="border-t border-slate-800/60 p-3 space-y-2">
            <div class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg bg-slate-950/40">
                <div class="w-7 h-7 rounded-md bg-indigo-600 flex items-center justify-center text-[11px] font-bold text-white shadow-xs">AD</div>
                <div class="leading-tight">
                    <p class="text-xs font-medium text-slate-200">Admin Principal</p>
                    <p class="text-[10px] text-slate-500">Console Root</p>
                </div>
            </div>
            <a href="logout.php" class="flex items-center gap-2.5 px-3 py-1.5 text-xs font-medium text-rose-400/80 hover:text-rose-400 hover:bg-rose-500/5 rounded-md transition w-full">
                <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i> Déconnexion
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-100 h-14 flex items-center justify-between px-6 shrink-0 shadow-xs">
            <h1 class="text-sm font-semibold text-slate-800">Console d'Administration</h1>
            <div class="flex items-center gap-2 text-[10px] font-medium text-slate-400 uppercase tracking-wider bg-slate-50 px-2.5 py-1 rounded-full border border-slate-100">
                <span class="h-1.5 w-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Claude Bernard connecté
            </div>
        </header>

        <!-- CONTAINER -->
        <div class="p-6 space-y-5 max-w-6xl w-full mx-auto">
            
            <!-- RAPPORT FINANCIER MENSUEL DES PERTES -->
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-50 pb-3.5 mb-4 gap-3">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-800 flex items-center gap-1.5 uppercase tracking-wider">
                            <i class="fa-solid fa-chart-line text-indigo-500 text-xs"></i> Analyse Financière du Gaspillage
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Synthèse des lots basculés en statut expiré (Mois en cours).</p>
                    </div>
                    <button class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] flex items-center gap-1.5 transition shadow-xs cursor-pointer">
                        <i class="fa-solid fa-file-export text-[10px] opacity-80"></i> Exporter
                    </button>
                </div>

                <!-- Cartes Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-slate-50/60 p-3.5 rounded-lg border border-slate-100/80 flex justify-between items-start">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">Valeur Perdue</span>
                            <span class="text-lg font-bold text-rose-600 mt-0.5 block tracking-tight">4 210,50 DH</span>
                        </div>
                        <span class="text-[10px] bg-rose-50 text-rose-600 font-medium px-1.5 py-0.5 rounded">Ce mois</span>
                    </div>
                    <div class="bg-slate-50/60 p-3.5 rounded-lg border border-slate-100/80 flex justify-between items-start">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">Boîtes Détruites</span>
                            <span class="text-lg font-bold text-slate-800 mt-0.5 block tracking-tight">142 <span class="text-xs font-normal text-slate-400">Unités</span></span>
                        </div>
                        <span class="text-[10px] bg-slate-200/60 text-slate-600 font-medium px-1.5 py-0.5 rounded">Cyclamed</span>
                    </div>
                    <div class="bg-slate-50/60 p-3.5 rounded-lg border border-slate-100/80 flex justify-between items-start">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">Efficacité FEFO</span>
                            <span class="text-lg font-bold text-emerald-600 mt-0.5 block tracking-tight">96.4 %</span>
                        </div>
                        <span class="text-[10px] bg-emerald-50 text-emerald-600 font-medium px-1.5 py-0.5 rounded">+1.2%</span>
                    </div>
                </div>
            </div>

            <!-- GRID ACCÈS ET CLAUDE BERNARD -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                
                <!-- ACCÈS ACTEURS -->
                <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-800 mb-3.5 flex items-center gap-1.5 uppercase tracking-wider">
                            <i class="fa-solid fa-user-shield text-slate-400 text-xs"></i> Droits d'Accès Système
                        </h3>
                        <div class="space-y-2">
                            <div class="p-2.5 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50/40">
                                <div>
                                    <p class="text-xs font-medium text-slate-700">Préparateur / Gestionnaire</p>
                                    <p class="text-[11px] text-slate-400">Réception, Scan Lot, Sorties FEFO</p>
                                </div>
                                <span class="text-[10px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded font-medium">Lecture/Écriture</span>
                            </div>
                            <div class="p-2.5 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50/40">
                                <div>
                                    <p class="text-xs font-medium text-slate-700">Pharmacien / Biologiste</p>
                                    <p class="text-[11px] text-slate-400">Validation, Retours, Configuration seuils</p>
                                </div>
                                <span class="text-[10px] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded font-medium">Manager</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INTEGRATION CLAUDE BERNARD -->
                <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-800 mb-1 flex items-center gap-1.5 uppercase tracking-wider">
                            <i class="fa-solid fa-cloud-arrow-down text-indigo-500 text-xs"></i> Base Claude Bernard
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-3.5">Synchronisation en arrière-plan des monographies et interactions médicamenteuses.</p>
                        
                        <div class="bg-slate-900 text-slate-300 font-mono text-[10px] p-2.5 rounded-lg border border-slate-800 flex items-center justify-between">
                            <span>Status: API_SUCCESS_200</span>
                            <span class="text-slate-500">Aujourd'hui à 04:00 AM</span>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-medium py-1.5 rounded-md transition shadow-xs cursor-pointer">
                            Forcer Sync
                        </button>
                        <button class="border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-3 rounded-md hover:bg-slate-50 transition cursor-pointer">
                            Logs API
                        </button>
                    </div>
                </div>

            </div>

    </div>
</main>
</body>
</html>