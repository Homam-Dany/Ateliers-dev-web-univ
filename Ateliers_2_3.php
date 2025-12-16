

<?php
// Récupération des données du formulaire
$login = $_POST['login'];
$password = $_POST['password'];

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "authentification")
        or die(mysqli_connect_error());

// Requête
$req = "SELECT * FROM utilisateur";
$res = mysqli_query($conn, $req);

$t = 0;

// Parcours des utilisateurs
while ($don = mysqli_fetch_array($res)) {
    if ($don[0] == $login && $don[1] == $password) {
        $t = 1;
    }
}

// Affichage du résultat
if ($t == 1) {
    echo "<h2>Bienvenue au site</h2>";
} else {
    echo "<h2>Compte incorrect</h2>";
}
?>