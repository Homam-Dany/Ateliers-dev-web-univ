<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Atelier_2</title>
</head>
<body>
<h1>Exercice 1 : Calculatrice simple </h1>




<form method="POST">
   Operande 1 : <input type="number" name="op1" required><br><br>

    Opération :
    <select name="operation">
        <option value="+"> + </option>
        <option value="-"> - </option>
        <option value="*"> * </option>
        <option value="/"> / </option>
    </select><br><br>
 
    Operande 2 : <input type="number" name="op2" required><br><br>

    <input type="submit" value="Résultat">
</form>
<?php
if($_POST){
    $a = $_POST['op1'];
    $b = $_POST['op2'];
    $op = $_POST['operation'];

    // Calcul selon l'opération
    switch($op){
        case '+': $res = $a + $b; break;
        case '-': $res = $a - $b; break;
        case '*': $res = $a * $b; break;
        case '/':
            if($b == 0){
                echo "<p style='color:red'>Impossible de diviser par zéro.</p>";
                exit;
            }
            $res = $a / $b;
            break;
    }

    echo "<h3>Résultat : $res</h3>";
}

?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercice 2 - Calcul d'impôt</title>
</head>
<body>

<h2>Formulaire d'informations</h2>

<form method="POST">
    Nom : <input type="text" name="nom" required><br><br>

    Prénom : <input type="text" name="prenom" required><br><br>

    Salaire : <input type="number" name="salaire" required><br><br>

    Etat civil :
    <input type="radio" name="etat" value="Célibataire" checked> Célibataire
    <input type="radio" name="etat" value="Marié"> Marié
    <br><br>

    <input type="submit" value="Envoyer">
    <input type="reset" value="Annuler">
</form>

<hr>

<h2>Tableau des valeurs d'impôt</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Salaire</th>
        <th>Valeur d’impôt</th>
    </tr>
    <tr>
        <td>Inférieur à 3000 Dh</td>
        <td>Le montant d’impôt à payer est 5%</td>
    </tr>
    <tr>
        <td>Entre 3000 Dh et 6000 Dh</td>
        <td>Le montant d’impôt à payer est 10%</td>
    </tr>
    <tr>
        <td>Entre 6000 Dh et 10000 Dh</td>
        <td>Le montant d’impôt à payer est 15%</td>
    </tr>
    <tr>
        <td>Supérieur à 10000 Dh</td>
        <td>Le montant d’impôt à payer est 40%</td>
    </tr>
</table>

<hr>

<?php

if($_POST){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];
    $etat = $_POST['etat'];

    // Déterminer le taux selon le tableau
    if($salaire < 3000){
        $taux = 0.05;
    }
    elseif($salaire < 6000){
        $taux = 0.10;
    }
    elseif($salaire < 10000){
        $taux = 0.15;
    }
    else{
        $taux = 0.40;
    }

    // Calcul du montant de l’impôt
    $impot = $salaire * $taux;

    echo "<h2>Résultat du calcul</h2>";

    // Affichage sous forme de tableau
    echo "
    <table border='2' cellpadding='10'>
        <tr>
            <th>Élément</th>
            <th>Valeur</th>
        </tr>
        <tr>
            <td>Nom</td>
            <td>$nom</td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td>$prenom</td>
        </tr>
        <tr>
            <td>État civil</td>
            <td>$etat</td>
        </tr>
        <tr>
            <td>Salaire</td>
            <td>$salaire Dh</td>
        </tr>
        <tr>
            <td>Taux appliqué</td>
            <td>".($taux * 100)." %</td>
        </tr>
        <tr>
            <td>Impôt à payer</td>
            <td><strong>$impot Dh</strong></td>
        </tr>
    </table>
    ";
}

?>

</body>
</html>


<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "atelier2_php";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>



<?php include("connexion.php"); ?>

<h2>Ajouter une personne</h2>

<form method="POST">
    Nom : <input type="text" name="nom" required><br><br>
    Prénom : <input type="text" name="prenom" required><br><br>
    Salaire : <input type="number" name="salaire" required><br><br>
    <input type="submit" name="ajouter" value="Ajouter">
</form>






<?php
if(isset($_POST['ajouter'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];

    $sql = "INSERT INTO personnes(nom, prenom, salaire)
            VALUES ('$nom', '$prenom', '$salaire')";

    if(mysqli_query($conn, $sql)){
        echo "<p style='color:green'>Données ajoutées avec succès.</p>";
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>

<?php include("connexion.php"); ?>

<h2>Liste des personnes</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Salaire</th>
        <th>Actions</th>
    </tr>

<?php
$sql = "SELECT * FROM personnes";
$res = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($res)){
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td>
            <td>".$row['salaire']."</td>
            <td>
                <a href='update.php?id=".$row['id']."'>Modifier</a> |
                <a href='delete.php?id=".$row['id']."'>Supprimer</a>
            </td>
        </tr>";
}
?>
</table>


<?php 
include("connexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM personnes WHERE id=$id";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);
?>

<h2>Modifier une personne</h2>

<form method="POST">
    Nom : <input type="text" name="nom" value="<?= $data['nom'] ?>" required><br><br>
    Prénom : <input type="text" name="prenom" value="<?= $data['prenom'] ?>" required><br><br>
    Salaire : <input type="number" name="salaire" value="<?= $data['salaire'] ?>" required><br><br>

    <input type="submit" name="modifier" value="Mettre à jour">
</form>

<?php
if(isset($_POST['modifier'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];

    $update = "UPDATE personnes SET nom='$nom', prenom='$prenom', salaire='$salaire'
               WHERE id=$id";

    if(mysqli_query($conn, $update)){
        echo "<p style='color:green'>Modification réussie !</p>";
    }else{
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>


<?php
include("connexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM personnes WHERE id=$id";

if(mysqli_query($conn, $sql)){
    echo "<p style='color:green'>Personne supprimée avec succès.</p>";
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>