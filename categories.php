<?php
require_once("conn.php"); // Inclusion de la connexion [cite: 136]

// Requête pour sélectionner toutes les catégories [cite: 137]
$req="select * from categorie";
$rs=mysqli_query($conn,$req); // Exécution de la requête [cite: 138]

?>
<select id='cats'> <?php
// Boucle pour créer une option pour chaque catégorie [cite: 142]
while($cat=mysqli_fetch_assoc($rs)){
?>
<option value="<?php echo ($cat['ID_CAT']) ?>"><?php echo ($cat['NOM_CAT']) ?></option> <?php } ?>
</select>