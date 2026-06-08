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
    <aside class="w-64 bg-slate-950 text-slate-400 flex flex-col justify-between p-4 hidden md:flex shrink-0">
        <div>
            <div class="flex items-center gap-3 px-2 py-4 border-b border-slate-900">
                <i class="fa-solid fa-key text-indigo-400 text-xl"></i>
                <span class="text-lg font-medium tracking-wide text-white">PharmaStock</span>
            </div>
            <nav class="mt-6 space-y-1">
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-900 hover:text-white rounded-lg transition text-slate-400">
                    <i class="fa-solid fa-gears w-5 text-sm"></i> Configuration
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-700 rounded-lg text-white font-medium transition">
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