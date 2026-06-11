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
   <aside class="w-64 h-screen bg-slate-900 border-r border-slate-800 text-slate-400 flex flex-col justify-between p-4 hidden md:flex font-sans antialiased text-xs">
    
    <!-- Top Section: Logo & Navigation -->
    <div>
        <!-- Logo / Brand Header -->
        <div class="flex items-center gap-3 px-3 py-4 border-b border-slate-800 mb-5">
            <div class="p-2 bg-indigo-600/10 rounded-lg text-indigo-400 border border-indigo-500/20">
                <i class="fa-solid fa-key text-base leading-none"></i>
            </div>
            <div>
                <span class="text-sm font-semibold tracking-wider text-white block">PharmaStock</span>
                <span class="text-[10px] text-slate-500 font-medium tracking-tight uppercase">Management v1.0</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-1">
            <!-- Active Link (Configuration) -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 bg-indigo-600 text-white font-medium rounded-xl shadow-lg shadow-indigo-600/10 transition duration-200">
                <i class="fa-solid fa-gears text-sm w-4 text-center"></i> 
                <span class="tracking-wide">Configuration</span>
            </a>

            <!-- Users Link -->
            <a href="table_users.php" class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-800 hover:text-slate-100 rounded-xl transition duration-150 font-medium group">
                <i class="fa-solid fa-users-gear text-sm w-4 text-center text-slate-500 group-hover:text-indigo-400 transition"></i> 
                <span class="tracking-wide">Utilisateurs</span>
            </a>

            <!-- Claude Bernard Database Link -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-800 hover:text-slate-100 rounded-xl transition duration-150 font-medium group">
                <i class="fa-solid fa-database text-sm w-4 text-center text-slate-500 group-hover:text-indigo-400 transition"></i> 
                <span class="tracking-wide">Base Claude Bernard</span>
            </a>

            <!-- Financial Losses Link -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-800 hover:text-slate-100 rounded-xl transition duration-150 font-medium group">
                <i class="fa-solid fa-file-invoice-dollar text-sm w-4 text-center text-slate-500 group-hover:text-indigo-400 transition"></i> 
                <span class="tracking-wide">Pertes Financières</span>
            </a>
        </nav>
    </div>

    <!-- Bottom Section: User Profile & Logout -->
    <div class="border-t border-slate-800 pt-4 space-y-3">
        <!-- User Profile Card -->
        <div class="flex items-center justify-between px-2 py-1.5 rounded-xl bg-slate-950/40 border border-slate-800/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center font-semibold text-white shadow-md shadow-indigo-600/20 text-xs">
                    AD
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-200 tracking-wide leading-tight">Admin Principal</p>
                    <p class="text-[10px] text-indigo-400 font-medium tracking-wide">Console Root</p>
                </div>
            </div>
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse mr-1" title="En ligne"></span>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="flex items-center justify-between px-3 py-2.5 text-rose-400 hover:text-rose-100 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/20 rounded-xl transition duration-200 group font-medium">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-right-from-bracket text-sm w-4 text-center text-rose-400/70 group-hover:text-rose-400 transition"></i>
                <span class="tracking-wide">Déconnexion</span>
            </div>
            <i class="fa-solid fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition duration-200"></i>
        </a>
    </div>

