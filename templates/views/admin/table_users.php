<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Administration - PharmaStock</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
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
            <a href="dashboard.php" class="flex items-center gap-3 px-3 py-2.5 bg-indigo-600 text-white font-medium rounded-xl shadow-lg shadow-indigo-600/10 transition duration-200">
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
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-lg font-medium text-slate-800">Console d'Administration</h1>
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 uppercase tracking-wider">
                <span class="h-2 w-2 bg-emerald-500 rounded-full"></span> Claude Bernard connecté
            </div>
        </header>

        <!-- CONTAINER / CONTENU DE LA PAGE -->
        <div class="p-6 space-y-4 max-w-7xl w-full mx-auto">
            
            <!-- EN-TÊTE DU TABLEAU -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-2xs">
                <div>
                    <h2 class="text-base font-semibold text-slate-900 tracking-tight">Gestion des Collaborateurs</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Administrez les accès, rôles et statuts de sécurité des utilisateurs de la plateforme.</p>
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg text-xs flex items-center gap-2 transition shadow-xs cursor-pointer">
                    <i class="fa-solid fa-user-plus text-[10px]"></i> Ajouter un utilisateur
                </button>
            </div>

            <!-- BLOC TABLEAU -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-2xs overflow-hidden">
                
                <!-- RECHERCHE -->
                <div class="p-4 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <div class="relative w-full max-w-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                        <input type="text" placeholder="Rechercher un membre..." class="w-full pl-8 pr-4 py-1.5 border border-slate-200 rounded-lg focus:outline-hidden focus:border-indigo-500 text-xs bg-white transition">
                    </div>
                    <span class="text-xs text-slate-400 font-medium">3 utilisateurs enregistrés</span>
                </div>

                <!-- TABLEAU -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[11px] font-medium uppercase tracking-wider text-slate-400 border-b border-slate-200">
                                <th class="py-3 px-5 w-16">ID</th>
                                <th class="py-3 px-5">Collaborateur</th>
                                <th class="py-3 px-5">Email</th>
                                <th class="py-3 px-5">Rôle</th>
                                <th class="py-3 px-5">Date Création</th>
                                <th class="py-3 px-5">Statut</th>
                                <th class="py-3 px-5 text-right w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-3.5 px-5 font-mono text-xs text-slate-400">1</td>
                                <td class="py-3.5 px-5 font-medium text-slate-900">Amine Benjelloun</td>
                                <td class="py-3.5 px-5 text-xs text-slate-500">a.benjelloun@clinique.ma</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs bg-indigo-50 text-indigo-700 font-medium border border-indigo-100/40">
                                        Administrateur
                                    </span>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-slate-400">08/06/2026</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs bg-emerald-50 text-emerald-700 font-medium">
                                        <span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Actif
                                    </span>
                                </td>
                                <td class="py-3.5 px-5 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button title="Modifier" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-md transition cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <button title="Supprimer" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-md transition cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 bg-slate-50/30">
                    <span>Affichage de 1 à 3 sur 3 utilisateurs</span>
                    <div class="flex gap-1">
                        <button class="px-2.5 py-1 border border-slate-200 rounded-md hover:bg-white transition cursor-pointer disabled:opacity-50" disabled>Précédent</button>
                        <button class="px-2.5 py-1 border border-slate-200 rounded-md hover:bg-white transition cursor-pointer disabled:opacity-50" disabled>Suivant</button>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>