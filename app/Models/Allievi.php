<?php

namespace App\Models;

use CodeIgniter\Model;

class Allievi extends Model
{
    
    public function ritornaTesseratiOPES () {
        $Database = \Config\Database::connect("gestionale");        
        $QueryBuilder = $Database->table('anagrafica');
        $QueryBuilder->select ("Id_anagrafica AS IdTesserato, Cognome, Nome, CONCAT(Cognome,' ',Nome) AS Tesserato, CONCAT(Nome,' ',Cognome) AS TesseratoNomeCognome");
        $QueryBuilder->join("tesseramenti", "tesseramenti.Tesserato = anagrafica.Id_anagrafica");
        $QueryBuilder->where("tesseramenti.Affiliazione", "OPES");
        $QueryBuilder->where("Rinnovato", FALSE);
        $QueryBuilder->where("tesseramenti.Data_scadenza >= NOW()");
        $QueryBuilder->orderBy ("TesseratoNomeCognome");
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoTesseratiOPES = $RisultatoQuery->getResultArray();

        return $ElencoTesseratiOPES;
       
    }
    
    public function ritornaTesseratiOPESnonRegistrati ($IdLezione) {
        $ModelloPresenze = new \App\Models\Presenze;
        
        $ElencoTesseratiOPES = $this->ritornaTesseratiOPES ();
        $NProgTesserato = 0;
        foreach ($ElencoTesseratiOPES as $TesseratoOPES) :
            if (! $ModelloPresenze->verificaPresenzaTesseratoinTipoLezione ($TesseratoOPES["IdTesserato"], $IdLezione)) :
                $ElencoTesserati[$NProgTesserato]["IdTesserato"] = $TesseratoOPES["IdTesserato"];
                $ElencoTesserati[$NProgTesserato]["Cognome"] = $TesseratoOPES["Cognome"];
                $ElencoTesserati[$NProgTesserato]["Nome"] = $TesseratoOPES["Nome"];
                $ElencoTesserati[$NProgTesserato]["Tesserato"] = $TesseratoOPES["Tesserato"];
                $ElencoTesserati[$NProgTesserato]["TesseratoNomeCognome"] = $TesseratoOPES["TesseratoNomeCognome"];
                $NProgTesserato++;
            endif;
        endforeach;
        return $ElencoTesserati;
       
    }
    
    public function ritornaDatiTesserato ($IdTesserato = false) {
        $Database = \Config\Database::connect("gestionale");        
        $QueryBuilder = $Database->table('anagrafica');
        $QueryBuilder->select ("Id_anagrafica, Cognome, Nome, CONCAT(Cognome,' ',Nome) AS Tesserato, CONCAT(Nome,' ',Cognome) AS TesseratoNomeCognome");
        $QueryBuilder->where("Id_anagrafica", $IdTesserato);
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $DatiTesserato = $RisultatoQuery->getRowArray();

        return $DatiTesserato;
       
    }
    
}

?>
