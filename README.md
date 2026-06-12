# PharmaFEFO-
# 💊 PharmaFEFO - Système de Gestion de Stock Strict FEFO

PharmaFEFO est une application web de gestion des stocks de médicaments conçue spécifiquement pour les pharmacies d'officine et les dépôts de cliniques. L'application répond à une double problématique : minimiser les pertes financières dues aux produits périmés et éliminer le risque sanitaire lié à l'administration de médicaments hors date, en imposant une logique stricte de rotation **FEFO (First Expired, First Out)**.

---

## 🚀 Fonctionnalités Clés & Logique Métier

### ⚖️ Le Cœur FEFO (First Expired, First Out)
Contrairement à un système FIFO classique, PharmaFEFO trie et suggère automatiquement la sortie du lot **dont la date limite d'utilisation (DLU) est la plus proche**, indépendamment de sa date d'entrée en stock. Lors d'une dispensation, le système désigne au préparateur le tiroir exact et le numéro de lot à prélever.

### 🎨 Algorithme de Criticité (Alertes Visuelles)
Le système calcule en temps réel l'état de chaque lot et applique un code couleur strict basé sur des seuils prédictifs :
* 🟢 **Vert (Sécurisé) :** Expiration > 6 mois (DLU éloignée).
* 🟠 **Orange (Vigilance) :** Expiration < 90 jours (Alerte préventive pour déstockage ou retour fournisseur).
* 🔴 **Rouge (Critique) :** Expiration < 30 jours (Action immédiate requise).

---

## 👥 Matrice des Rôles & Droits (Sécurité RBAC)

L'accès aux stocks et à la base de données est hautement régulé et segmenté en 3 niveaux :

| Rôle | Description | Droits Principaux |
| :--- | :--- | :--- |
| **Préparateur / Gestionnaire** | Opérationnel de terrain | Réceptionner les commandes, scanner les entrées (Lots/DLU), enregistrer les sorties (-1). |
| **Pharmacien Titulaire** | Supervision médicale | Valider les inventaires, gérer les retours laboratoires, configurer les seuils d'alerte. |
| **Administrateur** | Gestion globale & Sécurité | Gérer les utilisateurs, maintenir la base de données des médicaments, extraire les rapports financiers. |

---

## 🏗️ Architecture du Projet (Target MVC Pattern)

Le projet est structuré selon le design pattern **MVC (Modèle-Vue-Contrôleur)** couplé à un **Data Mapper (Repository)** pour isoler complètement la logique métier des requêtes SQL SQL.

```text
pharmafefo/
├── config/                  # Configurations globales
│   └── database.php         # Connexion PDO encapsulée (Sans Singleton)
├── public/                  # Point d'entrée Unique (DocumentRoot)
│   ├── css/                 # Styles d'interface (Tailwind CSS)
│   └── index.php            # CONTRÔLEUR FRONTAL / ROUTEUR
├── src/                     # Logique Métier (Namespace PharmaFEFO\)
│   ├── Controller/          # Aiguillage et traitement des requêtes HTTP
│   │   ├── DashboardController.php
│   │   └── StockController.php
│   ├── Entity/              # Objets métiers PHP purs et encapsulés
│   │   ├── Product.php
│   │   └── StockBatch.php
│   ├── Enum/                # Typage strict des statuts
│   │   └── BatchStatus.php  # (OK, WARNING, CRITICAL, RETURN_PROCESS)
│   └── Repository/          # Abstraction SQL (Design Pattern Data Mapper)
│       └── StockBatchRepository.php
└── templates/               # Couche Présentation (Vues HTML isolées)
    ├── dashboard/
    │   └── index.php        # Liste des alertes péremption
    └── layout/
        └── base.php         # Header / Footer commun (Poppins font)

[Réception Commande] ──> Saisie Lot + DLU ──> [File d'attente FEFO Triée]
                                                      │
[Calcul Statut] <── (Vert / Orange / Rouge) 🧮 🏎️ ───┤
                                                      │
[Demande Sortie] ──> [Système Désigne Lot le Plus Proche] ──> Décrémentation Stock