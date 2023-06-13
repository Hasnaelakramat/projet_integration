
-- =============================== CREATE ROLE: president_uae============
CREATE ROLE president_uae  WITH
  LOGIN                    
  PASSWORD  'president_uae' 
  ; 

-- =========================  CREATE ROLE : admin_uae==================
CREATE ROLE admin_uae  WITH
  LOGIN     -- Autorise la connexion au rôle
  PASSWORD  'admin_uae' -- Définit le mot de passe du rôle
  ;  
  --=============================== CREATE ROLE: directeur_etab=========
 CREATE ROLE directeur_etab  WITH
  LOGIN     
  PASSWORD  'directeur_etab' 
 
  ;
  --=============================== CREATE ROLE: admin_etab =================
CREATE ROLE admin_etab  WITH
  LOGIN   
  PASSWORD  'admin_etab'    

  ; 
-- ============================ CREATE ROLE: prof ==============================
CREATE ROLE prof  WITH
  LOGIN     
  PASSWORD  'prof' 
  ; 
  
-- =======================================CONNEXION'S PRIVILEGE ===================================

REVOKE ALL PRIVILEGES ON  DATABASE project_uae FROM admin_uae, president_uae, admin_etab, directeur_etab, prof;
REVOKE ALL PRIVILEGES ON ALL TABLES IN SCHEMA public FROM admin_uae, president_uae, admin_etab, directeur_etab, prof ;

--==================================  REVOKE FROM ALL USERS =====================

REVOKE DELETE, SELECT , UPDATE, INSERT ON ALL TABLES IN SCHEMA public FROM admin_uae, president_uae, admin_etab, directeur_etab, prof;
GRANT CONNECT ON DATABASE project_uae TO admin_uae, president_uae, admin_etab, directeur_etab, prof;

--==================================  admin_uae's privileges =====================
GRANT SELECT ON etablissements, administrateurs, grades , interventions, enseignants, paiements TO  president_uae, admin_uae;

GRANT SELECT (id_user, email, type ) ON users TO president_uae, admin_uae; 

GRANT UPDATE ON etablissements, administrateurs, grades TO admin_uae, president_uae;

GRANT INSERT ON etablissements, grades, users TO admin_uae, president_uae;

GRANT DELETE ON etablissements, grades, users TO admin_uae, president_uae;

ALTER TABLE administrateurs ENABLE ROW LEVEL SECURITY;
ALTER TABLE enseignants ENABLE ROW LEVEL SECURITY;
ALTER TABLE interventions ENABLE ROW LEVEL SECURITY;
ALTER TABLE paiements ENABLE ROW LEVEL SECURITY;

CREATE POLICY administrateurs_select_admin_president_uae
ON administrateurs
FOR SELECT
TO president_uae, admin_uae 
USING ('1'); -- le type de admin_etab = 1

CREATE POLICY enseignants_select_admin_president_uae
ON enseignants
FOR SELECT
TO president_uae, admin_uae
USING ('1'); -- le type de admin_etab = 1

CREATE POLICY interventions_select_admin_president_uae
ON interventions
FOR SELECT
TO president_uae, admin_uae 
USING ('1'); -- le type de admin_etab = 1

CREATE POLICY paiements_select_admin_president_uae
ON paiements
FOR SELECT
TO president_uae, admin_uae 
USING ('1'); -- le type de admin_etab = 1

CREATE POLICY administrateurs_update_admin_president_uae
ON administrateurs
FOR UPDATE
TO president_uae, admin_uae 
USING ('1'); -- le type de admin_etab = 1

CREATE POLICY interventions_update_president_uae
ON interventions
FOR UPDATE
TO president_uae
USING ('1'); -- le type de admin_etab = 1

-- ==================== president_uae's privileges ======================

GRANT INSERT ON TABLE paiements TO president_uae;

GRANT UPDATE (visa_uae) ON interventions TO president_uae; 

GRANT SELECT ON TABLE paiements 
TO  president_uae;

GRANT USAGE, SELECT ON SEQUENCE paiements_id_paiement_seq TO president_uae;

-- ==================== admin_etab's peivilegs ======================

