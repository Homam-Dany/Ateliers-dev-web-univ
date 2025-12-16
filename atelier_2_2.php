<?php
// Connexion à la base
$conn = mysqli_connect("localhost", "root", "", "atelier2_php");
if (!$conn) {
    die("Erreur de connexion");
}

// AJOUT
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];

    mysqli_query($conn,
        "INSERT INTO personnes (nom, prenom, salaire)
         VALUES ('$nom', '$prenom', '$salaire')"
    );
}

// SUPPRESSION
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    mysqli_query($conn, "DELETE FROM personnes WHERE id=$id");
}

// MODIFICATION
if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $salaire = $_POST['salaire'];

    mysqli_query($conn,
        "UPDATE personnes
         SET nom='$nom', prenom='$prenom', salaire='$salaire'
         WHERE id=$id"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CRUD Simple</title>
</head>
<body>

<h2>Ajouter une personne</h2>

<form method="post">
    Nom : <input type="text" name="nom" required><br><br>
    Prénom : <input type="text" name="prenom" required><br><br>
    Salaire : <input type="number" name="salaire" required><br><br>
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<hr>

<h2>Liste des personnes</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Salaire</th>
    <th>Actions</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM personnes");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['prenom']."</td>";
    echo "<td>".$row['salaire']."</td>";
    echo "<td>
        <a href='?supprimer=".$row['id']."'>Supprimer</a>
    </td>";
    echo "</tr>";
}
?>
</table>

<hr>

<h2>Modifier une personne</h2>

<form method="post">
    ID : <input type="number" name="id" required><br><br>
    Nom : <input type="text" name="nom" required><br><br>
    Prénom : <input type="text" name="prenom" required><br><br>
    Salaire : <input type="number" name="salaire" required><br><br>
    <input type="submit" name="modifier" value="Modifier">
</form>

</body>
</html>
