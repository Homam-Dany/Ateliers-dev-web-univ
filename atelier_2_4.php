<?php
// =====================================================
// CONNEXION À LA BASE DE DONNÉES
// =====================================================
$conn = mysqli_connect("localhost", "root", "", "crud1")
        or die(mysqli_connect_error());

// =====================================================
// SUPPRESSION
// =====================================================
if (isset($_GET['sup'])) {
    $id = $_GET['sup'];
    mysqli_query($conn, "DELETE FROM exercice WHERE id=$id");
}

// =====================================================
// MODIFICATION (ENREGISTREMENT)
// =====================================================
if (isset($_POST['modifier'])) {
    $id     = $_POST['id'];
    $titre  = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date   = $_POST['date'];

    mysqli_query($conn,
        "UPDATE exercice 
         SET titre='$titre', auteur='$auteur', date_creation='$date'
         WHERE id=$id"
    );
}

// =====================================================
// AJOUT
// =====================================================
if (isset($_POST['ajouter'])) {
    $titre  = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date   = $_POST['date'];

    mysqli_query($conn,
        "INSERT INTO exercice (titre, auteur, date_creation)
         VALUES ('$titre','$auteur','$date')"
    );
}

// =====================================================
// RÉCUPÉRATION POUR MODIFICATION
// =====================================================
$exe_modif = null;
if (isset($_GET['mod'])) {
    $id = $_GET['mod'];
    $res = mysqli_query($conn, "SELECT * FROM exercice WHERE id=$id");
    $exe_modif = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD Exercices - 1 seul fichier</title>
   <style>
    table {
    border-collapse: collapse;
    width: 80%;
    margin: auto;
    font-family: Arial, sans-serif;
}

th {
    background-color: #f39c12;
    color: white;
    padding: 10px;
}

td {
    background-color: #3498db;
    color: white;
    padding: 8px;
}

tr:nth-child(even) td {
    background-color: #2980b9;
}

tr:hover td {
    background-color: #1abc9c;
}

a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

   </style>
</head>
<body>

<h2><?php echo ($exe_modif) ? "Modifier un exercice" : "Ajouter un exercice"; ?></h2>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $exe_modif['id'] ?? ''; ?>">

    Titre :
    <input type="text" name="titre"
           value="<?php echo $exe_modif['titre'] ?? ''; ?>" required><br><br>

    Auteur :
    <input type="text" name="auteur"
           value="<?php echo $exe_modif['auteur'] ?? ''; ?>" required><br><br>

    Date :
    <input type="date" name="date"
           value="<?php echo $exe_modif['date_creation'] ?? ''; ?>" required><br><br>

    <?php if ($exe_modif) { ?>
        <input type="submit" name="modifier" value="Modifier">
    <?php } else { ?>
        <input type="submit" name="ajouter" value="Ajouter">
    <?php } ?>
</form>

<hr>

<h2>Liste des Exercices</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Titre</th>
    <th>Auteur</th>
    <th>Date</th>
    <th>Actions</th>
</tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM exercice ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['titre']."</td>";
    echo "<td>".$row['auteur']."</td>";
    echo "<td>".$row['date_creation']."</td>";
    echo "<td>
            <a href='?mod=".$row['id']."'>Modifier</a> |
            <a href='?sup=".$row['id']."' 
               onclick=\"return confirm('Supprimer cet exercice ?')\">
               Supprimer
            </a>
          </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>
