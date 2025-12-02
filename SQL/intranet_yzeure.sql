-- =============================================
-- BASE DE DONNÉES INTRANET MAIRIE D'YZEURE
-- Conforme cahier des charges Ametys
-- =============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la base
CREATE DATABASE IF NOT EXISTS `intranet_yzeure` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `intranet_yzeure`;

-- =============================================
-- TABLE: directions
-- Stocke les directions de la mairie
-- =============================================
CREATE TABLE `directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `nom_court` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `directeur_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT 0,
  `couleur` varchar(7) DEFAULT '#3498db',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_directeur` (`directeur_id`),
  KEY `idx_parent` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: services
-- Stocke les services de la mairie
-- =============================================
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `direction_id` int(11) NOT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ordre` int(11) DEFAULT 0,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_direction` (`direction_id`),
  KEY `idx_responsable` (`responsable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: postes
-- Stocke les types de postes
-- =============================================
CREATE TABLE `postes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `niveau` int(11) DEFAULT 1 COMMENT '1=Agent, 2=Adjoint, 3=Responsable, 4=Directeur, 5=DGS',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: agents
-- Stocke tous les agents de la mairie
-- =============================================
CREATE TABLE `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `portable` varchar(20) DEFAULT NULL,
  `poste_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `direction_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `biographie` text DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `date_entree` date DEFAULT NULL,
  `statut` enum('actif','conge','absent','parti') DEFAULT 'actif',
  `bureau` varchar(50) DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_service` (`service_id`),
  KEY `idx_direction` (`direction_id`),
  KEY `idx_poste` (`poste_id`),
  KEY `idx_nom` (`nom`,`prenom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: utilisateurs
-- Comptes d'accès à l'intranet
-- =============================================
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','directeur','chef_service','agent') DEFAULT 'agent',
  `derniere_connexion` datetime DEFAULT NULL,
  `actif` tinyint(1) DEFAULT 1,
  `token_reset` varchar(100) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `agent_id` (`agent_id`),
  KEY `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: actualites
-- Actualités de l'intranet
-- =============================================
CREATE TABLE `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `chapeau` text DEFAULT NULL,
  `contenu` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `auteur_id` int(11) NOT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `statut` enum('brouillon','en_validation','publie','archive') DEFAULT 'brouillon',
  `date_publication` datetime DEFAULT NULL,
  `date_depublication` datetime DEFAULT NULL,
  `vues` int(11) DEFAULT 0,
  `en_une` tinyint(1) DEFAULT 0,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_auteur` (`auteur_id`),
  KEY `idx_statut` (`statut`),
  KEY `idx_date_pub` (`date_publication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: documents
-- Documents partagés
-- =============================================
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `fichier` varchar(255) NOT NULL,
  `type_mime` varchar(100) DEFAULT NULL,
  `taille` bigint(20) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `auteur_id` int(11) NOT NULL,
  `restriction` enum('public','service','direction','prive') DEFAULT 'public',
  `service_id` int(11) DEFAULT NULL,
  `direction_id` int(11) DEFAULT NULL,
  `telechargements` int(11) DEFAULT 0,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_auteur` (`auteur_id`),
  KEY `idx_categorie` (`categorie`),
  KEY `idx_restriction` (`restriction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: evenements
