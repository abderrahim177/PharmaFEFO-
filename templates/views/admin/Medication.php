<?php  
require_once __DIR__ . "/../../../src/repository/MedicalRepository.php"; 
require_once __DIR__ . '/../../../config/Database.php';
// 2. Instanciation dial l-BDD u l-Repository
$dbInstance = new Database(); 
$pdo = $dbInstance->getConnection(); 
$repository = new ProductRepository($pdo); 
 $products = $repository->GetAllProductsGloubal();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicaments - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-sm">

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

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white border-b border-slate-100 h-14 flex items-center justify-between px-6 shrink-0 shadow-xs">
            <h1 class="text-sm font-semibold text-slate-800">Console d'Administration</h1>
            <div class="flex items-center gap-2 text-[10px] font-medium text-slate-400 uppercase tracking-wider bg-slate-50 px-2.5 py-1 rounded-full border border-slate-100">
                <span class="h-1.5 w-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Claude Bernard connecté
            </div>
        </header>

        <div class="p-6 space-y-5 max-w-6xl w-full mx-auto">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div>
                    <h2 class="text-xs font-semibold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-pills text-indigo-500 text-xs"></i> Catalogue des Médicaments
                    </h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Gérez la base de données des produits, tarifications et liaisons avec le référentiel Claude Bernard.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                
                <div class="p-3.5 border-b border-slate-100 bg-slate-50/40 flex items-center justify-between gap-4">
                    <div class="relative w-full max-w-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-[11px]"></i>
                        <input type="text" placeholder="Rechercher par nom, code CIP..." class="w-full pl-8 pr-3 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-indigo-500 focus:bg-white text-xs bg-white transition shadow-2xs">
                    </div>
                    <span class="text-[11px] text-slate-400 font-medium bg-slate-200/50 px-2 py-0.5 rounded">3 produits enregistrés</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[10px] font-semibold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                <th class="py-2.5 px-4 w-12 text-center">ID</th>
                                <th class="py-2.5 px-4">Lot_number</th>
                                <th class="py-2.5 px-4">Désignation Commerciale</th>
                                <th class="py-2.5 px-4">Date creaction</th>
                                <th class="py-2.5 px-4 text-right">P. Achat</th>
                                <th class="py-2.5 px-4 text-right w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs text-slate-600">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $index => $prod): ?>
            <tr class="hover:bg-slate-50/40 transition">
                <td class="py-3 px-4 text-center font-mono text-[11px] text-slate-400 target-id">
                    <?php echo $index + 1; ?>
                </td>
                
                <td class="py-3 px-4 font-mono text-[11px] text-slate-500 tracking-tight target-cip">
                    <?php echo htmlspecialchars($prod['lot_number']); ?>
                </td>
                
                <td class="py-3 px-4 font-medium text-slate-800 target-designation">
                    <?php echo htmlspecialchars($prod['product_name']); ?>
                </td>
                
                <td class="py-3 px-4 text-slate-400 text-[11px] target-forme">
                    Ajouté le: <?php echo date('d/m/Y', strtotime($prod['created_at'])); ?>
                </td>
                
                <td class="py-3 px-4 text-right font-medium text-sky-600 target-prix-achat">
                    <?php echo $prod['quantity']; ?> u
                </td>
                
                <td class="py-3 px-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <button title="Supprimer" 
                        data-id="<?php echo $prod['product_id']; ?>" 
                        data-name="<?php echo htmlspecialchars($prod['product_name']); ?>" 
                        class="btnDeleteProduct p-1 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded transition cursor-pointer">
                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="py-6 text-center text-slate-400 italic bg-slate-50/20">
                Aucun produit disponible pour le moment.
            </td>
        </tr>
    <?php endif; ?>
</tbody>
                    </table>
                </div>

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

    <div id="modalDeleteProduct" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4 hidden opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-xl border border-slate-100 shadow-xl max-w-sm w-full overflow-hidden transform scale-95 transition-transform duration-200">
        <div class="p-5 text-center space-y-3">
            <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto border border-rose-100">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
            </div>
            <div class="space-y-1">
                <h3 class="text-xs font-semibold text-slate-800 uppercase tracking-wider">Supprimer le produit ?</h3>
                <p class="text-[11px] text-slate-400 leading-normal">
                    Êtes-vous sûr de vouloir supprimer <span id="delete_product_name" class="font-semibold text-slate-700"></span> du catalogue ? Cette action است irréversible.
                </p>
            </div>
        </div>
        
        <form action="/Pharmafefo-/src/controller/MedicalController.php" method="POST" class="px-5 pb-5">
            <input type="hidden" name="action" value="delete_product">
            <input type="hidden" id="delete_product_id" name="product_id">
            
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" class="btnCloseModal w-full border border-slate-200 text-slate-600 text-[11px] font-medium py-1.5 px-3 rounded-md hover:bg-slate-50 transition cursor-pointer">
                    Annuler
                </button>
                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-medium py-1.5 px-3 rounded-md text-[11px] transition shadow-xs flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-trash-can text-[10px]"></i> Supprimer
                </button>
            </div>
        </form>
    </div>
</div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Open Modal b animation flat smooth
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if(!modal) return;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('.transform').classList.remove('scale-95');
            }, 10);
        }

        // Close active Modals
        function closeModal() {
            const modals = document.querySelectorAll('[id^="modal"]');
            modals.forEach(modal => {
                if(!modal.classList.contains('hidden')) {
                    modal.classList.add('opacity-0');
                    modal.querySelector('.transform').classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 200);
                }
            });
        }

        // Bind events pour fermer les modals
        document.querySelectorAll('.btnCloseModal').forEach(btn => {
            btn.addEventListener('click', closeModal);
        });

        // Close on backdrop click
        window.addEventListener('click', function(e) {
            if (e.target.matches('[id^="modal"]')) {
                closeModal();
            }
        });

        // --- TRIGGER 3: OPEN DELETE MODAL + SET TARGET DETAILS ---
        document.querySelectorAll('.btnDeleteProduct').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.querySelector('.target-id').textContent.trim();
                const designation = row.querySelector('.target-designation').textContent.trim();

                document.getElementById('delete_product_id').value = id;
                document.getElementById('delete_product_name').textContent = designation;

                openModal('modalDeleteProduct');
            });
        });
    });
    </script>

</body>
</html>