<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Suppression de la validation de l'intervention</title>
</head>
<body>
    <h1>Suppression de la validation de l'intervention</h1>

<p>Dear {{ $intervention->enseignant->nom }},</p>

<p>La validation de votre intervention par l'UAE a été supprimée. Voici les détails de l'intervention :</p>

<p><strong>Intitulé :</strong> {{ $intervention->intitule_intervention }}</p>
<p><strong>Année universitaire :</strong> {{ $intervention->annee_univ }}</p>
<p><strong>Semestre :</strong> {{ $intervention->semestre }}</p>
<p><strong>Date de début :</strong> {{ $intervention->date_debut }}</p>
<p><strong>Date de fin :</strong> {{ $intervention->date_fin }}</p>
<p><strong>Nombre d'heures :</strong> {{ $intervention->nbr_heures }}</p>

<p>Merci pour votre compréhension.</p>

<p>Cordialement,</p>
<p>UAE</p>

</body>
</html>