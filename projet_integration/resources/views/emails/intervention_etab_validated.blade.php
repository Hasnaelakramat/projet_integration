<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Validation de l'intervention par l'établissement</title>
</head>
<body>
    <h1>Validation de l'intervention par l'établissement</h1>
    
    <p>Cher {{ $intervention->enseignant->nom }},</p>
    
    <p>Votre intervention a été validée par l'établissement. Voici les détails :</p>
    
    <p><strong>Titre :</strong> {{ $intervention->intitule_intervention }}</p>
    
    <p>Merci pour votre collaboration.</p>
    
    <p>Cordialement,</p>
    <p>Votre équipe d'application</p>
</body>
</html>
