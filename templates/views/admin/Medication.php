<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicaments - PharmaStock</title>
    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-sm">

    <!-- SIDEBAR -->
    <aside class="w-60 bg-slate-900 text-slate-400 flex flex-col justify-between hidden md:flex border-r border-slate-800 shrink-0">
        <div>
            <!-- Header Sidebar -->
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-800/60">
                <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-xs">
                    <i class="fa-solid fa-prescription-bottle-medical text-xs"></i>
                </div>
                <span class="text-sm font-semibold tracking-tight text-white">PharmaStock</span>
            </div>
            
            <!-- Navigation -->
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
                <a href="#" class="flex items-center justify-between px-3 py-2 bg-indigo-600/10 text-indigo-400 rounded-md font-medium text-xs transition">
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

        <!-- Footer Sidebar + Logout -->
        <div class="border-t border-slate-800/60 p-3 space-y-2">
            <!-- Profil -->
            <div class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg bg-slate-950/40">
                <div class="w-7 h-7 rounded-md bg-indigo-600 flex items-center justify-center text-[11px] font-bold text-white shadow-xs">AD</div>
                <div class="leading-tight">
                    <p class="text-xs font-medium text-slate-200">Admin Principal</p>
                    <p class="text-[10px] text-slate-500">Console Root</p>
                </div>
            </div>
            <!-- Logout Button -->
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

        <!-- CONTAINER / CONTENU DE LA PAGE -->
        <div class="p-6 space-y-5 max-w-6xl w-full mx-auto">
            
            <!-- EN-TÊTE DU TABLEAU -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div>
                    <h2 class="text-xs font-semibold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-pills text-indigo-500 text-xs"></i> Catalogue des Médicaments
                    </h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Gérez la base de données des produits, tarifications et liaisons avec le référentiel Claude Bernard.</p>
                </div>
                <button class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] flex items-center gap-1.5 transition shadow-xs cursor-pointer">
                    <i class="fa-solid fa-plus text-[10px] opacity-80"></i> Référencer un produit
                </button>
            </div>

            <!-- BLOC TABLEAU -->
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                
                <!-- RECHERCHE & FILTRES -->
                <div class="p-3.5 border-b border-slate-100 bg-slate-50/40 flex items-center justify-between gap-4">
                    <div class="relative w-full max-w-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-[11px]"></i>
                        <input type="text" placeholder="Rechercher par nom, code CIP..." class="w-full pl-8 pr-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 focus:bg-white text-xs bg-white transition shadow-2xs">
                    </div>
                    <span class="text-[11px] text-slate-400 font-medium bg-slate-200/50 px-2 py-0.5 rounded">3 produits enregistrés</span>
                </div>

                <!-- TABLEAU -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[10px] font-semibold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                <th class="py-2.5 px-4 w-12 text-center">ID</th>
                                <th class="py-2.5 px-4">Code CIP</th>
                                <th class="py-2.5 px-4">Désignation Commerciale</th>
                                <th class="py-2.5 px-4">Dosage / Forme</th>
                                <th class="py-2.5 px-4 text-right">P. Achat</th>
                                <th class="py-2.5 px-4 text-right">P. Vente</th>
                                <th class="py-2.5 px-4 text-right w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs text-slate-600">
                            
                            <!-- Produit 1 -->
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-[11px] text-slate-400">1</td>
                                <td class="py-3 px-4 font-mono text-[11px] text-slate-500 tracking-tight">3400934921474</td>
                                <td class="py-3 px-4 font-medium text-slate-800">Doliprane</td>
                                <td class="py-3 px-4 text-slate-400 text-[11px]">1g - Boite de 8 comprimés</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-700">1,50 DH</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-900">2,10 DH</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button title="Modifier" class="p-1 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        </button>
                                        <button title="Supprimer" class="p-1 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Produit 2 -->
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-[11px] text-slate-400">2</td>
                                <td class="py-3 px-4 font-mono text-[11px] text-slate-500 tracking-tight">3400930113422</td>
                                <td class="py-3 px-4 font-medium text-slate-800">Augmentin</td>
                                <td class="py-3 px-4 text-slate-400 text-[11px]">500mg/62.5mg Adulte</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-700">4,20 DH</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-900">6,80 DH</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button title="Modifier" class="p-1 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        </button>
                                        <button title="Supprimer" class="p-1 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Produit 3 -->
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-3 px-4 text-center font-mono text-[11px] text-slate-400">3</td>
                                <td class="py-3 px-4 font-mono text-[11px] text-slate-500 tracking-tight">3400936231458</td>
                                <td class="py-3 px-4 font-medium text-slate-800">Kardegic</td>
                                <td class="py-3 px-4 text-slate-400 text-[11px]">75mg - Boite de 30 sachets</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-700">2,00 DH</td>
                                <td class="py-3 px-4 text-right font-medium text-slate-900">3,50 DH</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button title="Modifier" class="p-1 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        </button>
                                        <button title="Supprimer" class="p-1 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-3.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 bg-slate-50/30">
                    <span>Affichage de 1 à 3 sur 3 produits</span>
                    <div class="flex gap-1">
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Précédent</button>
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Suivant</button>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>