</aside>

    <!-- MAIN CONTENT -->
   <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50/50 font-sans antialiased text-xs text-slate-600">
    <!-- TOPBAR -->
    <header class="bg-white border-b border-slate-200/80 h-14 flex items-center justify-between px-6 shrink-0 sticky top-0 z-10 backdrop-blur-md bg-white/80">
        <div class="flex items-center gap-2">
            <h1 class="text-xs font-semibold text-slate-900 tracking-wide">Console d'Administration</h1>
            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-medium">PharmaStock</span>
        </div>
        <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-400 uppercase tracking-wider bg-slate-50 border border-slate-200/60 px-2.5 py-1 rounded-lg">
            <span class="h-1.5 w-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
            <span class="text-slate-500">Claude Bernard connecté</span>
        </div>
    </header>

    <!-- CONTAINER -->
    <div class="p-6 space-y-6 max-w-7xl w-full mx-auto">
        
        <!-- RAPPORT FINANCIER MENSUEL DES PERTES -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 pb-4 mb-4 gap-4">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900 flex items-center gap-2 tracking-wide">
                        <div class="p-1.5 bg-indigo-50 text-indigo-600 rounded-md">
                            <i class="fa-solid fa-chart-line text-xs"></i>
                        </div>
                        Analyse Financière du Gaspillage
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Lots basculés en statut expiré ce mois-ci.</p>
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-3 rounded-xl text-[11px] flex items-center gap-2 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer">
                    <i class="fa-solid fa-file-export text-[10px] opacity-80"></i> Exporter le Rapport
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Valeur Perdue -->
                <div class="bg-slate-50 border border-slate-200/40 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider block">Valeur Perdue</span>
                        <span class="text-lg font-bold text-rose-600 mt-1 block tracking-tight">4 210,50 DH</span>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500">
                        <i class="fa-solid fa-arrow-trend-down text-xs"></i>
                    </div>
                </div>

                <!-- Boîtes Détruites -->
                <div class="bg-slate-50 border border-slate-200/40 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider block">Boîtes Détruites</span>
                        <span class="text-lg font-bold text-slate-800 mt-1 block tracking-tight">142 <span class="text-xs font-normal text-slate-400">Unités</span></span>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                        <i class="fa-solid fa-box text-xs"></i>
                    </div>
                </div>

                <!-- Efficacité FEFO -->
                <div class="bg-slate-50 border border-slate-200/40 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider block">Efficacité FEFO</span>
                        <span class="text-lg font-bold text-emerald-600 mt-1 block tracking-tight">96.4 %</span>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <i class="fa-solid fa-shield-heart text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- ACCÈS ACTEURS -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-xs flex flex-col justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900 mb-4 flex items-center gap-2 tracking-wide">
                        <div class="p-1.5 bg-slate-50 text-slate-500 rounded-md border border-slate-200/50">
                            <i class="fa-solid fa-user-shield text-xs"></i>
                        </div>
                        Droits d'Accès Système
                    </h3>
                    <div class="space-y-2">
                        <!-- Role 1 -->
                        <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between bg-slate-50/50 hover:bg-slate-50 transition">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-slate-800">Préparateur / Gestionnaire</p>
                                <p class="text-[11px] text-slate-400">Réception, Scan Lot, Sorties FEFO</p>
                            </div>
                            <span class="text-[10px] text-teal-600 bg-teal-50 border border-teal-200/40 px-2 py-0.5 rounded-md font-medium tracking-wide">Actif</span>
                        </div>
                        <!-- Role 2 -->
                        <div class="p-3 border border-slate-100 rounded-xl flex items-center justify-between bg-slate-50/50 hover:bg-slate-50 transition">
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-slate-800">Pharmacien / Biologiste</p>
                                <p class="text-[11px] text-slate-400">Validation, Retours, Configuration seuils</p>
                            </div>
                            <span class="text-[10px] text-emerald-600 bg-emerald-50 border border-emerald-200/40 px-2 py-0.5 rounded-md font-medium tracking-wide">Actif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INTEGRATION CLAUDE BERNARD -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-xs flex flex-col justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-slate-900 mb-1 flex items-center gap-2 tracking-wide">
                        <div class="p-1.5 bg-indigo-50 text-indigo-600 rounded-md">
                            <i class="fa-solid fa-cloud-arrow-down text-xs"></i>
                        </div>
                        Base Claude Bernard
                    </h3>
                    <p class="text-[11px] text-slate-400 mb-4">Synchronisation automatique des monographies et interactions.</p>
                    
                    <div class="bg-indigo-50/40 border border-indigo-100/50 p-3.5 rounded-xl text-[11px] text-indigo-900/90 font-medium flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-indigo-500 text-xs"></i>
                        <span>Synchronisation globale effectuée ce jour à 04:00 AM.</span>
                    </div>
                </div>

                <div class="flex gap-2 mt-5">
                    <button class="flex-1 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-medium py-2 rounded-xl transition cursor-pointer shadow-sm">
                        Forcer Sync
                    </button>
                    <button class="border border-slate-200 text-slate-600 text-[11px] font-medium py-2 px-4 rounded-xl hover:bg-slate-50 transition cursor-pointer">
                        Logs API
                    </button>
                </div>
            </div>
        </div>

    </div>
</main>
</body>
</html>