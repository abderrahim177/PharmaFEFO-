<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../../../config/database.php"; 
require_once __DIR__ . "/../../../src/repository/StockBatchRepository.php"; 
$dbInstance = new Database(); 
$pdo = $dbInstance->getConnection(); 
$repository = new TotalLots($pdo);
$criticiteStats = $repository->getLotsCriticiteStats();
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
            <a href="logout.php" class="flex items-center gap-2.5 px-3 py-1.5 text-xs font-medium text-rose-400/80 hover:text-rose-400 hover:bg-rose-500/5 rounded-md transition w-full">
                <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i> Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="bg-white border-b border-slate-200 h-14 flex items-center justify-between px-6 shrink-0">
            <h1 class="text-[13px] font-medium text-slate-800">Supervision du Titulaire</h1>
            <div class="bg-amber-50 text-amber-800 border border-amber-100/60 px-2.5 py-1 rounded-md text-[11px] font-medium flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-bell text-amber-600 text-[10px]"></i> 14 produits expirent le mois prochain
            </div>
        </header>

        <div class="p-6 space-y-5 max-w-7xl w-full mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-xl border-l-2 border-rose-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Alerte Rouge (&lt; 30j)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_rouge']; ?> Lots</p>
                    </div>
                    <span class="text-[10px] bg-rose-50 text-rose-700 px-2 py-0.5 rounded-md font-medium border border-rose-100/50">Action requise</span>
                </div>
                <div class="bg-white p-4 rounded-xl border-l-2 border-amber-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Alerte Orange (&lt; 90j)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_orange']; ?> Lots</p>
                    </div>
                    <span class="text-[10px] bg-amber-50 text-amber-700 px-2 py-0.5 rounded-md font-medium border border-amber-100/50">À déstocker</span>
                </div>
                <div class="bg-white p-4 rounded-xl border-l-2 border-emerald-500 shadow-3xs flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">Sécurité Vert (&gt; 6m)</p>
                        <p class="text-xl font-semibold mt-0.5 text-slate-800"><?php echo $criticiteStats['total_vert']; ?> Lots
                    </div>
                    <span class="text-[10px] bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-md font-medium border border-emerald-100/50">Conforme</span>
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
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-2.5 px-4 font-medium text-slate-700">Amoxicilline Sandoz 500mg</td>
                                <td class="py-2.5 px-4 font-mono text-[11px] text-slate-500">AMZ-2024-B8</td>
                                <td class="py-2.5 px-4 text-rose-600 font-medium">01/06/2026 (Dépassée)</td>
                                <td class="py-2.5 px-4">
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[10px] bg-rose-50 text-rose-700 font-medium border border-rose-100/50">
                                        Alerte Rouge
                                    </span>
                                </td>
                                <td class="py-2.5 px-4 text-slate-500">14 boîtes</td>
                                <td class="py-2.5 px-4 text-right">
                                    <button class="bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white px-2 py-1 rounded-md text-[11px] font-medium transition border border-rose-100/80 cursor-pointer">
                                        Retirer (Status::EXPIRED)
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="py-2.5 px-4 font-medium text-slate-700">Kardegic 75mg</td>
                                <td class="py-2.5 px-4 font-mono text-[11px] text-slate-500">KARD-882-Z</td>
                                <td class="py-2.5 px-4 text-amber-600 font-medium">15/08/2026</td>
                                <td class="py-2.5 px-4">
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[10px] bg-amber-50 text-amber-700 font-medium border border-amber-100/50">
                                        Alerte Orange
                                    </span>
                                </td>
                                <td class="py-2.5 px-4 text-slate-500">120 boîtes</td>
                                <td class="py-2.5 px-4 text-right">
                                    <button class="text-slate-600 hover:bg-slate-100 px-2 py-1 rounded-md text-[11px] font-medium transition border border-slate-200 cursor-pointer">
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