-- Calendrier des événements
-- =============================================
CREATE TABLE `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `toute_journee` tinyint(1) DEFAULT 0,
  `organisateur_id` int(11) NOT NULL,
  `couleur` varchar(7) DEFAULT '#3498db',
  `type` varchar(50) DEFAULT 'reunion',
  `participants` text DEFAULT NULL COMMENT 'JSON des IDs participants',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_date_debut` (`date_debut`),
  KEY `idx_organisateur` (`organisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: petites_annonces
-- Petites annonces entre agents
-- =============================================
CREATE TABLE `petites_annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorie` enum('vente','achat','location','services','covoiturage','autre') DEFAULT 'autre',
  `prix` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `auteur_id` int(11) NOT NULL,
  `telephone_contact` varchar(20) DEFAULT NULL,
  `email_contact` varchar(255) DEFAULT NULL,
  `statut` enum('en_attente','publie','expire','supprime') DEFAULT 'en_attente',
  `date_expiration` date DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_auteur` (`auteur_id`),
  KEY `idx_categorie` (`categorie`),
  KEY `idx_statut` (`statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: offres_emploi
-- Offres d'emploi internes
-- =============================================
CREATE TABLE `offres_emploi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `service` varchar(100) DEFAULT NULL,
  `type_contrat` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `profil` text DEFAULT NULL,
  `fichier_annexe` varchar(255) DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `statut` enum('ouvert','ferme','archive') DEFAULT 'ouvert',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_statut` (`statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: faq
-- Questions fréquemment posées
-- =============================================
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `ordre` int(11) DEFAULT 0,
  `vues` int(11) DEFAULT 0,
  `utile_oui` int(11) DEFAULT 0,
  `utile_non` int(11) DEFAULT 0,
  `auteur_id` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: logs
-- Journalisation des actions
-- =============================================
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `table_concernee` varchar(50) DEFAULT NULL,
  `id_element` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_utilisateur` (`utilisateur_id`),
  KEY `idx_date` (`date_creation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- DONNÉES: Insertion des postes
-- =============================================
INSERT INTO `postes` (`titre`, `niveau`) VALUES
('Directeur Général des Services', 5),
('Directeur', 4),
('Adjoint au Directeur', 4),
('Responsable de service', 3),
('Adjoint au Responsable', 3),
('Agent', 1),
('Maire', 5),
('Collaborateur', 2);

-- =============================================
-- DONNÉES: Insertion des directions
-- =============================================
INSERT INTO `directions` (`id`, `nom`, `nom_court`, `directeur_id`, `ordre`, `couleur`) VALUES
(1, 'Direction Générale des Services', 'DGS', NULL, 1, '#2c3e50'),
(2, 'Direction des Ressources Administratives, Financières et des Systèmes d\'Information', 'DRAFSI', NULL, 2, '#3498db'),
(3, 'Direction des Services Techniques', 'DST', NULL, 3, '#e67e22'),
(4, 'Direction de l\'Action Sportive, Culturelle et Solidaire', 'DASCS', NULL, 4, '#9b59b6'),
(5, 'Direction de la Restauration Municipale', 'DRM', NULL, 5, '#e74c3c'),
(6, 'Direction de l\'Enfance', 'DE', NULL, 6, '#1abc9c'),
(7, 'Centre Communal d\'Action Sociale', 'CCAS', NULL, 7, '#f39c12');

-- =============================================
-- DONNÉES: Insertion des services (extrait)
-- =============================================
INSERT INTO `services` (`nom`, `direction_id`, `ordre`) VALUES
-- DGS
('Communication', 1, 1),
('Police Municipale', 1, 2),
('Ressources Humaines', 1, 3),
('Prévention des Risques Professionnels', 1, 4),
-- DRAFSI
('Administration Générale et Finances', 2, 1),
('Systèmes d\'Information', 2, 2),
-- DST
('Bâtiments', 3, 1),
('Espaces Publics', 3, 2),
('Logistique', 3, 3),
('Ingénierie Administrative et Technique', 3, 4),
-- DASCS
('Spectacle Vivant', 4, 1),
('Centre Social l\'Essentiel', 4, 2),
('Sports et Vie Associative', 4, 3),
('Lecture, Patrimoine et Archives', 4, 4),
-- DRM
('Restauration Scolaire et Entretien', 5, 1),
('Gestion Administrative', 5, 2),
-- DE
('Jeunesse', 6, 1),
('Multi-accueil l\'Escalette', 6, 2),
('Multi-accueil Le p\'tit monde d\'Yzatis', 6, 3),
('Micro-crèche la Coquinette', 6, 4),
('Crèche Familiale', 6, 5),
('Relais Petite Enfance', 6, 6);

-- =============================================
-- DONNÉES: Insertion agents (organigramme complet)
-- =============================================
INSERT INTO `agents` (`nom`, `prenom`, `email`, `telephone`, `poste_id`, `service_id`, `direction_id`) VALUES
-- Maire et DGS
('PERRIN', 'Pascal', 'p.perrin@yzeure.fr', '04.70.20.44.44', 7, NULL, NULL),
('REVERDY', 'Luc', 'l.reverdy@yzeure.fr', '04.70.20.44.45', 1, NULL, 1),

-- DRAFSI
('PERRIN', 'Christelle', 'c.perrin@yzeure.fr', '04.70.20.44.50', 2, NULL, 2),
('GUIGUE', 'Jérôme', 'j.guigue@yzeure.fr', '04.70.20.44.51', 3, 5, 2),
('FALL', 'Cheikh', 'c.fall@yzeure.fr', '04.70.20.44.52', 4, 6, 2),

-- DST
('COUBLE', 'Guillaume', 'g.couble@yzeure.fr', '04.70.20.44.60', 2, NULL, 3),
('VIF', 'Philippe', 'p.vif@yzeure.fr', '04.70.20.44.61', 4, 7, 3),
('CANTE', 'Guillaume', 'g.cante@yzeure.fr', '04.70.20.44.62', 4, 8, 3),
('BUZALSKI', 'Vincent', 'v.buzalski@yzeure.fr', '04.70.20.44.63', 4, 9, 3),
('GENEST', 'Sandra', 's.genest@yzeure.fr', '04.70.20.44.64', 4, 10, 3),

-- DASCS
('DUDUN', 'Olivier', 'o.dudun@yzeure.fr', '04.70.20.44.70', 2, NULL, 4),
('BOURET', 'Claude', 'c.bouret@yzeure.fr', '04.70.20.44.71', 3, 11, 4),
('LEIFFET-PARGUEL', 'Magali', 'm.leiffet@yzeure.fr', '04.70.20.44.72', 4, 12, 4),
('CHANET', 'Stéphane', 's.chanet@yzeure.fr', '04.70.20.44.73', 4, 13, 4),
('GOUGNOT', 'Karine', 'k.gougnot@yzeure.fr', '04.70.20.44.74', 4, 14, 4),

-- DRM
('SAUNIER', 'Guillaume', 'g.saunier@yzeure.fr', '04.70.20.44.80', 2, NULL, 5),
('HARASSE', 'Arnaud', 'a.harasse@yzeure.fr', '04.70.20.44.81', 3, 15, 5),
('PERROT', 'Agnès', 'a.perrot@yzeure.fr', '04.70.20.44.82', 4, 16, 5),

-- DE
('CANTINEAU', 'Anne-Claire', 'ac.cantineau@yzeure.fr', '04.70.20.44.90', 2, NULL, 6),
('POMMIER', 'Marie-Laure', 'ml.pommier@yzeure.fr', '04.70.20.44.91', 3, 17, 6),
('BRUN', 'Charlène', 'c.brun@yzeure.fr', '04.70.20.44.92', 4, 18, 6),
('FRILEUX', 'Sonia', 's.frileux@yzeure.fr', '04.70.20.44.93', 4, 19, 6),
('JEUNE', 'Camille', 'c.jeune@yzeure.fr', '04.70.20.44.94', 4, 20, 6),
('AUBARD', 'Morgane', 'm.aubard@yzeure.fr', '04.70.20.44.95', 4, 21, 6),
('RAY', 'Isabelle', 'i.ray@yzeure.fr', '04.70.20.44.96', 4, 22, 6),

-- DGS Services
('MERCHADIER', 'Louisa', 'l.merchadier@yzeure.fr', '04.70.20.44.46', 4, 1, 1),
('SAUNIER', 'Thierry', 't.saunier@yzeure.fr', '04.70.20.44.47', 4, 2, 1),
('MARONNE', 'Jean-Baptiste', 'jb.maronne@yzeure.fr', '04.70.20.44.48', 4, 3, 1),
('DUC', 'Anthony', 'a.duc@yzeure.fr', '04.70.20.44.49', 4, 4, 1);

-- =============================================
-- DONNÉES: Création comptes utilisateurs
-- Mot de passe par défaut : "Yzeure2025!" (hashé)
-- =============================================
INSERT INTO `utilisateurs` (`agent_id`, `username`, `password`, `role`) VALUES
(1, 'p.perrin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(2, 'l.reverdy', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(3, 'c.perrin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'directeur'),
(6, 'g.couble', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'directeur'),
(10, 'o.dudun', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'directeur'),
(15, 'g.saunier', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'directeur'),
(18, 'ac.cantineau', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'directeur');

-- =============================================
-- DONNÉES: Exemples d'actualités
-- =============================================
INSERT INTO `actualites` (`titre`, `chapeau`, `contenu`, `auteur_id`, `statut`, `date_publication`, `en_une`) VALUES
('Bienvenue sur le nouvel Intranet', 'Découvrez notre nouvelle plateforme collaborative', 'Le nouvel intranet de la mairie d\'Yzeure est maintenant disponible. Vous y retrouverez toutes les informations nécessaires à votre travail quotidien.', 1, 'publie', NOW(), 1),
('Mise à jour du règlement intérieur', 'Nouvelles dispositions applicables dès janvier 2025', 'Le règlement intérieur a été actualisé. Consultez la version complète dans la section Documents.', 1, 'publie', NOW(), 0);

COMMIT;