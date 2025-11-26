<?php
// ======================
//   EXERCICE 2
// ======================

// Tableau de départ
$notes = [
    "said" => 13,
    "badr" => 16,
    "najat" => 15
];

// 1) Ajouter karim = 10
$notes["karim"] = 10;

// 2) Supprimer badr
unset($notes["badr"]);

// 3) Max et min
$max = max($notes);
$min = min($notes);

// 4) Tri alphabétique
$notes_alpha = $notes;
ksort($notes_alpha);

// 5) Tri par mérite (du plus grand au plus petit)
$notes_merite = $notes;
arsort($notes_merite);

// 6) Moyenne
$moyenne = array_sum($notes) / count($notes);


// ======================
//   EXERCICE 3
// ======================

// Fonction 1 : uniquement lettres
function contientSeulementLettres($txt) {
    return ctype_alpha($txt);
}

// Fonction 2 : contient '@'
function contientArobase($txt) {
    return strpos($txt, '@') !== false;
}

// Fonction 3A : numéro téléphone (00 00 00 00 00)
function telephoneValide($txt) {
    return preg_match('/^(\d{2}[- ]){4}\d{2}$/', $txt);
}

// Fonction 3B : matricule (3 lettres + 2 chiffres)
function matriculeValide($txt) {
    return preg_match('/^[A-Za-z]{3}[0-9]{2}$/', $txt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercice 2 et 3</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Exercice 2 – Tableau des notes</h2>

<!-- Tableau final des notes -->
<table>
    <tr><th>Étudiant</th><th>Note</th></tr>
    <?php foreach($notes as $nom => $note): ?>
        <tr>
            <td><?= $nom ?></td>
            <td><?= $note ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Max / Min -->
<table>
    <tr><th>Note maximale</th><td><?= $max ?></td></tr>
    <tr><th>Note minimale</th><td><?= $min ?></td></tr>
    <tr><th>Moyenne</th><td><?= number_format($moyenne, 2) ?></td></tr>
</table>

<!-- Tri alphabétique -->
<h3>Tri alphabétique :</h3>
<table>
    <tr><th>Nom</th><th>Note</th></tr>
    <?php foreach($notes_alpha as $nom => $note): ?>
        <tr><td><?= $nom ?></td><td><?= $note ?></td></tr>
    <?php endforeach; ?>
</table>

<!-- Tri par mérite -->
<h3>Tri par mérite (du plus fort au plus faible) :</h3>
<table>
    <tr><th>Nom</th><th>Note</th></tr>
    <?php foreach($notes_merite as $nom => $note): ?>
        <tr><td><?= $nom ?></td><td><?= $note ?></td></tr>
    <?php endforeach; ?>
</table>


<hr>

<h2>Exercice 3 – Tests des chaînes</h2>

<table>
    <tr><th>Test</th><th>Chaîne</th><th>Résultat</th></tr>

    <tr><td>Lettres uniquement</td><td>Bonjour</td>
        <td><?= contientSeulementLettres("Bonjour") ? "Oui" : "Non" ?></td></tr>

    <tr><td>Contient '@'</td><td>email@test.com</td>
        <td><?= contientArobase("email@test.com") ? "Oui" : "Non" ?></td></tr>

    <tr><td>Téléphone valide</td><td>06 12 34 56 78</td>
        <td><?= telephoneValide("06 12 34 56 78") ? "Valide" : "Invalide" ?></td></tr>

    <tr><td>Matricule valide</td><td>abc12</td>
        <td><?= matriculeValide("abc12") ? "Valide" : "Invalide" ?></td></tr>

</table>

</body>
</html>