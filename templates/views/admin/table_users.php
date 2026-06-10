<?php 
 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - PharmaStock</title>
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
                <a href="#" class="flex items-center justify-between px-3 py-2 bg-indigo-600/10 text-indigo-400 rounded-md font-medium text-xs transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-users-gear text-xs"></i> Users
                    </div>
                </a>
                <a href="Medication.php" class="flex items-center justify-between px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-database text-xs opacity-70"></i> Medication Management 
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
                        <i class="fa-solid fa-user-shield text-indigo-500 text-xs"></i> Gestion des Collaborateurs
                    </h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Administrez les accès, rôles et statuts de sécurité des utilisateurs de la plateforme.</p>
                </div>
                <!-- ID de déclenchement JS pour ajouter -->
                <button id="btnOpenAddModal" class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] flex items-center gap-1.5 transition shadow-xs cursor-pointer">
                    <i class="fa-solid fa-user-plus text-[10px] opacity-80"></i> Ajouter un utilisateur
                </button>
            </div>

            <!-- BLOC TABLEAU -->
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                
                <!-- RECHERCHE & INFOS -->
                <div class="p-3.5 border-b border-slate-100 bg-slate-50/40 flex items-center justify-between gap-4">
                    <div class="relative w-full max-w-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-[11px]"></i>
                        <input type="text" placeholder="Rechercher un membre..." class="w-full pl-8 pr-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 focus:bg-white text-xs bg-white transition shadow-2xs">
                    </div>
                    <span class="text-[11px] text-slate-400 font-medium bg-slate-200/50 px-2 py-0.5 rounded">3 utilisateurs</span>
                </div>

                <!-- TABLEAU -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[10px] font-semibold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                <th class="py-2.5 px-4 w-12 text-center">ID</th>
                                <th class="py-2.5 px-4">Collaborateur</th>
                                <th class="py-2.5 px-4">Email</th>
                                <th class="py-2.5 px-4">Rôle</th>
                                <th class="py-2.5 px-4">Date Création</th>
                                <th class="py-2.5 px-4">Statut</th>
                                <th class="py-2.5 px-4 text-right w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs text-slate-600">
                            
                            <!-- Ligne 1 -->
                            <tr class="hover:bg-slate-50/40 transition" data-id="1">
                                <td class="py-3 px-4 text-center font-mono text-[11px] text-slate-400 target-id">1</td>
                                <td class="py-3 px-4 font-medium text-slate-800 target-name">Amine Benjelloun</td>
                                <td class="py-3 px-4 text-slate-500 font-normal target-email">a.benjelloun@clinique.ma</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] bg-indigo-50 text-indigo-700 font-medium border border-indigo-100/30 target-role" data-role="Administrateur">
                                        Administrateur
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-400 text-[11px]">08/06/2026</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 text-emerald-700 font-medium border border-emerald-100/20 target-status" data-status="Actif">
                                        <span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Actif
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <!-- Classe ajoutée pour le trigger JS de modification -->
                                        <button title="Modifier" class="btnEditUser p-1 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded transition cursor-pointer">
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
                    <span>Affichage de 1 à 3 sur 3 utilisateurs</span>
                    <div class="flex gap-1">
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Précédent</button>
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Suivant</button>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- ==================== MODAL : AJOUTER UN UTILISATEUR ==================== -->
    <div id="modalAddUser" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-all">
        <div class="bg-white rounded-xl border border-slate-100 shadow-xl w-full max-w-md p-5 space-y-4 relative transform scale-95 transition-all">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-xs font-semibold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-user-plus text-indigo-500"></i> Nouveau Collaborateur
                </h3>
                <button class="btnCloseModal text-slate-400 hover:text-slate-600 p-1 rounded-md transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <!-- Formulaire -->
            <form action="/Pharmafefo-/src/controller/UserController.php" method="POST" class="space-y-3">
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Nom Complet</label>
                    <input type="text" name="name" required placeholder="Ex: Amine Benjelloun" class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Adresse Email</label>
                    <input type="email" name="email" required placeholder="nom@clinique.ma" class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Rôle</label>
                        <select name="role" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                            <option value="Preparateur">Préparateur</option>
                            <option value="Pharmacien">Pharmacien</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Statut</label>
                        <select name="status" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                    </div>
                </div>
                <!-- Actions Buttons -->
                <div class="flex items-center justify-end gap-2 border-t border-slate-100 pt-3 mt-4">
                    <button type="button" class="btnCloseModal border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-3 rounded-md hover:bg-slate-50 transition cursor-pointer">
                        Annuler
                    </button>
                    <button name='Enregistrer' type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1.5 px-3 rounded-md text-[11px] transition shadow-xs cursor-pointer">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL : MODIFIER UN UTILISATEUR ==================== -->
    <div id="modalEditUser" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-all">
        <div class="bg-white rounded-xl border border-slate-100 shadow-xl w-full max-w-md p-5 space-y-4 relative transform scale-95 transition-all">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-xs font-semibold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square text-indigo-500"></i> Modifier le Profil
                </h3>
                <button class="btnCloseModal text-slate-400 hover:text-slate-600 p-1 rounded-md transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <!-- Formulaire -->
            <form action="edit_user.php" method="POST" class="space-y-3">
                <!-- Champ caché pour l'ID -->
                <input type="hidden" id="edit_user_id" name="id">

                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Nom Complet</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Adresse Email</label>
                    <input type="email" id="edit_email" name="email" required class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Nouveau mot de passe <span class="text-slate-400 font-normal lowercase">(optionnel)</span></label>
                    <input type="password" name="password" placeholder="Laisser vide si inchangé" class="w-full px-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Rôle</label>
                        <select id="edit_role" name="role" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                            <option value="Préparateur">Préparateur</option>
                            <option value="Pharmacien">Pharmacien</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1">Statut</label>
                        <select id="edit_status" name="status" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-xs bg-slate-50/30 transition">
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                    </div>
                </div>
                <!-- Actions Buttons -->
                <div class="flex items-center justify-end gap-2 border-t border-slate-100 pt-3 mt-4">
                    <button type="button" class="btnCloseModal border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-3 rounded-md hover:bg-slate-50 transition cursor-pointer">
                        Annuler
                    </button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1.5 px-3 rounded-md text-[11px] transition shadow-xs cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== LOGIQUE JAVASCRIPT SIMPLIFIÉE ==================== -->
    <script>
        // Sélection des éléments DOM
        const modalAdd = document.getElementById('modalAddUser');
        const modalEdit = document.getElementById('modalEditUser');
        
        // Ouvrir Modal Ajouter
        document.getElementById('btnOpenAddModal').addEventListener('click', () => {
            modalAdd.classList.remove('hidden');
        });

        // Ouvrir et pré-remplir la Modal Modifier
        document.querySelectorAll('.btnEditUser').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                
                // Extraction des données réelles de la ligne du tableau
                const id = row.querySelector('.target-id').innerText.trim();
                const name = row.querySelector('.target-name').innerText.trim();
                const email = row.querySelector('.target-email').innerText.trim();
                const role = row.querySelector('.target-role').getAttribute('data-role');
                const status = row.querySelector('.target-status').getAttribute('data-status');
                
                // Remplissage automatique des inputs du formulaire de modification
                document.getElementById('edit_user_id').value = id;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;
                document.getElementById('edit_status').value = status;
                
                // Affichage de la modal
                modalEdit.classList.remove('hidden');
            });
        });

        // Fermer toutes les Modals actives
        document.querySelectorAll('.btnCloseModal').forEach(button => {
            button.addEventListener('click', () => {
                modalAdd.classList.add('hidden');
                modalEdit.classList.add('hidden');
            });
        });

        // Fermeture automatique en cliquant en dehors du conteneur de la modal
        window.addEventListener('click', (e) => {
            if (e.target === modalAdd) modalAdd.classList.add('hidden');
            if (e.target === modalEdit) modalEdit.classList.add('hidden');
        });
    </script>
</body>
</html>