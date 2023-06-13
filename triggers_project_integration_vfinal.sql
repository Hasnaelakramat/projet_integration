-- =========================== validé =========================

CREATE OR REPLACE PROCEDURE dec_nbr_enseignants(id_etablissement etablissements.id_etab%TYPE)
AS
$$
BEGIN
  UPDATE etablissements
  SET nbr_enseignants= nbr_enseignants- 1
  WHERE id_etab= id_etablissement;

END;
$$ LANGUAGE plpgsql;
-- ====================================================
CREATE OR REPLACE PROCEDURE inc_nbr_enseignants(id_etablissement etablissements.id_etab%TYPE )
 AS
 $$
 BEGIN

		UPDATE etablissements
		SET nbr_enseignants= nbr_enseignants+ 1
		WHERE id_etab= id_etablissement;
END;
$$ LANGUAGE plpgsql;
--======================================================

CREATE OR REPLACE FUNCTION fnc_nbr_enseignant()
RETURNS TRIGGER
AS 
$$
 BEGIN
   IF TG_OP='UPDATE' THEN
	
      CALL inc_nbr_enseignants(New.id_etab);
	  CALL dec_nbr_enseignants(Old.id_etab);
	  RETURN NEW;
   ELSIF  TG_OP='INSERT' THEN
	  	
	 CALL inc_nbr_enseignants(New.id_etab);
	 RETURN NEW;
   ELSE 	
	  	
      CALL dec_nbr_enseignants(Old.id_etab);
	  RETURN OLD;
  END IF;
 END;  
$$
LANGUAGE PLPGSQL;

--=====================calcule taux horaire=============valide

CREATE OR REPLACE FUNCTION fnc_taux_charge(id_interven_ant paiements.id_intervenant%type)
RETURNS TABLE (charge_statutaire grades.charge_statutaire%TYPE, taux_h grades.taux_horaire_vacation%TYPE)
AS
$$
BEGIN
  RETURN QUERY 
  SELECT  g.charge_statutaire, g.taux_horaire_vacation
  FROM (select * from enseignants e where e.id_enseign = id_interven_ant) e
  JOIN grades g 
  ON g.id_grade = e.id_grade;
  
END;
$$
LANGUAGE PLPGSQL;

--=====================calcule brut=============valide

CREATE OR REPLACE FUNCTION calcul_brut( vh paiements.vh%type ,  taux_h paiements.taux_h%type )
RETURNS paiements.brut%type
AS 
$$
BEGIN
	return (vh * taux_h);
END;
$$
language plpgsql;

--=====================id paiement if exist ==============valide
CREATE OR REPLACE FUNCTION id_paie(id__intervenant interventions.id_intervenant%TYPE, id__etab interventions.id_etab%TYPE, annee__univ interventions.annee_univ%TYPE, semes_tre interventions.semestre%TYPE)
  RETURNS paiements.id_paiement%type AS
$$

DECLARE
  id__paiement paiements.id_paiement%type;
BEGIN
  SELECT p.id_paiement INTO id__paiement
  FROM paiements p
  where p.id_intervenant= id__intervenant 
  AND p.id_etab= id__etab
  AND p.annee_univ= annee__univ
  AND p.semestre= semes_tre;
  
  IF FOUND THEN

    RETURN id__paiement;
  ELSE
    RETURN -1;
  END IF;
END;

$$
LANGUAGE plpgsql;


--============check 200=========================valide

CREATE OR REPLACE FUNCTION fnc_heures_supp(id_interven_ant interventions.id_intervenant%TYPE, annee_universitaire interventions.annee_univ%TYPE)
RETURNS integer
AS
$$ 

DECLARE 
    heures_supp INTEGER := 0;

BEGIN
    SELECT SUM(vh) INTO heures_supp 
    FROM paiements 
    WHERE id_intervenant = id_interven_ant
        AND REPLACE(annee_univ, ' ', '') = REPLACE(annee_universitaire, ' ', ''); 

    if heures_supp IS NULL THEN 
        return 0;
    end if;
    
    return heures_supp;
    
END;

