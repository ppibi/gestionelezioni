<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Lezioni;

class Admin_GestioneLezioni extends \App\Controllers\BaseController
{
    public function index()
    {
        $Modello = new Admin_Lezioni();

        $Dati = [
            "ElencoLezioni"  => $Modello->ritornaLezioni(),
            "Titolo" => "Elenco Lezioni",
        ];
        $Dati["IdNuovaLezione"] = 10000;

        return view("templates/header_admin",  $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }

    public function view ( $Lezione = null )
    {
        $Modello = new Admin_Lezioni();

        $Dati["Lezioni"] = $Modello->ritornaLezioni($Lezione);
        
        if (empty($Dati["Lezionie"])) {
            throw new PageNotFoundException("Non trovo la lezione: " . $Lezione);
        }

        $Dati["Titolo"] = "Visualizzazione lezione";

        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/visualizzalezione")
            . view("templates/footer");
    }
    
    public function nuovalezione()
    {
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) {
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuova lezione"])
                . view("admin/lezioni/nuovalezione")
                . view("templates/footer");
        }

        $post = $this->request->getPost(["Lezioni_IdIstruttore", "Lezioni_IdDisciplina", "Lezioni_GiornoSettimana", "Lezioni_Ora", "Lezioni_MaxAllievi"]);

        // Verifica se i dati sono validati
/*        if (! $this->validateData($post, [
            "Lezioni" => "required|max_length[100]|min_length[3]",
            "UsernameLezionie"  => "required|max_length[20]|min_length[5]",
            "PasswordLezionie"  => "required|max_length[30]|min_length[5]",
        ])) {
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo lezione / disciplina"])
                . view("admin/lezioni/nuovolezione")
                . view("templates/footer");
        }
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
