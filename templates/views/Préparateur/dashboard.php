<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
require_once __DIR__ . "/../../../config/database.php"; 
require_once __DIR__ . "/../../../src/repository/MedicalRepository.php"; 

// 2. Instanciation dial l-BDD u l-Repository
$dbInstance = new Database(); 
$pdo = $dbInstance->getConnection(); 
$repository = new ProductRepository($pdo); 

$Allusers = $repository->GetAllProducts();

$product_results = isset($_SESSION['fefo_results']) ? $_SESSION['fefo_results'] : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Préparateur - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-[12px] antialiased">

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
                <div class="w-8 h-8 rounded-md bg-teal-600/20 text-teal-400 border border-teal-500/20 flex items-center justify-center text-[11px] font-bold"><?php echo $userInitials; ?></div>
                <div>
                    <p class="text-[12px] font-medium text-slate-200 leading-tight"><?= $name ?></p>
                    <p class="text-[10px] text-teal-500 font-medium leading-none mt-0.5"><?= $role ?></p>
                </div>
            </div>
            <a href="../logout.php" class="flex items-center justify-between px-2.5 py-1.5 text-rose-400/90 hover:text-rose-100 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/10 rounded-md transition duration-200 group font-medium text-[11px]">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-right-from-bracket w-4 text-center text-rose-400/60 group-hover:text-rose-400 transition"></i>
                    <span class="tracking-wide">Déconnexion</span>
                </div>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">

        <header class="bg-white border-b border-slate-100 h-12 flex items-center justify-between px-5 shrink-0 shadow-xs">
            <h1 class="text-[13px] font-semibold text-slate-800">Espace Préparateur & Logistique - Epic 1</h1>
            <div class="flex items-center gap-3">
                <button class="relative p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-md transition">
                    <i class="fa-solid fa-bell text-xs"></i>
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <div class="p-5 space-y-4 max-w-7xl w-full mx-auto">

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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                <div class="lg:col-span-1 bg-white p-4 rounded-lg border border-slate-100 shadow-sm h-fit">
                    <h3 class="text-[11px] font-bold text-slate-800 mb-3.5 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-square-plus text-teal-500"></i> US 1.1 : Entrée Produit
                    </h3>
                    <?php if (isset($_GET['error_empty']) || isset($_SESSION['error_message'])): ?>
                        <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-2.5 rounded-md mb-4 flex items-center gap-2 text-[11px] font-medium">
                            <i class="fa-solid fa-circle-exclamation text-rose-500 text-xs"></i>
                            <span>
                                <?php
                                echo $_SESSION['error_message'] ?? "All fields are required, and the quantity must be greater than zero.";
                                unset($_SESSION['error_message']);
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-2.5 rounded-md mb-4 flex items-center gap-2 text-[11px] font-medium">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i>
                            <span><?php echo $_SESSION['success_message'] ?? "Product successfully accepted!";
                            unset($_SESSION['success_message']); ?></span>
                        </div>
                    <?php endif; ?>
                    <form action="/Pharmafefo-/src/controller/MedicalController.php" method="POST" class="space-y-3" onsubmit="return validateFEFOForm(event)">
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Médicament</label>
                            <input type="text" name="pruduct_name" required placeholder="Ex: Augmentin 500mg" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Numéro de Lot</label>
                            <input type="text" name="product_lot" required placeholder="Ex: LOT-2026-X9" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Emplacement</label>
                            <input type="text" name="Emplacement" required placeholder="Ex: Tiroir B-12" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Date Limite d'Utilisation (DLU)</label>
                            <input type="date" name="date_expiration" id="dlu_input" required class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                            <span class="text-[10px] text-rose-500 mt-0.5 hidden font-medium" id="date_error">La date doit être aujourd'hui ou dans le futur.</span>
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Quantité Reçue</label>
                            <input type="number" name="stok" required min="1" placeholder="Ex: 50" class="w-full px-2.5 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-teal-500 text-[11px] bg-slate-50/40 transition">
                        </div>
                        <button type="submit" name="Enregistrer" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-1.5 rounded-md transition text-[11px] cursor-pointer shadow-xs mt-1">
                            Classer dans la file FEFO
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white p-4 rounded-lg border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-wand-magic-sparkles text-sky-500"></i> Assistant Dispensation FEFO
                            </h3>
                            <span class="text-[9px] bg-sky-50 text-sky-700 px-2 py-0.5 rounded-sm font-bold border border-sky-100/50 uppercase tracking-wider">Algorithme Actif</span>
                        </div>
                        <p class="text-[11px] text-slate-400 mb-3">Saisissez le médicament demandé pour cibler automatiquement le lot prioritaire.</p>

                        <form action="/Pharmafefo-/src/controller/MedicalController.php" method="post" class="space-y-4">
    <input type="hidden" name="action" value="search_classic">
    
    <div class="relative">
        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-[10px]"></i>
        <input type="text" name="query" value="<?php echo isset($_SESSION['last_search']) ? htmlspecialchars($_SESSION['last_search']) : ''; ?>" placeholder="Saisissez le médicament demandé (Ex: Doliprane)..." class="w-full pl-7 pr-20 py-1.5 border border-slate-200 rounded-md focus:outline-hidden focus:border-sky-500 text-[11px] font-medium bg-slate-50/40 transition">
        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-sky-600 hover:bg-sky-700 text-white px-3 rounded-md text-[10px] font-medium transition">
            Chercher
        </button>
    </div>
