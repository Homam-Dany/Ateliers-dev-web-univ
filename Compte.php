<?php
// La classe abstraite Compte.php
abstract class Compte{
    protected $code;
    protected $solde;

    public function __construct($c,$s) {
        $this->code = $c;
        $this->solde = $s;
    }

    public function verser($mt) {
        $this->solde = $this->solde + $mt;
    }

    public function getCode(){
        return $this->code;
    }

    public abstract function retirer($mt);

    public function getCompteState(){
        // Afficher les noms d'attributs avec leurs valeurs
        foreach($this as $key=>$value)
        echo ($key."=".$value."<br/>");
    }
}
?>