<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Préparateur - PharmaStock</title>
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
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between p-4 hidden md:flex">
        <div>
            <div class="flex items-center gap-3 px-2 py-4 border-b border-slate-800">
                <i class="fa-solid fa-mortar-pestle text-teal-400 text-xl"></i>
                <span class="text-lg font-medium tracking-wide text-white">PharmaStock</span>
            </div>
            <nav class="mt-6 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-teal-600 rounded-lg text-white font-medium transition">
                    <i class="fa-solid fa-boxes-stacked w-5 text-sm"></i> Gestion du Stock
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-barcode w-5 text-sm"></i> Scanner Entrée
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-hand-holding-medical w-5 text-sm"></i> Sorties / Dispensation
                </a>
            </nav>
        </div>
        <div class="border-t border-slate-800 pt-4 flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full bg-teal-600 flex items-center justify-center text-sm font-medium text-white">Y</div>
            <div>
                <p class="text-sm font-medium text-slate-200">Youssef .K</p>
                <p class="text-xs text-teal-400">Préparateur</p>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-lg font-medium text-slate-800">Espace Préparateur & Logistique</h1>
            <div class="flex items-center gap-4">
                <button class="relative p-2 text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-bell"></i>
                    <span class="absolute top-2 right-2 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- CONTAINER -->
        <div class="p-6 space-y-6 max-w-7xl w-full mx-auto">
            
            <!-- QUICK STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium tracking-wide uppercase">Entrées ce jour</p>
                        <p class="text-xl font-semibold mt-1 text-slate-800">42 Lots</p>
                    </div>
                    <div class="w-10 h-10 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center"><i class="fa-solid fa-circle-plus"></i></div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium tracking-wide uppercase">Dispensations (FEFO)</p>
                        <p class="text-xl font-semibold mt-1 text-slate-800">118 Boîtes</p>
                    </div>
                    <div class="w-10 h-10 bg-sky-50 text-sky-600 rounded-lg flex items-center justify-center"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium tracking-wide uppercase">Alertes à traiter</p>
                        <p class="text-xl font-semibold mt-1 text-rose-600">3 Produits</p>
                    </div>
                    <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- FORMULAIRE RÉCEPTION -->
                <div class="lg:col-span-1 bg-white p-5 rounded-xl border border-slate-200 shadow-2xs h-fit">
                    <h3 class="text-base font-medium text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-square-plus text-teal-600 text-sm"></i> Réceptionner un Produit
                    </h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Médicament</label>
                            <input type="text" placeholder="Ex: Augmentin 500mg" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Numéro de Lot</label>
                            <input type="text" placeholder="Ex: LOT-2026-X9" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Date Limite d'Utilisation (DLU)</label>
                            <input type="date" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50">
                            <span class="text-[11px] text-slate-400 mt-1 block">Doit être supérieure à la date du jour.</span>
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-slate-400 uppercase tracking-wider mb-1.5">Quantité Reçue</label>
                            <input type="number" placeholder="Ex: 50" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-teal-500 text-sm bg-slate-50/50">
                        </div>
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 rounded-lg transition text-sm cursor-pointer shadow-xs">
                            Valider l'entrée FEFO
                        </button>
                    </form>
                </div>

                <!-- DISPENSATION INTELLIGENTE FEFO -->
                <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-base font-medium text-slate-800 flex items-center gap-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-sky-600 text-sm"></i> Assistant Dispensation FEFO
                            </h3>
                            <span class="text-[11px] bg-sky-50 text-sky-700 px-2 py-0.5 rounded-md font-medium">Algorithme Actif</span>
                        </div>
                        <p class="text-sm text-slate-400 mb-4">Saisissez le médicament demandé pour cibler automatiquement le lot prioritaire.</p>
                        
                        <div class="relative mb-5">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input type="text" value="Doliprane 1000mg Tab" class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-hidden focus:border-sky-500 text-sm font-medium bg-slate-50/50">
                        </div>

                        <!-- FEFO Target Card -->
                        <div class="bg-slate-900 text-slate-300 p-4 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] uppercase font-medium tracking-wider text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded-sm">Lot Prioritaire Détecté</span>
                                <h4 class="text-base font-medium text-white mt-1">Doliprane 1000mg</h4>
                                <div class="flex items-center gap-4 mt-1.5 text-xs text-slate-400">
                                    <span>Lot: <b class="font-medium text-slate-200">DL-9942</b></span>
                                    <span>Expire le: <b class="font-medium text-rose-400">30/07/2026</b></span>
                                </div>
                            </div>
                            <div class="bg-slate-800/60 p-2 px-4 rounded-lg border border-slate-800 text-center min-w-28">
                                <span class="text-[10px] text-slate-400 block uppercase">Emplacement</span>
                                <span class="text-sm font-medium text-teal-400">Tiroir B-12</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-5">
                        <button class="bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-check text-xs"></i> Confirmer la sortie
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>