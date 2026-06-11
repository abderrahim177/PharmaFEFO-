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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-[12px] antialiased">

    <!-- SIDEBAR -->
    <aside class="w-60 bg-slate-950 text-slate-400 flex flex-col justify-between p-3.5 hidden md:flex shrink-0">
        <div>
            <div class="flex items-center gap-2.5 px-2 py-3 border-b border-slate-900/80">
                <i class="fa-solid fa-mortar-pestle text-teal-400 text-base"></i>
                <span class="text-sm font-semibold tracking-wide text-white">PharmaStock</span>
            </div>
            
            <nav class="mt-5 space-y-0.5">
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 bg-gradient-to-r from-teal-600/10 to-teal-600/5 border-l-2 border-teal-500 rounded-r-md text-white font-medium transition duration-200">
                    <i class="fa-solid fa-boxes-stacked w-4 text-center text-teal-400 text-[12px]"></i> 
                    <span>Gestion du Stock</span>
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 hover:bg-slate-900 hover:text-slate-200 border-l-2 border-transparent hover:border-slate-700 rounded-r-md transition duration-200 text-slate-400 group">
                    <i class="fa-solid fa-barcode w-4 text-center text-[11px] text-slate-500 group-hover:text-teal-400 transition"></i> 
                    <span>Scanner Entrée</span>
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 hover:bg-slate-900 hover:text-slate-200 border-l-2 border-transparent hover:border-slate-700 rounded-r-md transition duration-200 text-slate-400 group">
                    <i class="fa-solid fa-hand-holding-medical w-4 text-center text-[11px] text-slate-500 group-hover:text-teal-400 transition"></i> 
                    <span>Sorties / Dispensation</span>
                </a>
            </nav>
        </div>

        <div class="space-y-3">
            <div class="border-t border-slate-900/80 pt-3 flex items-center gap-2.5 px-2">
                <div class="w-8 h-8 rounded-md bg-teal-600/20 text-teal-400 border border-teal-500/20 flex items-center justify-center text-[11px] font-bold">Y</div>
                <div>
                    <p class="text-[12px] font-medium text-slate-200 leading-tight">Youssef .K</p>
                    <p class="text-[10px] text-teal-500 font-medium leading-none mt-0.5">Préparateur</p>
                </div>
            </div>
            <a href="#" class="flex items-center justify-between px-2.5 py-1.5 text-rose-400/90 hover:text-rose-100 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/10 rounded-md transition duration-200 group font-medium text-[11px]">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-right-from-bracket w-4 text-center text-rose-400/60 group-hover:text-rose-400 transition"></i>
                    <span class="tracking-wide">Déconnexion</span>
                </div>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-100 h-12 flex items-center justify-between px-5 shrink-0 shadow-xs">
            <h1 class="text-[13px] font-semibold text-slate-800">Espace Préparateur & Logistique - Epic 1</h1>
            <div class="flex items-center gap-3">
                <button class="relative p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-md transition">
                    <i class="fa-solid fa-bell text-xs"></i>
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- CONTAINER -->
        <div class="p-5 space-y-4 max-w-7xl w-full mx-auto">
            
            <!-- QUICK STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Entrées ce jour</p>
                        <p class="text-base font-bold mt-0.5 text-slate-800">42 Lots</p>
                    </div>
                    <div class="w-8 h-8 bg-teal-50 text-teal-600 border border-teal-100/40 rounded-md flex items-center justify-center text-xs"><i class="fa-solid fa-circle-plus"></i></div>
                </div>
                <div class="bg-white p-4 rounded-lg border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Dispensations (FEFO)</p>
                        <p class="text-base font-bold mt-0.5 text-slate-800">118 Boîtes</p>
                    </div>
                    <div class="w-8 h-8 bg-sky-50 text-sky-600 border border-sky-100/40 rounded-md flex items-center justify-center text-xs"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
                </div>
                <div class="bg-white p-4 rounded-lg border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Alertes à traiter</p>
                        <p class="text-base font-bold mt-0.5 text-rose-600">3 Produits</p>
                    </div>
                    <div class="w-8 h-8 bg-rose-50 text-rose-600 border border-rose-100/40 rounded-md flex items-center justify-center text-xs"><i class="fa-solid fa-triangle-exclamation"></i></div>
                </div>
            </div>

            <!-- WORKSPACE INTERACTIVE -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                
                <!-- FORMULAIRE RÉCEPTION (US 1.1) -->
                <div class="lg:col-span-1 bg-white p-4 rounded-lg border border-slate-100 shadow-sm h-fit">
                    <h3 class="text-[11px] font-bold text-slate-800 mb-3.5 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-square-plus text-teal-500"></i> US 1.1 : Entrée Produit
                    </h3>
                    <form class="space-y-3" onsubmit="return validateFEFOForm(event)">
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Médicament</label>
                            <input type="text" required placeholder="Ex: Augmentin 500mg" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Numéro de Lot</label>
                            <input type="text" required placeholder="Ex: LOT-2026-X9" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Date Limite d'Utilisation (DLU)</label>
                            <!-- Min date programmé en JS pour bloquer le passé -->
                            <input type="date" id="dlu_input" required class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                            <span class="text-[10px] text-rose-500 mt-0.5 hidden font-medium" id="date_error">La date doit être aujourd'hui ou dans le futur.</span>
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Quantité Reçue</label>
                            <input type="number" required min="1" placeholder="Ex: 50" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-1.5 rounded-md transition text-[11px] cursor-pointer shadow-xs mt-1">
                            Classer dans la file FEFO
                        </button>
                    </form>
                </div>

                <!-- DISPENSATION INTELLIGENTE FEFO & TRAITEMENT -->
                <div class="lg:col-span-2 bg-white p-4 rounded-lg border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-wand-magic-sparkles text-sky-500"></i> Assistant Dispensation FEFO
                            </h3>
                            <span class="text-[9px] bg-sky-50 text-sky-700 px-2 py-0.5 rounded-sm font-bold border border-sky-100/50 uppercase tracking-wider">Algorithme Actif</span>
                        </div>
                        <p class="text-[11px] text-slate-400 mb-3">Saisissez le médicament demandé pour cibler automatiquement le lot prioritaire.</p>
                        
                        <div class="relative mb-4">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-[10px]"></i>
                            <input type="text" value="Doliprane 1000mg Tab" class="w-full pl-7 pr-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-sky-500 text-[11px] font-medium bg-slate-50/40 transition">
                        </div>

                        <!-- FEFO Target Card (L'affichage immédiat du lot à sortir) -->
                        <div class="bg-slate-950 text-slate-300 p-3.5 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3 border border-slate-900 shadow-xs">
                            <div class="space-y-0.5">
                                <span class="text-[9px] uppercase font-bold tracking-wider text-amber-400 bg-amber-400/10 px-1.5 py-0.5 rounded-xs border border-amber-400/10">Lot Prioritaire Détecté (À Sortir d'abord)</span>
                                <h4 class="text-[13px] font-semibold text-white mt-1">Doliprane 1000mg</h4>
                                <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                    <span>Lot: <b class="font-medium text-slate-200">DL-9942</b></span>
                                    <span>Expire le: <b class="font-medium text-rose-400">30/07/2026</b></span>
                                </div>
                            </div>
                            <div class="bg-slate-900/60 p-1.5 px-3 rounded-md border border-slate-800/80 text-center min-w-24">
                                <span class="text-[9px] text-slate-500 block uppercase font-medium tracking-wider">Emplacement</span>
                                <span class="text-[12px] font-semibold text-teal-400">Tiroir B-12</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button class="bg-sky-600 hover:bg-sky-700 text-white font-medium py-1.5 px-3 rounded-md transition text-[11px] flex items-center gap-1.5 cursor-pointer shadow-xs">
                            <i class="fa-solid fa-check text-[10px]"></i> Confirmer la sortie
                        </button>
                    </div>
                </div>
            </div>

            <!-- NOUVELLE LISTE GLOBAL : FILE D'ATTENTE FEFO (PROCHAINES EXPIRATIONS) -->
            <div class="bg-white p-4 rounded-lg border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-list-ol text-teal-500"></i> File d'attente globale FEFO (Lots Prioritaires en Stock)
                    </h3>
                    <span class="text-[10px] text-slate-400 italic">Trié automatiquement par ordre critique d'expiration</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-400 text-[10px] uppercase tracking-wider bg-slate-50/50">
                                <th class="p-2 font-semibold">Médicament</th>
                                <th class="p-2 font-semibold">N° Lot</th>
                                <th class="p-2 font-semibold">Emplacement</th>
                                <th class="p-2 font-semibold">DLU (Expiration)</th>
                                <th class="p-2 font-semibold">Statut FEFO</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-[11px]">
                            <!-- Lot très critique -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-2 font-medium text-slate-800">Doliprane 1000mg Tab</td>
                                <td class="p-2 text-slate-500 font-mono">DL-9942</td>
                                <td class="p-2"><span class="bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded-sm font-medium">Tiroir B-12</span></td>
                                <td class="p-2 text-rose-600 font-medium">30/07/2026</td>
                                <td class="p-2"><span class="bg-rose-50 text-rose-700 border border-rose-100 px-2 py-0.5 rounded-sm font-bold text-[9px] uppercase">Priorité 1 (Urgent)</span></td>
                            </tr>
                            <!-- Lot moyen -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-2 font-medium text-slate-800">Augmentin 500mg</td>
                                <td class="p-2 text-slate-500 font-mono">AUG-2026-A1</td>
                                <td class="p-2"><span class="bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded-sm font-medium">Frigo A-2</span></td>
                                <td class="p-2 text-amber-600 font-medium">14/10/2026</td>
                                <td class="p-2"><span class="bg-amber-50 text-amber-700 border border-amber-100 px-2 py-0.5 rounded-sm font-bold text-[9px] uppercase">Priorité 2</span></td>
                            </tr>
                            <!-- Lot éloigné -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-2 font-medium text-slate-800">Spasfon Inj</td>
                                <td class="p-2 text-slate-500 font-mono">SPF-8821</td>
                                <td class="p-2"><span class="bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded-sm font-medium">Rayon C-4</span></td>
                                <td class="p-2 text-emerald-600 font-medium">22/12/2027</td>
                                <td class="p-2"><span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded-sm font-bold text-[9px] uppercase">En Attente</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- JavaScript strict validation pour l'US 1.1 -->
    <script>
        // Bloquer la sélection des dates passées directement sur l'input HTML5
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dlu_input').min = today;

        function validateFEFOForm(event) {
            const dluInput = document.getElementById('dlu_input').value;
            const errorSpan = document.getElementById('date_error');
            
            const selectedDate = new Date(dluInput);
            const currentDate = new Date(today);

            if (!dluInput || selectedDate < currentDate) {
                event.preventDefault();
                errorSpan.classList.remove('hidden');
                return false;
            }
            
            errorSpan.classList.add('hidden');
            alert('Produit validé et classé selon l\'ordre FEFO !');
            return true;
        }
    </script>
</body>
</html>