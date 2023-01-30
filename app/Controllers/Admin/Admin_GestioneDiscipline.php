<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Discipline;

class Admin_GestioneDiscipline extends \App\Controllers\BaseController
{
    public function index()
    {
        $Modello = new Admin_Discipline();

        $Dati = [
            "ElencoDiscipline"  => $Modello->ritornaDiscipline(),
            "Titolo" => "Elenco Discipline",
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }

    public function view ( $Lezione = null )
    {
        $Modello = new Admin_Discipline();

        $Dati["Disciplinee"] = $Modello->ritornaDiscipline($Lezione);
        
        if (empty($Dati["Disciplinee"])) {
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

        $post = $this->request->getPost(["Discipline_IdIstruttore", "Discipline_IdDisciplina", "Discipline_giornosettimana", "Discipline_ora", "Discipline_MaxAllievi"]);

        // Verifica se i dati sono validati
/*        if (! $this->validateData($post, [
            "Discipline" => "required|max_length[100]|min_length[3]",
            "UsernameDisciplinee"  => "required|max_length[20]|min_length[5]",
            "PasswordDisciplinee"  => "required|max_length[30]|min_length[5]",
        ])) {
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo lezione / disciplina"])
                . view("admin/lezioni/nuovolezione")
                . view("templates/footer");
        }
*/
        $Modello = model(Admin_Discipline::class);
        
        $DatiNuovoRecord = ([
            "Discipline_IdIstruttore" => $post["Discipline_IdIstruttore"],
            "Discipline_IdDisciplina"  => $post["Discipline_IdDisciplina"],
            "Discipline_GiornoSettimana"  => $post["Discipline_GiornoSettimana"],
            "Discipline_Ora"  => $post["Discipline_Ora"],
            "Discipline_MaxAllievi"  => $post["Discipline_MaxAllievi"],
            "Discipline_Attiva"  => 1
        ]);

        $Modello->save($DatiNuovoRecord);
        $IdNuovaLezione = $Modello->getInsertId();

        $Dati["ElencoDiscipline"] = $Modello->ritornaDiscipline();
        $Dati["Titolo"] = "Elenco lezioni";
        $Dati["IdNuovaLezione"] = $IdNuovaLezione;
        
        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    } 
}

?>
