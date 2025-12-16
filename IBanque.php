<?php
// L'interface IBanque
interface IBanque{
    public function addCompte (Compte $c);
    public function afficherComptes();
}
?>