-- ============================ SELECT =====================
GRANT SELECT ON administrateurs, enseignants, etablissements, grades, interventions TO admin_etab, directeur_etab;

CREATE POLICY administrateurs_select_admin_etab
ON administrateurs
FOR SELECT
TO admin_etab 
USING (id=1); -- le type de admin_etab = 1

CREATE POLICY enseignants_select_admin_etab
ON enseignants
FOR SELECT
TO admin_etab
USING (id_etab = (select id_etab from administrateurs where id=1));

CREATE POLICY interventions_select_admin_etab
ON interventions
FOR SELECT
TO admin_etab
USING (id_etab = (select id_etab from administrateurs where id=1));

--========================== INSERT ==================================

GRANT INSERT ON  users, enseignants, interventions TO admin_etab, directeur_etab;

CREATE POLICY enseignants_insert_admin_etab
ON enseignants
FOR INSERT
TO admin_etab 
with check ('1');

CREATE POLICY interventions_insert_admin_etab
ON interventions
FOR INSERT
TO admin_etab 
with check ('1');

--========================== DELETE ==================================
GRANT DELETE ON TABLE enseignants, interventions, users TO admin_etab, directeur_etab;

CREATE POLICY enseignants_delete_admin_etab
ON enseignants
FOR DELETE
TO admin_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

CREATE POLICY interventions_delete_admin_etab
ON interventions
FOR DELETE
TO admin_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

--=================================== UPDATE =======================

GRANT UPDATE (id_intervention, intitule_intervention, annee_univ, semestre, date_debut, date_fin, nbr_heures, id_intervenant, id_etab) ON interventions TO admin_etab; 

GRANT UPDATE ON enseignants, users TO admin_etab, directeur_etab;

CREATE POLICY enseignants_update_admin_etab
ON enseignants
FOR UPDATE
TO admin_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

CREATE POLICY interventions_update_admin_etab
ON interventions
FOR UPDATE
TO admin_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

--===================================== directeur_etab =============================
--=================== SELECTE=====================================================


CREATE POLICY administrateurs_select_president_etab
ON administrateurs
FOR SELECT
TO directeur_etab 
USING (id=1); -- le type de admin_etab = 1


CREATE POLICY enseignants_select_president_etab
ON enseignants
FOR SELECT
TO directeur_etab
USING (id_etab = (select id_etab from administrateurs where id=1));

CREATE POLICY interventions_select_president_etab
ON interventions
FOR SELECT
TO directeur_etab
USING (id_etab = (select id_etab from administrateurs where id=1));

--========================== INSERT ==============================

--========================== DELETE ==============================

CREATE POLICY enseignants_delete_directeur_etab
ON enseignants
FOR DELETE
TO directeur_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

CREATE POLICY interventions_delete_directeur_etab
ON interventions
FOR DELETE
TO directeur_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

--================================= UPDATE ==============================

GRANT UPDATE ON TABLE  interventions TO directeur_etab;

CREATE POLICY enseignants_update_directeur_etab
ON enseignants
FOR UPDATE
TO directeur_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

CREATE POLICY interventions_update_directeur_etab
ON interventions
FOR UPDATE
TO directeur_etab 
USING (id_etab= (select id_etab from administrateurs where id=2)); -- le type de admin_etab = 1

--================================= PROF's PRIVILIEGES  ===============================

-- ================================= SELECT ===================================
-- select etablissements and grades

GRANT SELECT ON enseignants, interventions, paiements TO prof;

CREATE POLICY enseignants_select_prof_etab
ON enseignants
FOR SELECT
TO prof 
USING (id_enseign=1); 

CREATE POLICY interventions_select_prof_etab
ON interventions
FOR SELECT
TO prof 
USING (id_intervenant=1); 

CREATE POLICY enseignants_select_prof_etab
ON paiements
FOR SELECT
TO prof 
USING (id_intervenant=1);
--=========================== UPDATE =========================

GRANT UPDATE ON TABLE enseignants TO prof;

CREATE POLICY enseignants_update_prof
ON enseignants
FOR UPDATE
TO prof
USING (id_enseign=1 ); -- id_user = 1


