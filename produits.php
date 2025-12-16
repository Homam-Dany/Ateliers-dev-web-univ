<?php
require_once("conn.php");

if (isset($_GET['idCat'])) {
    $idCat = $_GET['idCat'];
} else {
    $idCat = '1';
}

$req = "select * from produit where ID_CAT=$idCat";
$rs = mysqli_query($conn, $req);
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>DES</th>
        <th>PRIX</th>
        <th>QUANTITE</th>
        <th>PROMO</th>
    </tr>
    <?php
    while ($p = mysqli_fetch_assoc($rs)) {
    ?>
    <tr>
        <td><?php echo($p['ID_PROD']); ?></td>
        <td><?php echo($p['DESIGNATION']); ?></td>
        <td><?php echo($p['PRIX']); ?></td>
        <td><?php echo($p['QUANTITE']); ?></td>
        <td><?php echo($p['PROMO']); ?></td>
    </tr>
    <?php
    }
    ?>
</table>