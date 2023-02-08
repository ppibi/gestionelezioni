<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Lezioni;

class Admin_GestioneLezioni extends \App\Controllers\BaseController
{
    public function elencolezioni()
    {
        $ModelloLezioni = new Admin_Lezioni();

        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }

    public function tuttelezioni()
    {
        $ModelloLezioni = new Admin_Lezioni();

        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
            "SoloLezioniAttive" => 0
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }

    public function sololezioniattive()
    {
        $ModelloLezioni = new Admin_Lezioni();

        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
            "SoloLezioniAttive" => 1,
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }

    public function visualizzalezione ( $Lezione = null )
    {
        $ModelloLezioni = new Admin_Lezioni();

        $Dati["Lezione"] = $ModelloLezioni->ritornaLezioni($Lezione);
        
        if (empty($Dati["Lezione"])) :
            throw new PageNotFoundException("Non trovo la lezione: " . $Lezione);
        endif;

        $Dati["Titolo"] = TitoloMenuVisualizzaLezione;

        $Dati["SoloLezioniAttive"] = 0;

        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/visualizzalezione")
            . view("templates/footer");
    }
    
    public function modificalezione ( $IdLezione = null )
    {
        $ModelloLezioni = new Admin_Lezioni();

        $Dati["Lezione"] = $ModelloLezioni->ritornaLezioni($Lezione);
        
        if (!empty($Dati["Lezione"])) :
            $Dati["Titolo"] = TitoloMenuModificaLezione;
            return view("templates/header_admin", $Dati)
                . view("admin/lezioni/modificalezione")
                . view("templates/footer");
        else:
        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
        ];
            return view("templates/header_admin", $Dati)
                . view("admin/lezioni/elencolezioni")
                . view("templates/footer");

            
        endif;
    }
    
    public function disattivalezione ( $IdLezione = null )
    {
        $ModelloLezioni = new Admin_Lezioni();

        if ($IdLezione > 0) {
            $Database = \Config\Database::connect();        
            $QueryBuilder = $Database->table("lezioni");
            $QueryBuilder->set("Lezioni_Attiva", 0);
            $QueryBuilder->where("IdLezione", $IdLezione);
            $QueryBuilder->update();
        }

        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
            "SoloLezioniAttive" => 1,
        ];

        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }
    
    public function attivalezione ( $IdLezione = null )
    {
        $ModelloLezioni = new Admin_Lezioni();

        if ($IdLezione > 0) {
            $Database = \Config\Database::connect();        
            $QueryBuilder = $Database->table("lezioni");
            $QueryBuilder->set("Lezioni_Attiva", 1);
            $QueryBuilder->where("IdLezione", $IdLezione);
            $QueryBuilder->update();
        }

        $Dati = [
            "ElencoLezioni"  => $ModelloLezioni->ritornaLezioni(),
            "Titolo" => TitoloMenuElencoLezioni,
            "IdNuovaLezione" => 10000,
            "SoloLezioniAttive" => 0,
        ];

        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    }
    
    public function nuovalezione()
    {
        $ModelloLezioni = new Admin_Lezioni();
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) {
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => TitoloMenuNuovaLezione])
                . view("admin/lezioni/nuovalezione")
                . view("templates/footer");
        }

        $post = $this->request->getPost(["Lezioni_IdIstruttore", "Lezioni_IdDisciplina", "Lezioni_GiornoSettimana", "Lezioni_Ora", "Lezioni_MaxAllievi"]);

        $ModelloLezioni = new Admin_Lezioni();
        
        $DatiNuovoRecord = ([
            "Lezioni_IdIstruttore" => $post["Lezioni_IdIstruttore"],
            "Lezioni_IdDisciplina"  => $post["Lezioni_IdDisciplina"],
            "Lezioni_GiornoSettimana"  => $post["Lezioni_GiornoSettimana"],
            "Lezioni_Ora"  => $post["Lezioni_Ora"],
            "Lezioni_MaxAllievi"  => $post["Lezioni_MaxAllievi"],
            "Lezioni_Attiva"  => 1
        ]);

        if (!$ModelloLezioni->verificaLezioneEsistente ($DatiNuovoRecord)) :
            $ModelloLezioni->save($DatiNuovoRecord);
            $IdNuovaLezione = $ModelloLezioni->getInsertId();
            $Dati["IdNuovaLezione"] = $IdNuovaLezione;
        else:    
            $Dati["IdNuovaLezione"] = 100000;
        endif;

        $Dati["ElencoLezioni"] = $ModelloLezioni->ritornaLezioni();
        $Dati["Titolo"] = TitoloMenuElencoLezioni;
        
        return view("templates/header_admin", $Dati)
            . view("admin/lezioni/elencolezioni")
            . view("templates/footer");
    } 
}

?>
