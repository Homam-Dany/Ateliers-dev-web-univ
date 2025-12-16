<?php
// index.php

// Inclure les classes nécessaires
require_once 'Banque.php';
require_once 'CompteCourant.php';

// Créer une instance de la Banque
$b = new Banque();

// Ajouter les comptes courants
$b->addCompte(new CompteCourant(1, 6000, 9000));
$b->addCompte(new CompteCourant(2, 4000, 2000));
$b->addCompte(new CompteCourant(3, 6000, 3000));

// Afficher l'état initial des comptes
$b->afficherComptes();

// Afficher un titre avant la suppression
echo "<h3>Après suppression d'un compte</h3>";

// Supprimer le compte avec le code 2
$b->supprimerCompte(2);

// Afficher les comptes après suppression
$b->afficherComptes();
?>
