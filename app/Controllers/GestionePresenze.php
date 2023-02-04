<?php

namespace App\Controllers;

use App\Models\Presenze;

class GestionePresenze extends BaseController {
    
    public function index() {
        $Modello = new Presenze();

        $Dati = [
            "ElencoPresenze"  => $Modello->ritornaPresenze(),
            "Titolo" => "Elenco Presenze",
        ];

        return view("templates/header",  $Dati)
            . view("presenze/elencopresenze")
            . view("templates/footer");
    }

    public function view ( $IdPresenza = null ) {
        $Modello = new Presenze();

        $Dati["Presenza"] = $Modello->ritornaPresenze($IdPresenza);
        
        $Dati["Titolo"] = "Visualizzazione istruttore";

        return view("templates/header", $Dati)
            . view("presenze/visualizzaistruttore")
            . view("templates/footer");
    }

    public function inseriscipresenze() {
    
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) :
            // The form is not submitted, so returns the form.
            return view("templates/header", ["Titolo" => "Inserimento presenze"])
                . view("presenze/inserimentopresenze")
                . view("templates/footer");
        endif;
        
        if (($this->request->getPost(["IdIstruttore"])) ) :
            if (($this->request->getPost(["IdLezione"])) ) :
                $post = $this->request->getPost(["IdIstruttore", "IdLezione"]); 
                return view("templates/header", ["Titolo" => "Inserimento presenze", "IdIstruttore" => $post ["IdIstruttore"], "IdLezione" => $post ["IdLezione"] ])
                    . view("presenze/inserimentopresenze")
                    . view("templates/footer");
            else:
                $post = $this->request->getPost(["IdIstruttore"]); 
                return view("templates/header", ["Titolo" => "Inserimento presenze", "IdIstruttore" => $post ["IdIstruttore"], "IdLezione" => 0])
                    . view("presenze/inserimentopresenze")
                    . view("templates/footer");
            endif;
        endif;
        
        
        $post = $this->request->getPost(["Lezioni_IdIstruttore", "Lezioni_IdDisciplina", "Lezioni_GiornoSettimana", "Lezioni_Ora", "Lezioni_MaxAllievi"]);

        // Verifica se i dati sono validati
/*        if (! $this->validateData($post, [
            "Lezioni" => "required|max_length[100]|min_length[3]",
            "UsernameLezioni"  => "required|max_length[20]|min_length[5]",
            "PasswordLezioni"  => "required|max_length[30]|min_length[5]",
        ])) :
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo lezione / disciplina"])
                . view("admin/lezioni/nuovolezione")
                . view("templates/footer");
        endif;
*/
        $Modello = model(Admin_Lezioni::class);
        
        $DatiNuovoRecord = ([
            "Lezioni_IdIstruttore" => $post["Lezioni_IdIstruttore"],
            "Lezioni_IdDisciplina"  => $post["Lezioni_IdDisciplina"],
            "Lezioni_GiornoSettimana"  => $post["Lezioni_GiornoSettimana"],
            "Lezioni_Ora"  => $post["Lezioni_Ora"],
            "Lezioni_MaxAllievi"  => $post["Lezioni_MaxAllievi"],
            "Lezioni_Attiva"  => 1
        ]);

        $Modello->save($DatiNuovoRecord);
        $IdNuovaLezione = $Modello->getInsertId();

        $Dati["ElencoLezioni"] = $Modello->ritornaLezioni();
        $Dati["Titolo"] = "Elenco lezioni";
        $Dati["IdNuovaLezione"] = $IdNuovaLezione;
        
        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    } 
    
}

?>
