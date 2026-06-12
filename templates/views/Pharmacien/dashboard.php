<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../../config/database.php"; 
require_once __DIR__ . "/../../../src/repository/StockBatchRepository.php"; 

try {
    $dbInstance = new Database(); 
    $pdo = $dbInstance->getConnection(); 
    $repository = new TotalLots($pdo); 
    $repository->checkAndGenerateNotifications();
    $allNotifications = $repository->getUnreadNotifications(); 
    $criticiteStats = $repository->getLotsCriticiteStats();
    $Stocks = $repository->getStockProducts();

} catch (Exception $e) {
    die("Erreur Fatale Dashboard: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pharmacien - PharmaStock</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; font-weight: 400; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 flex h-screen overflow-hidden text-xs">

    <aside class="w-60 bg-slate-900 text-slate-400 flex flex-col justify-between hidden md:flex border-r border-slate-800 shrink-0">
        <div>
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-800/60">
                <div class="w-7 h-7 bg-emerald-600 rounded-lg flex items-center justify-center text-white shadow-xs">
                    <i class="fa-solid fa-mortar-pestle text-xs"></i>
                </div>
                <span class="text-sm font-semibold tracking-tight text-white">PharmaStock</span>
            </div>
            
            <nav class="mt-4 px-3 space-y-0.5">
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 bg-emerald-600/10 text-emerald-400 rounded-md font-medium text-xs transition">
                    <i class="fa-solid fa-shield-halved text-xs"></i> Supervision & Alertes
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition text-slate-400">
                    <i class="fa-solid fa-clipboard-check text-xs opacity-70"></i> Inventaires
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition text-slate-400">
                    <i class="fa-solid fa-arrow-rotate-left text-xs opacity-70"></i> Retours Labo
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 hover:bg-slate-800/50 hover:text-slate-200 rounded-md text-xs font-normal transition text-slate-400">
                    <i class="fa-solid fa-sliders text-xs opacity-70"></i> Seuils d'alerte
                </a>
            </nav>
        </div>

        <div class="border-t border-slate-800/60 p-3 space-y-2">
            <div class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg bg-slate-950/40">
                <div class="w-7 h-7 rounded-md bg-emerald-600 flex items-center justify-center text-[10px] font-bold text-white shadow-xs">DR</div>
                <div class="leading-tight">
                    <p class="text-xs font-medium text-slate-200">Dr. Amine .B</p>
                    <p class="text-[10px] text-emerald-400">Titulaire</p>
                </div>
            </div>
            <a href="../logout.php" class="flex items-center gap-2.5 px-3 py-1.5 text-xs font-medium text-rose-400/80 hover:text-rose-400 hover:bg-rose-500/5 rounded-md transition w-full">
                <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i> Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
    <header class="bg-white border-b border-slate-200 h-14 flex items-center justify-between px-6 shrink-0 relative">
    <h1 class="text-[13px] font-medium text-slate-800">Supervision du Titulaire</h1>
    
    <div class="relative inline-block text-left" id="notification-wrapper">
        
        <button id="notif-btn" class="relative w-8 h-8 rounded-lg border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500 hover:text-slate-700 hover:bg-slate-100 hover:border-slate-300 transition cursor-pointer focus:outline-hidden">
            <i class="fa-solid fa-bell text-xs"></i>
            
            <?php 
            $notifCount = count($allNotifications); 
            if ($notifCount > 0): 
            ?>
                <span id="notif-count" class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[9px] font-medium text-white ring-2 ring-white animate-pulse">
                    <?php echo $notifCount; ?>
                </span>
            <?php endif; ?>
        </button>

        <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-xl border border-slate-200/85 shadow-lg shrink-0 z-50 overflow-hidden transform origin-top-right transition-all">
            
            <div class="px-3.5 py-2.5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
                <span class="text-[11px] font-semibold text-slate-700 uppercase tracking-wider">Notifications</span>
                
                <?php if ($notifCount > 0): ?>
                    <button id="mark-all-read" class="text-[10px] text-teal-600 hover:text-teal-700 font-medium hover:underline cursor-pointer">
                        Tout marquer comme lu
                    </button>
                <?php else: ?>
                    <button id="mark-all-read" class="text-[10px] text-slate-300 cursor-not-allowed no-underline" disabled>
                        Tout marquer comme lu
                    </button>
                <?php endif; ?>
            </div>

            <div id="notif-list" class="max-h-60 overflow-y-auto divide-y divide-slate-100">
                
                <?php 
                if ($notifCount > 0): 
                    foreach ($allNotifications as $notif): 
                        $dotColor = (isset($notif['type']) && $notif['type'] === 'warning') ? 'bg-amber-500' : 'bg-rose-500';
                ?>
                        <div class="p-3 hover:bg-slate-50/60 transition flex gap-2.5 items-start">
                            <div class="w-2 h-2 rounded-full <?php echo $dotColor; ?> mt-1 shrink-0"></div>
                            
                            <div class="space-y-0.5">
                                <p class="text-xs text-slate-700 font-normal leading-normal">
                                    <?php echo htmlspecialchars($notif['message']); ?>
                                </p>
                                <p class="text-[10px] text-slate-400">
                                    <i class="fa-regular fa-clock text-[9px]"></i> 
                                    <?php echo date('d/m/Y H:i', strtotime($notif['created_at'])); ?>
                                </p>
                            </div>
                        </div>
                <?php 
                    endforeach; 
                else: 
                ?>
                    <div class="p-6 text-center text-slate-400 italic flex flex-col items-center gap-1.5">
                        <i class="fa-solid fa-bell-slash text-slate-300 text-sm"></i>
                        <p class="text-[11px]">Aucune notification non lue</p>
                    </div>
                <?php endif; ?>

            </div>

            <div class="border-t border-slate-100 p-2 text-center bg-slate-50/30">
                <a href="#" class="block text-[10px] text-slate-400 hover:text-slate-600 font-medium transition">
                    Voir toutes les alertes
                </a>
            </div>
        </div>
    </div>
</header>
        <div class="p-6 space-y-5 max-w-7xl w-full mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-xl border-l-2 border-rose-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Alerte Rouge (&lt; 30j)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_rouge']; ?> Lots</p>
                    </div>
                    <span class="text-[10px] bg-rose-50 text-rose-700 px-2 py-0.5 rounded-md font-medium border border-rose-100/50 hover:cursor-pointer">Action requise</span>
                </div>
                <div class="bg-white p-4 rounded-xl border-l-2 border-amber-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Alerte Orange (&lt; 90j)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_orange']; ?> Lots</p>
                    </div>
                    <span class="text-[10px] bg-amber-50 text-amber-700 px-2 py-0.5 rounded-md font-medium border border-amber-100/50 hover:cursor-pointer">À déstocker</span>
                </div>
                <div class="bg-white p-4 rounded-xl border-l-2 border-emerald-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Sécurité Vert (&gt; 6m)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_vert']; ?> Lots
                    </div>
                    <span class="text-[10px] bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-md font-medium border border-emerald-100/50 hover:cursor-pointer">Conforme</span>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200/80 shadow-3xs overflow-hidden">
                <div class="p-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-800 uppercase tracking-wider">Suivi des Lots & Niveaux de Criticité</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Vue d'ensemble ordonnée selon la file d'attente réglementaire.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="px-2.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-md text-[11px] font-medium flex items-center gap-1.5 transition cursor-pointer shadow-3xs">
                            <i class="fa-solid fa-filter text-[9px]"></i> Voir "Alerte Rouge"
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] font-medium uppercase tracking-wider text-slate-400 border-b border-slate-200/60">
                                <th class="py-2.5 px-4">Médicament</th>
                                <th class="py-2.5 px-4">N° de Lot</th>
                                <th class="py-2.5 px-4">Date Péremption</th>
                                <th class="py-2.5 px-4">Criticité</th>
                                <th class="py-2.5 px-4">Qte Restante</th>
                                <th class="py-2.5 px-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-600">
    <?php 
    if (!empty($Stocks)): 
        $today = new DateTime();
        
        foreach ($Stocks as $stock): 
            $expiryDate = new DateTime($stock['expiration_date']);
            $interval = $today->diff($expiryDate);
            $daysLeft = $interval->days;
            
            if ($interval->invert) {
                $daysLeft = -$daysLeft; 
            }
            $dbStatus = isset($stock['status']) ? strtolower(trim($stock['status'])) : 'available';
            if ($dbStatus === 'expired' || $dbStatus === 'retiré') {
                $badgeText = "Retiré / Expiré";
                $badgeClass = "bg-slate-100 text-slate-600 border-slate-200";
                $dateClass = "text-slate-400 line-through";
                $dateLabel = "";
                $actionButton = '<span class="text-[11px] text-slate-400 italic">Lot Hors-Service</span>';

            } elseif ($dbStatus === 'retour_pending' || $dbStatus === 'en retour') {
                $badgeText = "En Retour Labo";
                $badgeClass = "bg-blue-50 text-blue-700 border-blue-100/50";
                $dateClass = "text-slate-500";
                $dateLabel = "";
                $actionButton = '<span class="text-[11px] text-blue-600 font-medium px-2 py-1"><i class="fa-solid fa-truck-ramp-box text-[9px]"></i> En cours...</span>';

            } else {
                if ($daysLeft <= 0) {
                    $badgeText = "Alerte Rouge";
                    $badgeClass = "bg-rose-50 text-rose-700 border-rose-100/50";
                    $dateClass = "text-rose-600 font-medium";
                    $dateLabel = " (Dépassée)";
                    $actionButton = '<button class="bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white px-2 py-1 rounded-md text-[11px] font-medium transition border border-rose-100/80 cursor-pointer">Retirer (Status::EXPIRED)</button>';
                } elseif ($daysLeft <= 30) {
                    $badgeText = "Alerte Rouge";
                    $badgeClass = "bg-rose-50 text-rose-700 border-rose-100/50";
                    $dateClass = "text-rose-600 font-medium";
                    $dateLabel = " (< 30j)";
                    $actionButton = '<button class="bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white px-2 py-1 rounded-md text-[11px] font-medium transition border border-rose-100/80 cursor-pointer">Retirer (Urgent)</button>';
                } elseif ($daysLeft <= 90) {
                    $badgeText = "Alerte Orange";
                    $badgeClass = "bg-amber-50 text-amber-700 border-amber-100/50";
                    $dateClass = "text-amber-600 font-medium";
                    $dateLabel = "";
                    $actionButton = '<button class="text-slate-600 hover:bg-slate-100 px-2 py-1 rounded-md text-[11px] font-medium transition border border-slate-200 cursor-pointer">Retour Fournisseur</button>';
                } else {
                    $badgeText = "Sécurité Vert";
                    $badgeClass = "bg-emerald-50 text-emerald-700 border-emerald-100/50";
                    $dateClass = "text-slate-500";
                    $dateLabel = "";
                    $actionButton = '<span class="text-[11px] text-emerald-600 font-medium px-2 py-1"><i class="fa-solid fa-check text-[9px]"></i> Conforme</span>';
                }
            }
            ?>
            
            <tr class="hover:bg-slate-50/40 transition">
                <td class="py-2.5 px-4 font-medium text-slate-700">
                    <?php echo htmlspecialchars($stock['product_name']); ?>
                </td>
                <td class="py-2.5 px-4 font-mono text-[11px] text-slate-500">
                    <?php echo htmlspecialchars($stock['lot_number']); ?>
                </td>
                <td class="py-2.5 px-4 <?php echo $dateClass; ?>">
                    <?php echo date('d/m/Y', strtotime($stock['expiration_date'])) . $dateLabel; ?>
                </td>
                <td class="py-2.5 px-4">
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[10px] font-medium border <?php echo $badgeClass; ?>">
                        <?php echo $badgeText; ?>
                    </span>
                </td>
                <td class="py-2.5 px-4 text-slate-500">
                    <?php echo intval($stock['quantity']); ?> boîtes
                </td>
                <td class="py-2.5 px-4 text-right">
                    <?php echo $actionButton; ?>
                </td>
            </tr>

        <?php 
        endforeach; 
    else: 
    ?>
        <tr>
            <td colspan="6" class="py-6 text-center text-slate-400 italic">
                Aucun lot disponible dans le stock actuellement.
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
    document.addEventListener("DOMContentLoaded", () => {
        const notifBtn = document.getElementById('notif-btn');
        const notifDropdown = document.getElementById('notif-dropdown');
        const notifCount = document.getElementById('notif-count');
        const notifList = document.getElementById('notif-list');
        const markAllReadBtn = document.getElementById('mark-all-read');

        notifBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            notifDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!notifDropdown.contains(e.target) && e.target !== notifBtn) {
                notifDropdown.classList.add('hidden');
            }
        });

        markAllReadBtn.addEventListener('click', () => {
            if (notifCount) {
                notifCount.style.display = 'none';
            }
            
            notifList.innerHTML = `
                <div class="p-6 text-center text-slate-400 italic flex flex-col items-center gap-1.5">
                    <i class="fa-solid fa-bell-slash text-slate-300 text-sm"></i>
                    <p class="text-[11px]">Aucune notification non lue</p>
                </div>
            `;
            
            markAllReadBtn.disabled = true;
            markAllReadBtn.classList.remove('text-teal-600', 'hover:text-teal-700');
            markAllReadBtn.classList.add('text-slate-300', 'cursor-not-allowed', 'no-underline');
        });
    });
</script>
</body>
</html>