$$
LANGUAGE PLPGSQL;

--=========================================

CREATE OR REPLACE FUNCTION fnc_check_heures_supp(id__intervention interventions.id_intervention%type, nbr__heures paiements.vh%type )
RETURNS paiements.vh%type
AS
$$
DECLARE
    id__intervenant interventions.id_intervenant%TYPE;
    annee__univ interventions.annee_univ%TYPE;
	heures_supp_vacation paiements.vh%type ;
   
BEGIN
    select i.id_intervenant into id__intervenant from interventions i where i.id_intervention= id__intervention;
	select i.annee_univ into annee__univ from interventions i where i.id_intervention= id__intervention;
	heures_supp_vacation := fnc_heures_supp(id__intervenant, annee__univ);

		IF  heures_supp_vacation=200 THEN
          return -1; 
       elsif heures_supp_vacation + nbr__heures >200 then 
        return 200 - heures_supp_vacation;
       else return nbr__heures;
		END IF;
 END;
$$
LANGUAGE PLPGSQL;

--=====================================================

CREATE OR REPLACE FUNCTION fnc_check_heures_supp_origine(id__intervention interventions.id_intervention%type, diff_cs_et_vt integer)
RETURNS paiements.vh%type
AS
$$
DECLARE
    id__intervenant interventions.id_intervenant%TYPE;
    annee__univ interventions.annee_univ%TYPE;
	heures_supp_vacation paiements.vh%type ;
    nbr__heures paiements.vh%type;
BEGIN
    select i.id_intervenant into id__intervenant from interventions i where i.id_intervention=id__intervention;
	select i.annee_univ into annee__univ from interventions i where i.id_intervention= id__intervention;
   
	heures_supp_vacation := fnc_heures_supp(id__intervenant, annee__univ);
	
		IF  heures_supp_vacation=200 THEN 
          return -1; 
       elsif heures_supp_vacation + diff_cs_et_vt >200 then 
        return 200 - heures_supp_vacation;
       else return diff_cs_et_vt ;
		END IF;
 END;
$$
LANGUAGE PLPGSQL;

--===================================================valide

CREATE OR REPLACE FUNCTION etab_origine_interv (id_interv interventions.id_intervention%type)
RETURNS boolean AS
$$

DECLARE
	  id_etab_interv interventions.id_etab%type;
	  id_etab_org interventions.id_etab%type;
BEGIN
  select e.id_etab into id_etab_org FROM
  enseignants e 
  JOIN (select id_intervenant from interventions i where id_intervention= id_interv) i
  on i.id_intervenant = e.id_enseign;
  
  select i.id_etab into id_etab_interv from interventions i where i.id_intervention = id_interv;

  if  id_etab_org = id_etab_interv THEN
      RETURN true;
	  
  ELSE
      RETURN false;
  END IF;
END;

$$
LANGUAGE plpgsql;


--=======================================valide
CREATE OR REPLACE FUNCTION difference_cs_vh (vh_total interventions.nbr_heures%TYPE , charge_statutaire grades.charge_statutaire%TYPE )
  RETURNS paiements.vh%type 
  AS
$$


BEGIN

      RETURN vh_total - charge_statutaire ;

END;

$$
LANGUAGE plpgsql;

--================================valide
CREATE OR REPLACE FUNCTION vh_total_etb_org(id_prof enseignants.id_enseign%type, annee_univ_cours interventions.annee_univ%type)
  RETURNS interventions.nbr_heures%type AS
$$

DECLARE
  vh_total_etb interventions.nbr_heures%type;
BEGIN
  SELECT SUM(i.nbr_heures) INTO vh_total_etb
  FROM interventions i
  JOIN (select * from enseignants e where id_enseign= id_prof) e
  ON i.id_intervenant = e.id_enseign AND i.id_etab = e.id_etab
  WHERE i.annee_univ = annee_univ_cours;
  
  RETURN vh_total_etb; 
END;

$$
LANGUAGE plpgsql;

 
--=================================================================

