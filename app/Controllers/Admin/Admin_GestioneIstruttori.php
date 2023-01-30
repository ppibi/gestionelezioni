<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Istruttori;

class Admin_GestioneIstruttori extends \App\Controllers\BaseController
{
    public function index()
    {
        $Modello = new Admin_Istruttori();

        $Dati = [
            "ElencoIstruttori"  => $Modello->ritornaIstruttori(),
            "Titolo" => "Elenco Istruttori",
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/istruttori/elencoistruttori")
            . view("templates/footer");
    }

    public function view ( $Istruttore = null )
    {
        $Modello = new Admin_Istruttori();

        $Dati["Istruttore"] = $Modello->ritornaIstruttori($Istruttore);
        
        if (empty($Dati["Istruttore"])) {
            throw new PageNotFoundException("Non trovo l'istruttore: " . $Istruttore);
        }

        $Dati["Titolo"] = "Visualizzazione istruttore";

        return view("templates/header_admin", $Dati)
            . view("admin/istruttori/visualizzaistruttore")
            . view("templates/footer");
    }
    
    public function nuovoistruttore()
    {
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) {
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo istruttore"])
                . view("admin/istruttori/nuovoistruttore")
                . view("templates/footer");
        }

        $post = $this->request->getPost(["Istruttore", "UsernameIstruttore", "PasswordIstruttore", "Note"]);

        // Verifica se i dati sono validati
        if (! $this->validateData($post, [
            "Istruttore" => "required|max_length[100]|min_length[3]",
            "UsernameIstruttore"  => "required|max_length[20]|min_length[5]",
            "PasswordIstruttore"  => "required|max_length[30]|min_length[5]",
        ])) {
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo istruttore"])
                . view("admin/istruttori/nuovoistruttore")
                . view("templates/footer");
        }

        $Modello = model(Admin_Istruttori::class);
        
        $DatiNuovoRecord = ([
            "Istruttore" => $post["Istruttore"],
            "UsernameIstruttore"  => $post["UsernameIstruttore"],
            "PasswordIstruttore"  => $post["PasswordIstruttore"],
            "Note"  => $post["Note"]
        ]);

        $Modello->save($DatiNuovoRecord);
        $IdNuovoIstruttore = $Modello->getInsertId();

        $Dati["ElencoIstruttori"] = $Modello->ritornaIstruttori();
        $Dati["Titolo"] = "Elenco istruttori";
        $Dati["IdNuovoIstruttore"] = $IdNuovoIstruttore;
        
        return view("templates/header_admin", $Dati)
            . view("admin/istruttori/elencoistruttori")
            . view("templates/footer");
    } 
}

?>
