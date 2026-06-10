-- 1. Table des Utilisateurs
CREATE DATABASE pharmaFEFO;
USE pharmaFEFO;
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('Preparateur', 'Pharmacien', 'Administrateur') NOT NULL
);

-- 2. Table des Médicaments (Catalogue)
CREATE TABLE medicaments (
    id_medicament INT AUTO_INCREMENT PRIMARY KEY,
    code_cip VARCHAR(13) UNIQUE NOT NULL, -- Code identifiant unique du médicament
    nom_commercial VARCHAR(150) NOT NULL,
    dosage VARCHAR(50),
    prix_achat DECIMAL(10, 2) NOT NULL,   -- Nécessaire pour le rapport financier des pertes (US 4.2)
    prix_vente DECIMAL(10, 2) NOT NULL
);

-- 3. Table des Lots (Le Coeur du système FEFO)
CREATE TABLE lots (
    id_lot INT AUTO_INCREMENT PRIMARY KEY,
    id_medicament INT NOT NULL,
    numero_lot VARCHAR(50) NOT NULL,
    quantite_initiale INT NOT NULL,
    quantite_actuelle INT NOT NULL CHECK (quantite_actuelle >= 0),
    date_reception DATE NOT NULL DEFAULT (CURRENT_DATE),
    date_peremption DATE NOT NULL,
    statut ENUM('AVAILABLE', 'EXPIRED') DEFAULT 'AVAILABLE',
    FOREIGN KEY (id_medicament) REFERENCES medicaments(id_medicament) ON DELETE CASCADE,
    CONSTRAINT chk_date_peremption CHECK (date_peremption >= date_reception) -- US 1.1
);

-- 4. Table des Mouvements de Stock (Traçabilité)
CREATE TABLE mouvements_stock (
    id_mouvement INT AUTO_INCREMENT PRIMARY KEY,
    id_lot INT NOT NULL,
    id_user INT NOT NULL,
    type_mouvement ENUM('ENTREE_RECEPTION', 'SORTIE_VENTE', 'SORTIE_PERTE') NOT NULL,
    quantite INT NOT NULL CHECK (quantite > 0),
    date_mouvement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lot) REFERENCES lots(id_lot) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

-- 5. Table des Notifications (US 2.2)
CREATE TABLE notifications (
    id_notification INT AUTO_INCREMENT PRIMARY KEY,
    id_lot INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    statut_lecture BOOLEAN DEFAULT FALSE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lot) REFERENCES lots(id_lot) ON DELETE CASCADE
);