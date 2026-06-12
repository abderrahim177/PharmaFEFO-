<?php 
// 1. Kan-jibou l-fichiers bl-paths l-s-hiha
require_once __DIR__ . "/../../../config/database.php"; 
require_once __DIR__ . "/../../../src/repository/UserRepository.php"; 

// 2. Instanciation dial l-BDD u l-Repository
$dbInstance = new Database(); 
$pdo = $dbInstance->getConnection(); 
$repository = new users($pdo); 

// 3. Jbna l-data u l-3adad total dial l-users
$users = $repository->GetAllUsers();
$coutUsers = $repository->getCoutUsers();
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Utilisateur';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Inconnu';

function getInitials($fullName) {
    $words = explode(' ', trim($fullName));
    $initials = '';
    
    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= mb_substr($word, 0, 1, 'UTF-8');
        }
    }
    return mb_strtoupper(mb_substr($initials, 0, 2, 'UTF-8'), 'UTF-8');
}
$userInitials = getInitials($name);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-[12px] antialiased">

     <?php
// جلب إسم الملف الحالي (مثلاً: Medication.php أو dashboard.php)
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>

<aside class="w-60 bg-slate-900 text-slate-400 flex flex-col justify-between hidden md:flex border-r border-slate-800 shrink-0">
    <div>
        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-800/60">
            <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-xs">
                <i class="fa-solid fa-prescription-bottle-medical text-xs"></i>
            </div>
            <span class="text-sm font-semibold tracking-tight text-white">PharmaStock</span>
        </div>
        
        <nav class="mt-4 px-3 space-y-0.5">
            <a href="dashboard.php" class="flex items-center justify-between px-3 py-2 rounded-md text-xs transition <?php echo ($current_page == 'dashboard.php') ? 'bg-indigo-600/10 text-indigo-400 font-medium' : 'hover:bg-slate-800/50 hover:text-slate-200 font-normal'; ?>">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-gears text-xs <?php echo ($current_page == 'dashboard.php') ? '' : 'opacity-70'; ?>"></i> Dashboard
                </div>
            </a>

            <a href="table_users.php" class="flex items-center justify-between px-3 py-2 rounded-md text-xs transition <?php echo ($current_page == 'table_users.php') ? 'bg-indigo-600/10 text-indigo-400 font-medium' : 'hover:bg-slate-800/50 hover:text-slate-200 font-normal'; ?>">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-users-gear text-xs <?php echo ($current_page == 'table_users.php') ? '' : 'opacity-70'; ?>"></i> Users
                </div>
            </a>

            <a href="Medication.php" class="flex items-center justify-between px-3 py-2 rounded-md text-xs transition <?php echo ($current_page == 'Medication.php') ? 'bg-indigo-600/10 text-indigo-400 font-medium' : 'hover:bg-slate-800/50 hover:text-slate-200 font-normal'; ?>">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-database text-xs"></i> Medication Management 
                </div>
                <span class="text-[10px] bg-emerald-500/10 text-emerald-400 px-1.5 py-0.5 rounded-full font-medium">Sync</span>
            </a>

            <a href="pertes.php" class="flex items-center justify-between px-3 py-2 rounded-md text-xs transition <?php echo ($current_page == 'pertes.php') ? 'bg-indigo-600/10 text-indigo-400 font-medium' : 'hover:bg-slate-800/50 hover:text-slate-200 font-normal'; ?>">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-file-invoice-dollar text-xs <?php echo ($current_page == 'pertes.php') ? '' : 'opacity-70'; ?>"></i> Pertes Financières
                </div>
            </a>
        </nav>
    </div>

    <div class="border-t border-slate-800/60 p-3 space-y-2">
        <div class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg bg-slate-950/40">
            <div class="w-7 h-7 rounded-md bg-indigo-600 flex items-center justify-center text-[11px] font-bold text-white shadow-xs"><?= $userInitials ?></div>
            <div class="leading-tight">
                <p class="text-xs font-medium text-slate-200"><?= $name ?> </p>
                <p class="text-[10px] text-slate-500"><?= $role ?>Principal</p>
            </div>
        </div>
        <a href="../logout.php" class="flex items-center gap-2.5 px-3 py-1.5 text-xs font-medium text-rose-400/80 hover:text-rose-400 hover:bg-rose-500/5 rounded-md transition w-full">
            <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i> Déconnexion
        </a>
    </div>
</aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white border-b border-slate-100 h-12 flex items-center justify-between px-5 shrink-0 shadow-xs">
            <h1 class="text-[13px] font-semibold text-slate-800">Console d'Administration</h1>
            <div class="flex items-center gap-2 text-[10px] font-medium text-slate-400 uppercase tracking-wider bg-slate-50 px-2.5 py-1 rounded-full border border-slate-100">
                <span class="h-1.5 w-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Claude Bernard connecté
            </div>
        </header>

        <div class="p-5 space-y-4 max-w-6xl w-full mx-auto">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-4 rounded-lg border border-slate-100 shadow-sm">
                <div>
                    <h2 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-user-shield text-indigo-500"></i> Gestion des Collaborateurs
                    </h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Administrez les accès, rôles et statuts de sécurité des utilisateurs de la plateforme.</p>
                </div>
                <button id="btnOpenAddModal" class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-1.5 px-3 rounded-md text-[11px] flex items-center gap-1.5 transition shadow-xs cursor-pointer">
                    <i class="fa-solid fa-user-plus text-[10px] opacity-80"></i> Ajouter un utilisateur
                </button>
            </div>

            <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
                
                <div class="p-3 border-b border-slate-100 bg-slate-50/40 flex items-center justify-between gap-4">
                    <div class="relative w-full max-w-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-[10px]"></i>
                        <input type="text" placeholder="Rechercher un membre..." class="w-full pl-7 pr-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 focus:bg-white text-[11px] bg-white transition shadow-2xs">
                    </div>
                    <span class="text-[10px] text-slate-500 font-semibold bg-slate-200/60 px-2 py-0.5 rounded"><?= htmlspecialchars($coutUsers) ?> Users</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[10px] font-semibold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                <th class="py-2 px-3 w-12 text-center">ID</th>
                                <th class="py-2 px-3">Collaborateur</th>
                                <th class="py-2 px-3">Email</th>
                                <th class="py-2 px-3">Rôle</th>
                                <th class="py-2 px-3">Date Création</th>
                                <th class="py-2 px-3">Statut</th>
                                <th class="py-2 px-3 text-right w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-[12px] text-slate-600">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php
                                    $roleClasses = [
                                        'Administrateur' => 'bg-indigo-50 text-indigo-700 border-indigo-100/40',
                                        'Pharmacien'     => 'bg-emerald-50 text-emerald-700 border-emerald-100/40',
                                        'Preparateur'    => 'bg-amber-50 text-amber-700 border-amber-100/40',
                                        'Préparateur'    => 'bg-amber-50 text-amber-700 border-amber-100/40'
                                    ];

                                    $currentRole = $user['role'];
                                    $badgeClass = $roleClasses[$currentRole] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                                    ?>
                                    <tr class="hover:bg-slate-50/40 transition">
                                        <td class="py-2 px-3 text-center font-mono text-[11px] text-slate-400 target-id"><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td class="py-2 px-3 font-medium text-slate-800 target-name"><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td class="py-2 px-3 text-slate-500 font-normal target-email"><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td class="py-2 px-3">
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium border target-role <?= $badgeClass ?>" data-role="<?php echo htmlspecialchars($user['role']); ?>">
                                            <?php echo htmlspecialchars($user['role']); ?>
                                            </span>
                                        </td>
                                        <td class="py-2 px-3 text-slate-400 text-[11px]"><?php echo htmlspecialchars($user['created_at']); ?></td>
                                        <td class="py-2 px-3">
                                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 text-emerald-700 font-medium border border-emerald-100/20 target-status" data-status="<?php echo htmlspecialchars($user['status']); ?>">
                                                <span class="w-1 h-1 bg-emerald-500 rounded-full"></span> <?php echo htmlspecialchars($user['status']); ?>
                                            </span>
                                        </td>
                                        <td class="py-2 px-3 text-right">
                                            <div class="flex items-center justify-end gap-0.5">
                                                <button title="Modifier" class="btnEditUser p-1 text-slate-400 hover:text-indigo-600 hover:bg-slate-50 rounded transition cursor-pointer">
                                                    <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                                </button>
                                                <button title="Supprimer" class="btnDeleteUser p-1 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded transition cursor-pointer" 
                                                        data-id="<?php echo htmlspecialchars($user['id']); ?>" 
                                                        data-name="<?php echo htmlspecialchars($user['name']); ?>">
                                                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php border: else: ?>
                                <tr>
                                    <td colspan="7" class="py-5 text-center text-slate-400">Aucun utilisateur trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 bg-slate-50/30">
                    <span>Affichage de 1 à <?= count($users) ?> sur <?= htmlspecialchars($coutUsers) ?> utilisateurs</span>
                    <div class="flex gap-1">
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Précédent</button>
                        <button class="px-2 py-1 border border-slate-200 rounded-md hover:bg-white text-slate-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" disabled>Suivant</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <div id="modalAddUser" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-all">
        <div class="bg-white rounded-lg border border-slate-100 shadow-xl w-full max-w-md p-4 space-y-3.5 relative transform scale-95 transition-all">
            <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-user-plus text-indigo-500"></i> Nouveau Collaborateur
                </h3>
                <button class="btnCloseModal text-slate-400 hover:text-slate-600 p-1 rounded-md transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
            <form action="/Pharmafefo-/src/controller/UserController.php" method="POST" class="space-y-3">
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Nom Complet</label>
                    <input type="text" name="name" required placeholder="Ex: Amine Benjelloun" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Adresse Email</label>
                    <input type="email" name="email" required placeholder="nom@clinique.ma" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Rôle</label>
                        <select name="role" class="w-full px-2 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                            <option value="Preparateur">Préparateur</option>
                            <option value="Pharmacien">Pharmacien</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Statut</label>
                        <select name="status" class="w-full px-2 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-1.5 border-t border-slate-100 pt-2.5 mt-3">
                    <button type="button" class="btnCloseModal border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-2.5 rounded-md hover:bg-slate-50 transition cursor-pointer">
                        Annuler
                    </button>
                    <button name='Enregistrer' type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] transition shadow-xs cursor-pointer">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditUser" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-all">
        <div class="bg-white rounded-lg border border-slate-100 shadow-xl w-full max-w-md p-4 space-y-3.5 relative transform scale-95 transition-all">
            <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square text-indigo-500"></i> Modifier le Profil
                </h3>
                <button class="btnCloseModal text-slate-400 hover:text-slate-600 p-1 rounded-md transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
            <form action="/Pharmafefo-/src/controller/UserController.php" method="POST" class="space-y-3">
                <input type="hidden" id="edit_user_id" name="id">
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Nom Complet</label>
                    <input type="text" id="edit_name" name="name_update" required class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Adresse Email</label>
                    <input type="email" id="edit_email" name="email_update" required class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Nouveau mot de passe <span class="text-slate-400 font-normal lowercase">(optionnel)</span></label>
                    <input type="password" name="password" placeholder="Laisser vide si inchangé" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Rôle</label>
                        <select id="edit_role" name="role_update" class="w-full px-2 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                            <option value="Preparateur">Préparateur</option>
                            <option value="Pharmacien">Pharmacien</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Statut</label>
                        <select id="edit_status" name="status_update" class="w-full px-2 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 text-[11px] bg-slate-50/30 transition">
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-1.5 border-t border-slate-100 pt-2.5 mt-3">
                    <button type="button" class="btnCloseModal border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-2.5 rounded-md hover:bg-slate-50 transition cursor-pointer">
                        Annuler
                    </button>
                    <button type="submit" name="Modifier" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] transition shadow-xs cursor-pointer">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDeleteUser" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-all">
        <div class="bg-white rounded-lg border border-slate-100 shadow-xl w-full max-w-sm p-4 space-y-3 relative transform scale-95 transition-all">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center shrink-0 border border-rose-100/50">
                    <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                </div>
                <div class="space-y-0.5">
                    <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Supprimer le collaborateur</h3>
                    <p class="text-[11px] text-slate-400 leading-relaxed">
                        Êtes-vous sûr de vouloir supprimer <span id="delete_user_name" class="font-semibold text-slate-700"></span> ? Cette action est irréversible.
                    </p>
                </div>
            </div>
            <form action="/Pharmafefo-/src/controller/UserController.php" method="POST">
                <input type="hidden" id="delete_user_id" name="id">
                <div class="flex items-center justify-end gap-1.5 border-t border-slate-100 pt-2.5 mt-2">
                    <button type="button" class="btnCloseModal border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-2.5 rounded-md hover:bg-slate-50 transition cursor-pointer">
                        Annuler
                    </button>
                    <button type="submit" name='deleteUser' class="bg-rose-600 hover:bg-rose-700 text-white font-medium py-1.5 px-2.5 rounded-md text-[11px] transition shadow-xs cursor-pointer flex items-center gap-1.5">
                        <i class="fa-solid fa-trash-can text-[10px] opacity-80"></i> Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modalAdd = document.getElementById('modalAddUser');
        const modalEdit = document.getElementById('modalEditUser');
        const modalDelete = document.getElementById('modalDeleteUser');
        
        // Ouvrir Modal Ajouter
        document.getElementById('btnOpenAddModal').addEventListener('click', () => {
            modalAdd.classList.remove('hidden');
        });

        // Ouvrir et pré-remplir la Modal Modifier
        document.querySelectorAll('.btnEditUser').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                
                const id = row.querySelector('.target-id').innerText.trim();
                const name = row.querySelector('.target-name').innerText.trim();
                const email = row.querySelector('.target-email').innerText.trim();
                const role = row.querySelector('.target-role').getAttribute('data-role');
                const status = row.querySelector('.target-status').getAttribute('data-status');
                
                document.getElementById('edit_user_id').value = id;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;
                document.getElementById('edit_status').value = status;
                
                modalEdit.classList.remove('hidden');
            });
        });

        // Ouvrir Modal Delete
        document.querySelectorAll('.btnDeleteUser').forEach(button => {
            button.addEventListener('click', (e) => {
                const btn = e.target.closest('.btnDeleteUser');
                const id = btn.getAttribute('data-id');
                const name = btn.getAttribute('data-name');
                
                document.getElementById('delete_user_id').value = id;
                document.getElementById('delete_user_name').innerText = name;
                
                modalDelete.classList.remove('hidden');
            });
        });

        // Fermer toutes les Modals
        document.querySelectorAll('.btnCloseModal').forEach(button => {
            button.addEventListener('click', () => {
                modalAdd.classList.add('hidden');
                modalEdit.classList.add('hidden');
                modalDelete.classList.add('hidden');
            });
        });

        // Fermeture automatique (Outside click)
        window.addEventListener('click', (e) => {
            if (e.target === modalAdd) modalAdd.classList.add('hidden');
            if (e.target === modalEdit) modalEdit.classList.add('hidden');
            if (e.target === modalDelete) modalDelete.classList.add('hidden');
        });
    </script>
</body>
</html>