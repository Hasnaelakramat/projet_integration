### projet_integration
## Mise en contexte
  Dans le but de digitaliser la gestion des ressources humaines, l'université Abdelmalek Essaadi souhaite mettre en place une application web permettant d'automatiser le paiement des vacations et des heures supplémentaires effectuées par les enseignants.

Chaque enseignant de l'université effectue un certain nombre d'heures d'enseignement dans une année. Suivant son grade et son type (permanent ou vacataire), un certain nombre de ces heures peut être considéré comme supplémentaire.
   -Les enseignants externes (vacataires) : toutes les heures effectuées sont supplémentaires;
   -Les enseignants internes (permanents): seules les heures assurées au-delà d'une charge statutaire sont supplémentaires (240h pour les PA, 200h pour les       PH et 190h pour les PES).
   -En plus de leur charge annuelle, les enseignants sont autorisés à exercer, à l'échelle de l'université, 100h supplémentaires par semestre.

Les heures supplémentaires sont payées séparément à l'enseignant. Les volumes horaires sont exprimés en heures entières et le prix d'une heure sera déterminé en fonction du grade: PA: 300 DH PES: 500 DH PH: 400 DH

#NB:
On suppose que tous les intervenants sont des enseignants universitaires dont leur intervention annuelle ne doit pas dépasser [200+ charge statutaire] heures.

   Le projet consiste en la conception et le développement d'une application de gestion des heures supplémentaires et des vacations en utilisant une API-REST de Laravel, une base de données PostgreSQL, vueJS pour la partie frontale et une architecture Linux pour la réalisation et le déploiement. Vous devrez également utiliser Git et Github pour la gestion de versions du code.
   
Le système doit permettre à chaque établissement de gérer les informations relatives à ses vacataires, y compris leur ajout, modification et suppression. Il devrait également permettre la gestion des plannings et de la rémunération de ces intervenants. Pour faciliter le processus de paiement, le système doit fournir une interface pour l'université, qui permettra de payer chaque intervenant en fonction de son grade et du volume horaire effectué. Les vacataires devront avoir accès à leur planning et à leur état de paiement.

La fiche de paie devra comporter les informations suivantes sur le professeur : son nom et son prénom, son établissement d'origine, son grade, les établissements dans lesquels il intervient, le volume horaire assuré par semestre et par établissement, le volume horaire total, le taux horaire, l'impôt sur le revenu et le montant net à payer.