CREATE OR REPLACE PROCEDURE proc_insert_update(vh_new INTEGER, taux_h INTEGER, id_inter_vention BIGINT, ir_paiement DOUBLE PRECISION)
AS
$$

DECLARE 
   id_interve_nant interventions.id_intervenant%TYPE;
   id_etab interventions.id_etab%TYPE;
   annee_univ interventions.annee_univ%TYPE;
   semes_tre interventions.semestre%TYPE;
   id__paiement paiements.id_paiement%TYPE;
   charge_stat grades.charge_statutaire%TYPE;
   taux_horaire grades.taux_horaire_vacation%TYPE;
   v_total paiements.vh%TYPE;
BEGIN
  SELECT i.id_intervenant INTO id_interve_nant FROM interventions i WHERE i.id_intervention = id_inter_vention;
  SELECT i.id_etab INTO id_etab FROM interventions i WHERE i.id_intervention = id_inter_vention;
  SELECT i.annee_univ INTO annee_univ FROM interventions i WHERE i.id_intervention = id_inter_vention;
  SELECT i.semestre INTO semes_tre FROM interventions i WHERE i.id_intervention = id_inter_vention;
  
  SELECT id_paie(id_interve_nant, id_etab, annee_univ, semes_tre) INTO id__paiement;
  
  SELECT * FROM fnc_taux_charge(id_interve_nant)
  INTO charge_stat, taux_horaire;
   
  IF id__paiement >= 0 THEN
    select vh from paiements into v_total where id_paiement= id__paiement; 
    UPDATE paiements p
    SET vh = vh+vh_new,
        brut = calcul_brut(vh_new + v_total, taux_horaire)
        --net = calcul_net(calcul_brut(vh_new, taux_horaire), ir_paiement)
    WHERE p.id_paiement = id__paiement;
  ELSE

    INSERT INTO paiements (id_intervenant, id_etab, vh, taux_h, brut, annee_univ, semestre)
    VALUES (id_interve_nant, id_etab, vh_new, taux_h, calcul_brut(vh_new, taux_horaire), annee_univ, semes_tre);
  END IF;
END;

$$
LANGUAGE PLPGSQL;

--================================valide

CREATE OR REPLACE FUNCTION fnc_nbr_heures_update(id__intervention interventions.id_intervention%TYPE, charge_stat grades.charge_statutaire%TYPE, nbr__heures interventions.nbr_heures%TYPE, tg text)
RETURNS paiements.vh%type
AS
$$

DECLARE 
    id__intervenant interventions.id_intervenant%TYPE;
    annee__univ interventions.annee_univ%TYPE;
	semestree interventions.semestre%type ;
	id__etab interventions.id_etab%TYPE;
	nbr_heures_sem paiements.vh%TYPE:=0;
	nbr_heures_origine paiements.vh%TYPE;
	
BEGIN
    select i.id_intervenant into id__intervenant from interventions i where i.id_intervention= id__intervention;
	select i.annee_univ into annee__univ from interventions i where i.id_intervention= id__intervention;
    select i.semestre into semestree from interventions i where i.id_intervention = id__intervention;
    select i.id_etab into id__etab from interventions i where i.id_intervention = id__intervention;

	if(tg= 'UPDATE' ) then
     select sum(nbr_heures) into nbr_heures_sem from interventions where id_intervenant= id__intervenant and semestre= semestree and annee_univ =annee__univ and id_etab = id__etab and visa_etab='1' and visa_uae='1';
	else 
	 select sum(nbr_heures) - nbr__heures into nbr_heures_sem from interventions where id_intervenant= id__intervenant and semestre= semestree and annee_univ =annee__univ and id_etab = id__etab and visa_etab='1' and visa_uae='1';
	 end if;

	if nbr_heures_sem IS NULL  then
	    return -1;
    ELSE
	   
			nbr_heures_origine= vh_total_etb_org(id__intervenant, annee__univ) - nbr__heures - nbr_heures_sem;

			if nbr_heures_origine >= charge_stat then
				
				return nbr_heures_sem;
			else
				
				return (vh_total_etb_org(id__intervenant, annee__univ)- nbr__heures - charge_stat);
			END IF;	
        
	END IF;		
