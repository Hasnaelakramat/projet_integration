-- Table: public.administrateurs

-- DROP TABLE IF EXISTS public.administrateurs;

CREATE TABLE IF NOT EXISTS public.administrateurs
(
    id bigint NOT NULL DEFAULT nextval('administrateurs_id_seq'::regclass),
    ppr character varying(100) COLLATE pg_catalog."default" NOT NULL,
    nom character varying(255) COLLATE pg_catalog."default" NOT NULL,
    prenom character varying(255) COLLATE pg_catalog."default" NOT NULL,
    id_etab smallint NOT NULL,
    id_user bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT administrateurs_pkey PRIMARY KEY (id),
    CONSTRAINT administrateurs_ppr_unique UNIQUE (ppr),
    CONSTRAINT administrateurs_id_etab_foreign FOREIGN KEY (id_etab)
        REFERENCES public.etablissements (id_etab) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT administrateurs_id_user_foreign FOREIGN KEY (id_user)
        REFERENCES public.users (id_user) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.administrateurs
    OWNER to postgres;



















======






-- Table: public.enseignants

-- DROP TABLE IF EXISTS public.enseignants;

CREATE TABLE IF NOT EXISTS public.enseignants
(
    id_enseign bigint NOT NULL DEFAULT nextval('enseignants_id_enseign_seq'::regclass),
    ppr character varying(100) COLLATE pg_catalog."default" NOT NULL,
    nom character varying(255) COLLATE pg_catalog."default" NOT NULL,
    prenom character varying(255) COLLATE pg_catalog."default" NOT NULL,
    date_nais date NOT NULL,
    id_etab smallint NOT NULL,
    id_grade smallint NOT NULL,
    id_user bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT enseignants_pkey PRIMARY KEY (id_enseign),
    CONSTRAINT enseignants_ppr_unique UNIQUE (ppr),
    CONSTRAINT enseignants_id_etab_foreign FOREIGN KEY (id_etab)
        REFERENCES public.etablissements (id_etab) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT enseignants_id_grade_foreign FOREIGN KEY (id_grade)
        REFERENCES public.grades (id_grade) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT enseignants_id_user_foreign FOREIGN KEY (id_user)
        REFERENCES public.users (id_user) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.enseignants
    OWNER to postgres;











=================




-- Table: public.etablissements

-- DROP TABLE IF EXISTS public.etablissements;

CREATE TABLE IF NOT EXISTS public.etablissements
(
    id_etab smallint NOT NULL DEFAULT nextval('etablissements_id_etab_seq'::regclass),
    code character varying(255) COLLATE pg_catalog."default" NOT NULL,
    nom character varying(100) COLLATE pg_catalog."default" NOT NULL,
    telephone character varying(50) COLLATE pg_catalog."default" NOT NULL,
    faxe character varying(50) COLLATE pg_catalog."default" NOT NULL,
    ville character varying(255) COLLATE pg_catalog."default" NOT NULL,
    nbr_enseignants integer NOT NULL DEFAULT 0,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT etablissements_pkey PRIMARY KEY (id_etab),
    CONSTRAINT etablissements_code_unique UNIQUE (code)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.etablissements
    OWNER to postgres;











====










===============










-- Table: public.grades

-- DROP TABLE IF EXISTS public.grades;

CREATE TABLE IF NOT EXISTS public.grades
(
    id_grade smallint NOT NULL DEFAULT nextval('grades_id_grade_seq'::regclass),
    designation character varying(255) COLLATE pg_catalog."default" NOT NULL,
    charge_statutaire integer NOT NULL,
    taux_horaire_vacation integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT grades_pkey PRIMARY KEY (id_grade),
    CONSTRAINT grades_designation_unique UNIQUE (designation)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.grades
    OWNER to postgres;





===============

-- Table: public.interventions

-- DROP TABLE IF EXISTS public.interventions;

CREATE TABLE IF NOT EXISTS public.interventions
(
    id_intervention bigint NOT NULL DEFAULT nextval('interventions_id_intervention_seq'::regclass),
    intitule_intervention character varying(255) COLLATE pg_catalog."default" NOT NULL,
    annee_univ character varying(255) COLLATE pg_catalog."default" NOT NULL,
    semestre character(2) COLLATE pg_catalog."default" NOT NULL,
    date_debut date NOT NULL,
    date_fin date NOT NULL,
    nbr_heures integer NOT NULL,
    visa_etab boolean NOT NULL DEFAULT false,
    visa_uae boolean NOT NULL DEFAULT false,
    id_etab smallint NOT NULL,
    id_enseign bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT interventions_pkey PRIMARY KEY (id_intervention),
    CONSTRAINT interventions_id_enseign_foreign FOREIGN KEY (id_enseign)
        REFERENCES public.enseignants (id_enseign) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT interventions_id_etab_foreign FOREIGN KEY (id_etab)
        REFERENCES public.etablissements (id_etab) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.interventions
    OWNER to postgres;




================





-- Table: public.paiements

-- DROP TABLE IF EXISTS public.paiements;

CREATE TABLE IF NOT EXISTS public.paiements
(
    id_paiement bigint NOT NULL DEFAULT nextval('paiements_id_paiement_seq'::regclass),
    id_intervenant bigint NOT NULL,
    id_etab smallint NOT NULL,
    vh integer NOT NULL,
    "taux_H" integer NOT NULL,
    brut double precision NOT NULL,
    ir double precision NOT NULL,
    net double precision NOT NULL,
    annee_univ character varying(255) COLLATE pg_catalog."default" NOT NULL,
    semestre character(2) COLLATE pg_catalog."default" NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    taux_h integer,
    CONSTRAINT paiements_pkey PRIMARY KEY (id_paiement),
    CONSTRAINT paiements_id_etab_foreign FOREIGN KEY (id_etab)
        REFERENCES public.etablissements (id_etab) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT paiements_id_intervenant_foreign FOREIGN KEY (id_intervenant)
        REFERENCES public.enseignants (id_enseign) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.paiements
    OWNER to postgres;




==================

-- Table: public.users

-- DROP TABLE IF EXISTS public.users;

CREATE TABLE IF NOT EXISTS public.users
(
    id_user bigint NOT NULL DEFAULT nextval('users_id_user_seq'::regclass),
    email character varying(255) COLLATE pg_catalog."default" NOT NULL,
    password character varying(255) COLLATE pg_catalog."default" NOT NULL,
    type smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT users_pkey PRIMARY KEY (id_user),
    CONSTRAINT users_email_unique UNIQUE (email)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.users
    OWNER to postgres;