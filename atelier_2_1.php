<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calcul simple</title>
</head>
<body>

<h2>Calcul sur deux nombres</h2>

<form method="post">
    Nombre 1 :
    <input type="number" name="n1" required><br><br>

    Nombre 2 :
    <input type="number" name="n2" required><br><br>

    Opération :
    <select name="op">
        <option value="+">Addition</option>
        <option value="-">Soustraction</option>
        <option value="*">Multiplication</option>
        <option value="/">Division</option>
    </select><br><br>

    <input type="submit" value="Calculer">
</form>

<?php
if (isset($_POST['n1']) && isset($_POST['n2'])) {

    $a = $_POST['n1'];
    $b = $_POST['n2'];
    $op = $_POST['op'];
    $resultat = 0;

    if ($op == "+") {
        $resultat = $a + $b;
    } elseif ($op == "-") {
        $resultat = $a - $b;
    } elseif ($op == "*") {
        $resultat = $a * $b;
    } elseif ($op == "/") {
        if ($b != 0) {
            $resultat = $a / $b;
        } else {
            echo "Division par zéro impossible";
            exit;
        }
    }

    echo "<h3>Résultat : $resultat</h3>";
}
?>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calcul Impôt</title>
</head>
<body>

<h2>Formulaire salarié</h2>

<form method="post">
    Nom :
    <input type="text" name="nom" required><br><br>

    Prénom :
    <input type="text" name="prenom" required><br><br>

    Salaire :
    <input type="number" name="salaire" required><br><br>

    Etat civil :
    <input type="radio" name="etat" value="Celibataire" checked> Célibataire
    <input type="radio" name="etat" value="Marie"> Marié
    <br><br>

    <input type="submit" value="Envoyer">
    <input type="reset" value="Annuler">
</form>

<?php
if (isset($_POST['salaire'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];
    $etat = $_POST['etat'];

    $impot = 0;
    $taux = 0;

    if ($salaire < 3000) {
        $taux = 5;
        $impot = $salaire * 0.05;
    } elseif ($salaire >= 3000 && $salaire < 6000) {
        $taux = 10;
        $impot = $salaire * 0.10;
    } elseif ($salaire >= 6000 && $salaire <= 10000) {
        $taux = 15;
        $impot = $salaire * 0.15;
    } else {
        $taux = 40;
        $impot = $salaire * 0.40;
    }

    echo "<h3>Résultat</h3>";
    echo "Nom : $nom <br>";
    echo "Prénom : $prenom <br>";
    echo "État civil : $etat <br>";
    echo "Salaire : $salaire DH <br>";
    echo "Taux d'impôt : $taux % <br>";
    echo "Impôt à payer : $impot DH";
}
?>

</body>
</html>