END;
	
$$
LANGUAGE plpgsql;

-- ==============================================

CREATE OR REPLACE FUNCTION update_intervention_function()
RETURNS TRIGGER AS
$BODY$

DECLARE
    n_vh paiements.vh%TYPE;
    charge_stat grades.charge_statutaire%TYPE;
    taux_h grades.taux_horaire_vacation%TYPE;
    vh_new paiements.vh%TYPE;
    ir paiements.ir%TYPE;
    p_vh paiements.vh%TYPE;
	diff paiements.vh%TYPE;
	nbr_heures_origine paiements.vh%TYPE;
	id__paiement paiements.id_paiement%TYPE;
BEGIN
    SELECT column_default INTO ir
    FROM information_schema.columns
    WHERE table_name = 'paiements' AND column_name = 'ir';

    SELECT * FROM fnc_taux_charge(New.id_intervenant)
    INTO charge_stat, taux_h;
	
    IF (NEW.visa_etab = '1' AND NEW.visa_uae = '1') THEN
	
            IF (etab_origine_interv(new.id_intervention)) THEN
			    
                diff = difference_cs_vh( vh_total_etb_org(new.id_intervenant, New.annee_univ), charge_stat);

                IF (diff > 0) THEN
				
				nbr_heures_origine= vh_total_etb_org(new.id_intervenant, New.annee_univ) - NEW.nbr_heures;
				if nbr_heures_origine >= charge_stat then
				    n_vh= NEW.nbr_heures;
		  	    else
			        n_vh =  vh_total_etb_org(new.id_intervenant, New.annee_univ) - charge_stat;
				END IF;	
				    vh_new := fnc_check_heures_supp_origine(new.id_intervention, n_vh);
		
					IF vh_new <> -1 THEN 
                       CALL proc_insert_update(vh_new, taux_h , NEW.id_intervention , ir);
                    END IF;
				END IF;  
            ELSE
			    vh_new := fnc_check_heures_supp(new.id_intervention, new.nbr_heures);
				
				IF vh_new <> -1 THEN 
                   CALL proc_insert_update(vh_new, taux_h , NEW.id_intervention , ir);
               END IF;
           END IF;
	   
		   
-- ====================================================

  ELSIF (old.visa_uae = '1' AND NEW.visa_uae = '0' OR old.visa_etab = '1' AND NEW.visa_etab = '0') THEN

	id__paiement= id_paie(NEW.id_intervenant, NEW.id_etab, NEW.annee_univ, NEW.semestre);
  
    IF (id__paiement <> -1) THEN  	
	  DELETE FROM paiements p where p.id_paiement= id__paiement;
      IF (etab_origine_interv(new.id_intervention)) THEN

                diff = difference_cs_vh( vh_total_etb_org(new.id_intervenant, New.annee_univ)- NEW.nbr_heures, charge_stat);
				
                IF (diff > 0) THEN 
                     
                     n_vh = fnc_nbr_heures_update(NEW.id_intervention, charge_stat, NEW.nbr_heures);
                     
				    if (n_vh <> -1) then
					vh_new := fnc_check_heures_supp_origine(new.id_intervention, n_vh); 
				
                    INSERT INTO paiements (id_intervenant, id_etab, vh, taux_h, brut, annee_univ, semestre)
                    VALUES (NEW.id_intervenant, New.id_etab, vh_new, taux_h, calcul_brut(vh_new, taux_h), NEW.annee_univ, NEW.semestre);
			        end if;
			  END IF;	  
       ELSE
	            select sum(nbr_heures) into n_vh from interventions where id_intervenant= NEW.id_intervenant and semestre= NEW.semestre and annee_univ =New.annee_univ and id_etab = NEW.id_etab and visa_etab= '1' and visa_uae='1';
	         
			    IF(n_vh <> New.nbr_heures) THEN 
                    
					vh_new := fnc_check_heures_supp(new.id_intervention, n_vh); 
				
                    INSERT INTO paiements (id_intervenant, id_etab, vh, taux_h, brut, annee_univ, semestre)
                    VALUES (NEW.id_intervenant, New.id_etab, vh_new, taux_h, calcul_brut(vh_new, taux_h), NEW.annee_univ, NEW.semestre);
				END IF;	
       END IF;
  END IF;