</form>

                        <div class="space-y-3 mt-4">
                            <?php 
$prod = $_SESSION['fefo_results'] ?? null; 
$search_error = $_SESSION['fefo_search_error'] ?? null;
?>

<?php if (!empty($prod) && is_array($prod)): ?>
    <div class="bg-slate-950 text-slate-300 p-3.5 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3 border border-slate-900 shadow-xs">
        <div class="space-y-0.5">
            <span class="text-[9px] uppercase font-bold tracking-wider text-amber-400 bg-amber-400/10 px-1.5 py-0.5 rounded-xs border border-amber-400/10">
                Lot Prioritaire Détecté (À Sortir d'abord)
            </span>
            
            <h4 class="text-[13px] font-semibold text-white mt-1">
                <?php echo htmlspecialchars($prod['product_name']); ?>
            </h4>
            
            <div class="flex items-center gap-3 text-[11px] text-slate-400">
                <span>Lot: <b class="font-medium text-slate-200"><?php echo htmlspecialchars($prod['lot_number']); ?></b></span>
                <span>Expire le: <b class="font-medium text-rose-400"><?php echo date('d/m/Y', strtotime($prod['expiration_date'])); ?></b></span>
                <span>Quantité: <b class="font-medium text-sky-400"><?php echo $prod['quantity']; ?> u</b></span>
            </div>
        </div>
        
        <div class="bg-slate-900/60 p-1.5 px-3 rounded-md border border-slate-800/80 text-center min-w-24">
            <span class="text-[9px] text-slate-500 block uppercase font-medium tracking-wider">Emplacement</span>
            <span class="text-[12px] font-semibold text-teal-400">
                <?php echo htmlspecialchars($prod['Emplacement'] ?? 'Non spécifié'); ?>
            </span>
        </div>
    </div>

<?php else: ?>
    <div class="bg-slate-950 text-slate-400 p-4 rounded-lg border border-slate-900 text-center text-[11px] italic">
        <?php echo $search_error ?? "Veuillez chercher un médicament pour afficher ses lots..."; ?>
    </div>
<?php 
endif; 

unset($_SESSION['fefo_results']);
unset($_SESSION['fefo_search_error']);
?>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button class="bg-sky-600 hover:bg-sky-700 text-white font-medium py-1.5 px-3 rounded-md transition text-[11px] flex items-center gap-1.5 cursor-pointer shadow-xs">
                            <i class="fa-solid fa-check text-[10px]"></i> Confirmer la sortie
                        </button>
                    </div>
                </div>
            </div>

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
                            <?php if (!empty($Allusers)): ?>
                                <?php foreach ($Allusers as $user): 
                                    $today_date = new DateTime();
                                    $expire_date = new DateTime($user['expiration_date']);
                                    $interval = $today_date->diff($expire_date);
                                    $days_left = $interval->format('%r%a'); 
                                    if ($days_left <= 30) {
                                        $status_text = "Priorité 1 (Urgent)";
                                        $badge_class = "bg-rose-50 text-rose-700 border border-rose-100";
                                        $date_class = "text-rose-600 font-medium";
                                    } elseif ($days_left <= 90) {
                                        $status_text = "Priorité 2";
                                        $badge_class = "bg-amber-50 text-amber-700 border border-amber-100";
                                        $date_class = "text-amber-600 font-medium";
                                    } else {
                                        $status_text = "En Attente";
                                        $badge_class = "bg-emerald-50 text-emerald-700 border border-emerald-100";
                                        $date_class = "text-emerald-600 font-medium";
                                    }
                                ?>
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="p-2 font-medium text-slate-800"><?php echo htmlspecialchars($user['product_name']); ?></td>
                                        <td class="p-2 text-slate-500 font-mono"><?php echo htmlspecialchars($user['lot_number']); ?></td>
                                        <td class="p-2">
                                            <span class="bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded-sm font-medium">
                                                <?php echo htmlspecialchars($user['Emplacement'] ?? 'Non spécifié'); ?>
                                            </span>
                                        </td>
                                        <td class="p-2 <?php echo $date_class; ?>">
                                            <?php echo date('d/m/Y', strtotime($user['expiration_date'])); ?>
                                        </td>
                                        <td class="p-2">
                                            <span class="<?php echo $badge_class; ?> px-2 py-0.5 rounded-sm font-bold text-[9px] uppercase">
                                                <?php echo $status_text; ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-slate-400 italic">
                                        No products found in the FEFO queue.
                                    </td>
                                </tr>
                            <?php endif; ?> 
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

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