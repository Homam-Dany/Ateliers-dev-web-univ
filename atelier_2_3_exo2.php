<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Produits par catégorie</title>
</head>
<body>

<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "db_cat_dwm")
        or die(mysqli_connect_error());

// Récupérer l'ID catégorie (GET ou POST)
if (isset($_GET['ID_CAT'])) {
    $id_cat = $_GET['ID_CAT'];
} elseif (isset($_POST['id_cat'])) {
    $id_cat = $_POST['id_cat'];
} else {
    $id_cat = "";
}
?>

<!-- ===== MENU SELECT DES CATEGORIES ===== -->
<form method="post">
    <select name="id_cat">
        <option value="">-- Choisir une catégorie --</option>

        <?php
        $req_cat = "SELECT * FROM categorie";
        $res_cat = mysqli_query($conn, $req_cat);

        while ($cat = mysqli_fetch_array($res_cat)) {
            echo "<option value='".$cat[0]."'>".$cat[1]."</option>";
        }
        ?>
    </select>

    <input type="submit" value="Afficher">
</form>

<br>

<?php
// ===== AFFICHAGE DES PRODUITS =====
if ($id_cat != "") {

    $req_prod = "SELECT * FROM produit WHERE id_cat = $id_cat";
    $res_prod = mysqli_query($conn, $req_prod);

    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>DES</th>
            <th>PRIX</th>
            <th>QUANTITE</th>
            <th>PROMO</th>
          </tr>";

    while ($prod = mysqli_fetch_array($res_prod)) {
        echo "<tr>";
        echo "<td>".$prod[0]."</td>";
        echo "<td>".$prod[1]."</td>";
        echo "<td>".$prod[2]."</td>";
        echo "<td>".$prod[3]."</td>";
        echo "<td>".$prod[4]."</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

</body>
</html>