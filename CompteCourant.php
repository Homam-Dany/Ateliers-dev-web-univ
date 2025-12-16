<?php
// La classe CompteCourant
require_once'Compte.php';

class CompteCourant extends Compte{
    private $decouvert;

    public function __construct($c,$s,$dec)
    {
        parent::__construct($c,$s);
        $this->decouvert = $dec;
    }

    public function retirer($mt){
        // La condition de retrait inclut la possibilité de découvert
        if($this->solde + $this->decouvert >= $mt){
            $this->solde -= $mt;
        }
        else{
            throw new Exception("Solde Insuffisant");
        }
    }

    // Redefinition de getCompteState
    public function getCompteState(){
        parent::getCompteState();
        // Affichage de l'attribut spécifique
        echo ("Decouvert=".$this->decouvert);
    }
}
?>