<?php
// Le fichier principal TestBanque.php
require_once 'Banque.php';
require_once 'CompteCourant.php';

$b = new Banque();

// Création et ajout des comptes courants
$b->addCompte (new CompteCourant (1,6000,9000));
$b->addCompte (new CompteCourant (2, 4000, 2000));
$b->addCompte (new CompteCourant (3, 6000,3000));

// Affichage initial
$b->afficherComptes();

echo ("<h3>Après suppression d'un compte</h3>");

// Suppression du compte avec le code 2
$b->supprimerCompte (2);

// Affichage après suppression
$b->afficherComptes();
?>