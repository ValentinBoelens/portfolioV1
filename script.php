<?php

// On récupère les infos saisies par l'utilisateur dans le formulaire
// Si un champ n'existe pas, on met du texte vide pour éviter les bugs
$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : "";
$tel = isset($_POST["tel"]) ? trim($_POST["tel"]) : "";
$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$motif = isset($_POST["motif"]) ? trim($_POST["motif"]) : "";
$creneau = isset($_POST["creneau"]) ? trim($_POST["creneau"]) : "";
$premiere = isset($_POST["premiere"]) ? trim($_POST["premiere"]) : "";
$message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

// On prépare une liste vide pour y noter les éventuels oublis
$erreurs = [];

// On vérifie les champs obligatoires un par un
if ($name === "") {
    $erreurs[] = "Le prénom est absent";
}
if ($lastname === "") {
    $erreurs[] = "Le nom est absent";
}

// Pour l'email, on vérifie s'il est vide ou si le format n'est pas bon
if ($email === "") {
    $erreurs[] = "L'email est absent";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "L'email n'est pas écrit correctement";
}

if ($message === "") {
    $erreurs[] = "Le message est vide";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <header>
        <h2>Valentin Boelens</h2>
        <p>Étudiant en Informatique</p>
    </header>

    <main>
        <h1>Contact</h1>

        <?php 
        // Si on a trouvé des erreurs, on affiche la liste à l'utilisateur
        if (!empty($erreurs)) { ?>
            <div class="alert">
                <p>Merci de corriger ces points :</p>
                <ul>
                    <?php foreach ($erreurs as $li) {
                        echo "<li>" . htmlspecialchars($li) . "</li>";
                    } ?>
                </ul>
            </div>
        <?php } else { 
            // Si tout est bon, on affiche un message de remerciement et le résumé
            ?>
            <div class="success">
                <p>C'est envoyé ! Voici un rappel de vos informations :</p>
                <ul>
                    <li>Prénom : <?php echo htmlspecialchars($name); ?></li>
                    <li>Nom : <?php echo htmlspecialchars($lastname); ?></li>
                    
                    <li>Tel : <?php echo ($tel !== "") ? htmlspecialchars($tel) : "Non renseigné"; ?></li>
                    
                    <li>Email : <?php echo htmlspecialchars($email); ?></li>
                    
                    <li>Créneau : <?php echo ($creneau !== "") ? htmlspecialchars(str_replace("T", " à ", $creneau)) : "Non renseigné"; ?></li>
                    
                    <li>Message : <?php echo nl2br(htmlspecialchars($message)); ?></li>
                </ul>
            </div>
        <?php } ?>

        <p><a href="contact.html">Retourner au formulaire</a></p>
    </main>
</body>
</html>