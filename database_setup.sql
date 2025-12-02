-- ====================================
-- SCRIPT DE CRÉATION DE LA BASE DE DONNÉES
-- Intranet Ville d'Yzeure
-- ====================================

-- Création de la table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    service VARCHAR(150) NOT NULL,
    role ENUM('admin', 'cadre', 'agent') DEFAULT 'agent',
    actif BOOLEAN DEFAULT TRUE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    derniere_connexion TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_service (service)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des actualités
CREATE TABLE IF NOT EXISTS actualites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    auteur_id INT NOT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    publie BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_date_publication (date_publication),
    INDEX idx_auteur (auteur_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des documents
CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    categorie VARCHAR(100) NOT NULL,
    fichier VARCHAR(255) NOT NULL,
    taille_fichier INT,
    type_mime VARCHAR(100),
    auteur_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    telechargements INT DEFAULT 0,
    FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_categorie (categorie),
    INDEX idx_date_creation (date_creation),
    INDEX idx_auteur (auteur_id),
    FULLTEXT idx_recherche (titre, description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des catégories de documents
CREATE TABLE IF NOT EXISTS categories_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    icone VARCHAR(50),
    ordre INT DEFAULT 0,
    INDEX idx_ordre (ordre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des événements/calendrier
CREATE TABLE IF NOT EXISTS evenements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    lieu VARCHAR(255),
    type VARCHAR(50),
    auteur_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_dates (date_debut, date_fin),
    INDEX idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des liens utiles
CREATE TABLE IF NOT EXISTS liens_utiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    url VARCHAR(500) NOT NULL,
    description TEXT,
    categorie VARCHAR(100),
    icone VARCHAR(50),
    ordre INT DEFAULT 0,
    actif BOOLEAN DEFAULT TRUE,
    INDEX idx_categorie (categorie),
    INDEX idx_ordre (ordre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des logs d'activité
CREATE TABLE IF NOT EXISTS logs_activite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    description TEXT,
    ip_address VARCHAR(45),
    date_action TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_date (date_action),
    INDEX idx_action (action)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================
-- INSERTION DES DONNÉES INITIALES
-- ====================================

-- Insertion de catégories de documents
INSERT INTO categories_documents (nom, description, icone, ordre) VALUES
('procedures', 'Procédures administratives', 'tasks', 1),
('guides', 'Guides et manuels', 'book-open', 2),
('deliberations', 'Délibérations du conseil municipal', 'gavel', 3),
('formulaires', 'Formulaires administratifs', 'file-alt', 4),
('revue-presse', 'Revue de presse', 'newspaper', 5);

-- Insertion d'un utilisateur administrateur par défaut
-- Mot de passe : admin123 (à changer immédiatement en production!)
INSERT INTO users (nom, prenom, email, password, service, role) VALUES
('Admin', 'Administrateur', 'admin@yzeure.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Direction Générale', 'admin');

-- Insertion de quelques liens utiles
INSERT INTO liens_utiles (titre, url, description, categorie, icone, ordre) VALUES
('Site officiel de la ville', 'https://www.ville-yzeure.fr', 'Site web public de la ville d\'Yzeure', 'externe', 'globe', 1),
('Centre de Gestion de l\'Allier', 'https://www.cdg03.fr', 'Centre de gestion de la fonction publique territoriale', 'externe', 'building', 2),
('Légifrance', 'https://www.legifrance.gouv.fr', 'Service public de la diffusion du droit', 'externe', 'balance-scale', 3);

-- Insertion d'une actualité de bienvenue
INSERT INTO actualites (titre, contenu, auteur_id) VALUES
('Bienvenue sur le nouvel intranet', 
'Bienvenue sur le nouvel intranet de la Ville d\'Yzeure. Vous trouverez ici toutes les informations et outils nécessaires à votre travail quotidien. N\'hésitez pas à explorer les différentes sections et à contacter le service informatique si vous avez des questions.', 
1);

-- ====================================
-- FIN DU SCRIPT
-- ====================================