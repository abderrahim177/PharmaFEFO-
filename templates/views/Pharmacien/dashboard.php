<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pharmacien - PharmaStock</title>
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
                <i class="fa-solid fa-mortar-pestle text-emerald-400 text-xl"></i>
                <span class="text-lg font-medium tracking-wide text-white">PharmaStock</span>
            </div>
            <nav class="mt-6 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-emerald-700 rounded-lg text-white font-medium transition">
                    <i class="fa-solid fa-shield-halved w-5 text-sm"></i> Supervision & Alertes
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-clipboard-check w-5 text-sm"></i> Inventaires
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-arrow-rotate-left w-5 text-sm"></i> Retours Labo
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-sliders w-5 text-sm"></i> Seuils d'alerte
                </a>
            </nav>
        </div>
        <div class="border-t border-slate-800 pt-4 flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full bg-emerald-600 flex items-center justify-center text-sm font-medium text-white">Dr</div>
            <div>
                <p class="text-sm font-medium text-slate-200">Dr. Amine .B</p>
                <p class="text-xs text-emerald-400">Titulaire</p>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-lg font-medium text-slate-800">Supervision du Titulaire</h1>
            <div class="bg-amber-50 text-amber-800 border border-amber-100 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-2">
                <i class="fa-solid fa-bell text-amber-600"></i> 14 produits expirent le mois prochain
            </div>
        </header>

        <!-- CONTAINER -->
        <div class="p-6 space-y-6 max-w-7xl w-full mx-auto">
            
            <!-- CRITICITÉ TRACKER -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white p-5 rounded-xl border-l-2 border-rose-500 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wider text-slate-400">Alerte Rouge (&lt; 30j)</p>
                        <p class="text-2xl font-semibold mt-0.5 text-slate-800">8 Lots</p>
                    </div>
                    <span class="text-[11px] bg-rose-50 text-rose-700 px-2 py-0.5 rounded-md font-medium">Action requise</span>
                </div>
                <div class="bg-white p-5 rounded-xl border-l-2 border-amber-500 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wider text-slate-400">Alerte Orange (&lt; 90j)</p>
                        <p class="text-2xl font-semibold mt-0.5 text-slate-800">23 Lots</p>
                    </div>
                    <span class="text-[11px] bg-amber-50 text-amber-700 px-2 py-0.5 rounded-md font-medium">À déstocker</span>
                </div>
                <div class="bg-white p-5 rounded-xl border-l-2 border-emerald-500 shadow-2xs flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wider text-slate-400">Sécurité Vert (&gt; 6m)</p>
                        <p class="text-2xl font-semibold mt-0.5 text-slate-800">412 Lots</p>
                    </div>
                    <span class="text-[11px] bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-md font-medium">Conforme</span>
                </div>
            </div>

            <!-- TABLEAU DES ALERTES -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-base font-medium text-slate-800">Suivi des Lots & Niveaux de Criticité</h3>
                        <p class="text-xs text-slate-400">Vue d'ensemble ordonnée selon la file d'attente réglementaire.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-xs font-medium flex items-center gap-2 transition cursor-pointer">
                            <i class="fa-solid fa-filter text-[10px]"></i> Voir "Alerte Rouge"
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[11px] font-medium uppercase tracking-wider text-slate-400 border-b border-slate-200">
                                <th class="py-3 px-5">Médicament</th>
                                <th class="py-3 px-5">N° de Lot</th>
                                <th class="py-3 px-5">Date Péremption</th>
                                <th class="py-3 px-5">Criticité</th>
                                <th class="py-3 px-5">Qte Restante</th>
                                <th class="py-3 px-5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-sm text-slate-600">
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-3 px-5 font-medium text-slate-800">Amoxicilline Sandoz 500mg</td>
                                <td class="py-3 px-5 font-mono text-xs">AMZ-2024-B8</td>
                                <td class="py-3 px-5 text-rose-600">01/06/2026 (Dépassée)</td>
                                <td class="py-3 px-5">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-xs bg-rose-50 text-rose-700 font-medium">
                                        Alerte Rouge
                                    </span>
                                </td>
                                <td class="py-3 px-5">14 boîtes</td>
                                <td class="py-3 px-5 text-right">
                                    <button class="bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white px-2.5 py-1 rounded-md text-xs font-medium transition border border-rose-100 cursor-pointer">
                                        Retirer (Status::EXPIRED)
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-3 px-5 font-medium text-slate-800">Kardegic 75mg</td>
                                <td class="py-3 px-5 font-mono text-xs">KARD-882-Z</td>
                                <td class="py-3 px-5 text-amber-600">15/08/2026</td>
                                <td class="py-3 px-5">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-xs bg-amber-50 text-amber-700 font-medium">
                                        Alerte Orange
                                    </span>
                                </td>
                                <td class="py-3 px-5">120 boîtes</td>
                                <td class="py-3 px-5 text-right">
                                    <button class="text-slate-600 hover:bg-slate-100 px-2.5 py-1 rounded-md text-xs font-medium transition border border-slate-200 cursor-pointer">
                                        Retour Fournisseur
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>