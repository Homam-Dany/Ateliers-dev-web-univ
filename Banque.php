<?php
// La classe Banque
require_once'IBanque.php';
require_once 'Compte.php';
require_once'IAdmin.php';

class Banque implements IBanque, IAdmin{
    private $comptes=array();

    // Redefinition de ma méthode addCompte (Compte $cp)
    public function addCompte (Compte $cp){
        $index=count($this->comptes);
        $this->comptes[$index] = $cp;
    }

    //Redéfinition de ma méthode afficherComptes()
    public function afficherComptes(){
        foreach($this->comptes as $cp) {
            $cp->getCompteState();
            echo ("<hr/>");
        }
    }

    // Redéfinition de ma méthode supprimerCompte($code)
    public function supprimerCompte($code) {
        for($i=0;$i<count($this->comptes);$i++){
            // On vérifie si l'indice existe avant d'accéder à l'élément
            if(isset($this->comptes[$i]) && $this->comptes[$i]->getCode()==$code) {
                unset($this->comptes[$i]);
                // Re-indexer le tableau après suppression pour éviter les clés nulles
                $this->comptes = array_values($this->comptes);
                break;
            }
        }
    }
}
?>