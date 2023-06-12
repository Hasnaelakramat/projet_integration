<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Suppression de la validation par l'établissement</title>
</head>
<body>
    <h1>Suppression de la validation par l'établissement</h1>
    
    <p>Cher {{ $intervention->enseignant->nom }},</p>
    
    <p>La validation de votre intervention par l'établissement a été supprimée. Voici les détails :</p>
    
    <p><strong>Titre :</strong> {{ $intervention->intitule_intervention }}</p>
    
    <p>Merci pour votre compréhension.</p>
    
    <p>Cordialement,</p>
    <p>Votre équipe d'application</p>
</body>
</html>
