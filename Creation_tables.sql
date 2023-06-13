CREATE TABLE etablissements (
    id_etab SMALLSERIAL PRIMARY KEY,
    code VARCHAR(255) NOT NULL UNIQUE,
    nom VARCHAR(100) NOT NULL,
    telephone VARCHAR(50) NOT NULL,
    faxe VARCHAR(50),
    ville VARCHAR NOT NULL,
    nbr_enseignants INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	-- Contrainte pour vérifier que le téléphone ne contient que des chiffres numériques
	
	CONSTRAINT check_telephone CHECK (telephone ~ '^[0-9]+$'),
	
	-- Contrainte pour vérifier que le faxe ne contient que des chiffres numériques
	CONSTRAINT check_faxe CHECK (faxe ~ '^[0-9]+$') 
); 

--======================================================================

CREATE TABLE grades (
    id_grade SMALLSERIAL PRIMARY KEY,
    designation VARCHAR NOT NULL UNIQUE,
    charge_statutaire INTEGER NOT NULL,
    taux_horaire_vacation INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	
	-- Contrainte pour vérifier que la valeur de "designation" est parmi 'PES', 'PA', 'PH'
	
	CONSTRAINT designation_check CHECK (designation IN ('PES', 'PA', 'PH'))
);

--=============================================================================

CREATE TABLE users (
    id_user BIGSERIAL PRIMARY KEY,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    type SMALLINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	
	-- Contrainte pour vérifier que la valeur de "type" est parmi 0, 1, 2, 3, 4
	
	CONSTRAINT type_check CHECK (type IN (0, 1, 2, 3, 4)),
	-- Contrainte pour vérifier que "email" a le format d'une adresse email valide
	
    CONSTRAINT email_check CHECK (email ~* '^.+@.+\..+$')
);

Create index index_users ON users(email, password); 

-- ==============================================

CREATE TABLE administrateurs (
    id BIGSERIAL PRIMARY KEY,
    ppr text NOT NULL UNIQUE,
    nom VARCHAR NOT NULL,
    prenom VARCHAR NOT NULL,
    id_etab SMALLINT NOT NULL REFERENCES etablissements (id_etab) ON DELETE CASCADE ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- ====================================

CREATE TABLE enseignants (
    id_enseign BIGSERIAL PRIMARY KEY,
    ppr VARCHAR(100) NOT NULL UNIQUE,
    nom VARCHAR NOT NULL,
    prenom VARCHAR NOT NULL,
    date_nais DATE,
    id_etab SMALLINT NOT NULL REFERENCES etablissements (id_etab) ON DELETE CASCADE ON UPDATE CASCADE,
    id_grade SMALLINT NOT NULL REFERENCES grades (id_grade) ON DELETE CASCADE ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
--================================

CREATE TABLE interventions (
    id_intervention BIGSERIAL PRIMARY KEY,
    intitule_intervention VARCHAR NOT NULL,
    annee_univ VARCHAR NOT NULL,
    semestre CHAR(2) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    nbr_heures INTEGER NOT NULL,
    id_intervenant BIGINT REFERENCES enseignants (id_enseign) ON DELETE CASCADE ON UPDATE CASCADE,
    id_etab SMALLINT REFERENCES etablissements (id_etab) ON DELETE CASCADE ON UPDATE CASCADE,
    visa_etab BOOLEAN DEFAULT FALSE,
    visa_uae BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	
);

-- ====================================================

CREATE TABLE paiements (
    id_paiement BIGSERIAL PRIMARY KEY,
    id_intervenant BIGINT NOT NULL REFERENCES enseignants (id_enseign) ON DELETE CASCADE ON UPDATE CASCADE,
    id_etab SMALLINT NOT NULL REFERENCES etablissements (id_etab) ON DELETE CASCADE ON UPDATE CASCADE,
    vh INTEGER NOT NULL,
    taux_h INTEGER NOT NULL,
    brut FLOAT NOT NULL,
    net FLOAT GENERATED ALWAYS AS (brut  - brut  * ir / 100) STORED,
    annee_univ VARCHAR NOT NULL,
    semestre CHAR(2) NOT NULL,
    ir FLOAT DEFAULT 38,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT semestre_check1 CHECK (semestre IN ('S1', 'S2'))
	
);
