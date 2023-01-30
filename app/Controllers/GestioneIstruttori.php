<?php

namespace App\Controllers;

use App\Models\Istruttori;

class GestioneIstruttori extends BaseController
{
    public function index()
    {
        $Modello = new Istruttori();

        $Dati = [
            "ElencoIstruttori"  => $Modello->ritornaIstruttori(),
            "Titolo" => "Elenco Istruttori",
        ];

        return view("templates/header",  $Dati)
            . view("istruttori/elencoistruttori")
            . view("templates/footer");
    }

//    public function view ( $IdIstruttore = null )
    public function view ( $Istruttore = null )
    {
        $Modello = new Istruttori();

//        $Dati["Istruttore"] = $Modello->ritornaIstruttori($IdIstruttore);
        $Dati["Istruttore"] = $Modello->ritornaIstruttori($Istruttore);
        
        if (empty($Dati["Istruttore"])) {
            throw new PageNotFoundException("Non trovo l'istruttore: " . $Istruttore);
        }

        $Dati["Titolo"] = "Visualizzazione istruttore";

        return view("templates/header", $Dati)
            . view("istruttori/visualizzaistruttore")
            . view("templates/footer");
    }
    
}

?>