END IF;  
  RETURN NEW;
END;

$BODY$
LANGUAGE plpgsql;

---after delete intervention 

CREATE OR REPLACE FUNCTION delete_intervention_trigger()
  RETURNS TRIGGER AS
$BODY$
DECLARE
    n_vh paiements.vh%TYPE;
    charge_stat grades.charge_statutaire%TYPE;
    taux_h grades.taux_horaire_vacation%TYPE;
    vh_new paiements.vh%TYPE;
    ir paiements.ir%TYPE;
    p_vh paiements.vh%TYPE;
	diff paiements.vh%TYPE;
	nbr_heures_origine paiements.vh%TYPE;
	id__paiement paiements.id_paiement%TYPE;
	id__etab etablissements.id_etab%TYPE;
BEGIN
    SELECT column_default INTO ir
    FROM information_schema.columns
    WHERE table_name = 'paiements' AND column_name = 'ir';

    SELECT * FROM fnc_taux_charge(OLD.id_intervenant)
    INTO charge_stat, taux_h;
	
  id__paiement= id_paie(OLD.id_intervenant, OLD.id_etab, OLD.annee_univ, OLD.semestre);
  
    IF (id__paiement <> -1) THEN  	
      DELETE FROM paiements p where p.id_paiement= id__paiement; 
      IF (etab_origine_interv(OLD.id_intervention)) THEN

                diff = difference_cs_vh( vh_total_etb_org(OLD.id_intervenant, OLD.annee_univ) - OLD.nbr_heures, charge_stat);

                IF (diff > 0) THEN 
                     
                     n_vh = fnc_nbr_heures_update(OLD.id_intervention, charge_stat, OLD.nbr_heures, TG_OP);
 
				    if (n_vh <> -1) then
					vh_new := fnc_check_heures_supp_origine(OLD.id_intervention, n_vh); 
				
                    INSERT INTO paiements (id_intervenant, id_etab, vh, taux_h, brut, annee_univ, semestre)
                    VALUES (OLD.id_intervenant, OLD.id_etab, vh_new, taux_h, calcul_brut(vh_new, taux_h), OLD.annee_univ, OLD.semestre);
			        end if;
			  END IF;	  
       ELSE
                select sum(nbr_heures) - OLD.nbr_heures into n_vh from interventions where id_intervenant= OLD.id_intervenant and semestre= OLD.semestre and annee_univ =OLD.annee_univ and id_etab = OLD.id_etab and visa_etab= '1' and visa_uae='1';
	        
			    IF n_vh IS NOT NULL  THEN 
                    if n_vh <> 0 then
					vh_new := fnc_check_heures_supp(new.id_intervention, n_vh); 
				
                    INSERT INTO paiements (id_intervenant, id_etab, vh, taux_h, brut, annee_univ, semestre)
                    VALUES (OLD.id_intervenant, OLD.id_etab, vh_new, taux_h, calcul_brut(vh_new, taux_h), OLD.annee_univ, OLD.semestre);
				END IF;	
				END IF;
       END IF;	
      
  END IF;
  RETURN OLD;
END;  

$BODY$
LANGUAGE plpgsql;

-- ================================== triggers ==============================

CREATE TRIGGER trigger_after_delete_intervention
BEFORE DELETE ON interventions
FOR EACH ROW
EXECUTE FUNCTION delete_intervention_trigger();


CREATE TRIGGER trigger_id_paiement_visa_uae
AFTER UPDATE OF visa_uae , visa_etab ON interventions
FOR EACH ROW
EXECUTE FUNCTION update_intervention_function();

CREATE TRIGGER trigger_nbr_enseignants
AFTER DELETE OR INSERT OR UPDATE OF id_etab
ON enseignants
FOR EACH ROW
EXECUTE PROCEDURE fnc_nbr_enseignant();

-- ========================================================================
