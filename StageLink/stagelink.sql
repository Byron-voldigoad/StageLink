-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id_utilisateur BIGINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verified_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des roles
CREATE TABLE roles (
    id_role BIGINT PRIMARY KEY AUTO_INCREMENT,
    nom_role VARCHAR(50) NOT NULL UNIQUE,
    description_role TEXT
);

-- Table de liaison utilisateurs-roles
CREATE TABLE utilisateur_roles (
    id_utilisateur BIGINT NOT NULL,
    id_role BIGINT NOT NULL,
    PRIMARY KEY (id_utilisateur, id_role),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_role) REFERENCES roles(id_role) ON DELETE CASCADE
);

-- Table des profils etudiants
CREATE TABLE profils_etudiants (
    id_etudiant BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur BIGINT NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    adresse TEXT,
    ecole VARCHAR(255),
    niveau VARCHAR(100),
    domaine_etude VARCHAR(255),
    cv_path VARCHAR(255),
    photo_profil VARCHAR(255),
    credits DECIMAL(10,2) DEFAULT 0,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

-- Table des profils tuteurs
CREATE TABLE profils_tuteurs (
    id_tuteur BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur BIGINT NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    adresse TEXT,
    qualifications TEXT,
    certifications TEXT,
    annees_experience INT,
    tarif_horaire DECIMAL(10,2),
    photo_profil VARCHAR(255),
    disponible BOOLEAN DEFAULT TRUE,
    note DECIMAL(3,2) DEFAULT 0,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

-- Table des matieres
CREATE TABLE matieres (
    id_matiere BIGINT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT
);

-- Table des matieres enseignees par les tuteurs
CREATE TABLE tuteur_matieres (
    id_tuteur_matiere BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_tuteur BIGINT NOT NULL,
    id_matiere BIGINT NOT NULL,
    niveau VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_tuteur) REFERENCES profils_tuteurs(id_tuteur) ON DELETE CASCADE,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere) ON DELETE CASCADE
);

-- Table des entreprises
CREATE TABLE entreprises (
    id_entreprise BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur BIGINT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    secteur VARCHAR(255),
    telephone VARCHAR(20),
    adresse TEXT,
    site_web VARCHAR(255),
    logo_path VARCHAR(255),
    nif VARCHAR(50) UNIQUE,
    verifie BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

-- Table des offres de stage
CREATE TABLE offres_stage (
    id_offre_stage BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_entreprise BIGINT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    exigences TEXT,
    duree VARCHAR(100),
    date_debut DATE,
    date_fin DATE,
    localisation VARCHAR(255),
    remuneration DECIMAL(10,2),
    secteur VARCHAR(255),
    statut ENUM('ouvert', 'ferme', 'en_attente') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_entreprise) REFERENCES entreprises(id_entreprise) ON DELETE CASCADE
);

-- Table des candidatures
CREATE TABLE candidatures (
    id_candidature BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_offre_stage BIGINT NOT NULL,
    id_etudiant BIGINT NOT NULL,
    cv_path VARCHAR(255) NOT NULL,
    lettre_motivation_path VARCHAR(255),
    statut ENUM('en_attente', 'examine', 'accepte', 'rejete') DEFAULT 'en_attente',
    postule_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    mis_a_jour_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_offre_stage) REFERENCES offres_stage(id_offre_stage) ON DELETE CASCADE,
    FOREIGN KEY (id_etudiant) REFERENCES profils_etudiants(id_etudiant) ON DELETE CASCADE
);

-- Table des sujets examen
CREATE TABLE sujets_examen (
    id_sujet BIGINT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    id_matiere BIGINT NOT NULL,
    id_niveau BIGINT NOT NULL,
    id_annee BIGINT NOT NULL,
    fichier_path VARCHAR(255) NOT NULL,
    est_gratuit BOOLEAN DEFAULT FALSE,
    prix DECIMAL(10,2) DEFAULT 0,
    id_upload_par BIGINT,
    approuve BOOLEAN DEFAULT FALSE,
    telechargements INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere),
    FOREIGN KEY (id_upload_par) REFERENCES utilisateurs(id_utilisateur) ON DELETE SET NULL
);

-- Table des niveaux
CREATE TABLE niveaux (
    id_niveau BIGINT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

-- Table des annees academiques
CREATE TABLE annees_academiques (
    id_annee BIGINT PRIMARY KEY AUTO_INCREMENT,
    annee_debut INT NOT NULL,
    annee_fin INT NOT NULL,
    description TEXT
);

-- Table des corriges examen
CREATE TABLE corriges_examen (
    id_corrige BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_sujet BIGINT NOT NULL,
    id_tuteur BIGINT NOT NULL,
    fichier_path VARCHAR(255) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    approuve BOOLEAN DEFAULT FALSE,
    telechargements INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sujet) REFERENCES sujets_examen(id_sujet) ON DELETE CASCADE,
    FOREIGN KEY (id_tuteur) REFERENCES profils_tuteurs(id_tuteur) ON DELETE CASCADE
);

-- Table des transactions credits
CREATE TABLE transactions_credits (
    id_transaction BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur BIGINT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    type ENUM('achat', 'recompense', 'retrait', 'revenu_correction') NOT NULL,
    methode_paiement VARCHAR(100),
    reference_transaction VARCHAR(255),
    statut ENUM('en_attente', 'complete', 'echoue') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

-- Table des messages
CREATE TABLE messages (
    id_message BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_expediteur BIGINT NOT NULL,
    id_destinataire BIGINT NOT NULL,
    contenu TEXT NOT NULL,
    lu BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_expediteur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_destinataire) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

-- Table des evaluations tuteurs
CREATE TABLE evaluations_tuteurs (
    id_evaluation BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_tuteur BIGINT NOT NULL,
    id_etudiant BIGINT NOT NULL,
    note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tuteur) REFERENCES profils_tuteurs(id_tuteur) ON DELETE CASCADE,
    FOREIGN KEY (id_etudiant) REFERENCES profils_etudiants(id_etudiant) ON DELETE CASCADE
);

-- Table des soumissions etudiants
CREATE TABLE soumissions_etudiants (
    id_soumission BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_etudiant BIGINT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    id_matiere BIGINT NOT NULL,
    id_niveau BIGINT NOT NULL,
    id_annee BIGINT NOT NULL,
    fichier_path VARCHAR(255) NOT NULL,
    statut ENUM('en_attente', 'approuve', 'rejete') DEFAULT 'en_attente',
    commentaire_admin TEXT,
    credits_accordes DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_etudiant) REFERENCES profils_etudiants(id_etudiant) ON DELETE CASCADE,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere),
    FOREIGN KEY (id_niveau) REFERENCES niveaux(id_niveau),
    FOREIGN KEY (id_annee) REFERENCES annees_academiques(id_annee)
);