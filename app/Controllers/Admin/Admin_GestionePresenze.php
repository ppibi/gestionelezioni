<?php

namespace App\Controllers\Admin;

use App\Models\Presenze;

class Admin_GestionePresenze extends \App\Controllers\BaseController {
    
   public function adminInserimentoPresenze() {
    
        $ModelloPresenze = new Presenze();
        
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) :
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => TitoloMenuGestionePresenze])
                . view("admin/presenze/gestionepresenze")
                . view("templates/footer");
        endif;
        
//        $post = $this->request->getPost(["IdIstruttore", "IdLezione", "GiornoLezione"]);
        $ValoriPost = $this->request->getPost(null);

        $Dati["Titolo"] = TitoloMenuGestionePresenze;
        $Dati["IdIstruttore"] = $ValoriPost["IdIstruttore"];
        if (isset($ValoriPost["IdLezione"]) ) :
            $Dati["IdLezione"] = $ValoriPost["IdLezione"];
        else:
            $Dati["IdLezione"] = 0;
        endif;
        if (isset($ValoriPost["GiornoLezione"])) :
            $Dati["GiornoLezione"] = $ValoriPost["GiornoLezione"];
        else:
            $Dati["GiornoLezione"] = "";
        endif;
    
        if ($ValoriPost["submit"] == "Seleziona partecipanti" ) :
            $NProg = 1;
            $CampiPresenti = 1;
            foreach ($ValoriPost as $Post => $ValorePost) :
                if (str_contains($Post, "TesseratoPartecipante_")) :
                    $IdTesserato = substr($Post, 22); 
                    $DataPresenza = date_format (date_create($Dati["GiornoLezione"]), "Y-m-d");
                    $DatiPresenza = ([
                        "IdLezione" => $Dati["IdLezione"],
                        "IdTesserato"  => $IdTesserato,
                        "Data"  => $DataPresenza,
                        "Presenza"  => 1
                        ]);
                    if (!$ModelloPresenze->verificaPresenzaTesseratoinLezione($DatiPresenza["IdTesserato"], $DatiPresenza["IdLezione"], $DatiPresenza["Data"])) :
                        $ModelloPresenze->save($DatiPresenza);
                    endif;
                    
                endif;
            endforeach;
            
        endif; 

        if ($ValoriPost["submit"] == "Seleziona altri partecipanti" ) :
            if (isset($ValoriPost["IdLezione"]) ) :
                $DataPresenza = date_format (date_create($Dati["GiornoLezione"]), "Y-m-d");
                $DatiPresenza = ([
                        "IdLezione" => $Dati["IdLezione"],
                        "IdTesserato"  => $ValoriPost["IdTesserato"],
                        "Data"  => $DataPresenza,
                        "Presenza"  => 1
                        ]);
                if (!$ModelloPresenze->verificaPresenzaTesseratoinLezione($DatiPresenza["IdTesserato"], $DatiPresenza["IdLezione"], $DatiPresenza["Data"])) :
                    $ModelloPresenze->save($DatiPresenza);
                endif;
            endif;
            
        endif; 

        return view("templates/header_admin", $Dati)
            . view("admin/presenze/gestionepresenze")
            . view("templates/footer");
        
        

    } 
    
}

?>
