<?php

namespace App\Models;

use CodeIgniter\Model;

class Allievi extends Model
{
    
    public function ritornaTesseratiOPES () {
        $Database = \Config\Database::connect("gestionale");        
        $QueryBuilder = $Database->table('anagrafica');
        $QueryBuilder->select ("Id_anagrafica, Cognome, Nome, CONCAT(Cognome,' ',Nome) AS Tesserato");
        $QueryBuilder->join("tesseramenti", "tesseramenti.Tesserato = anagrafica.Id_anagrafica");
        $QueryBuilder->where("tesseramenti.Affiliazione", "OPES");
        $QueryBuilder->where("Rinnovato", FALSE);
        $QueryBuilder->where("tesseramenti.Data_scadenza >= NOW()");
        $QueryBuilder->orderBy ("anagrafica.Cognome");
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoTesseratiOPES = $RisultatoQuery->getResultArray();

        return $ElencoTesseratiOPES;
       
    }
    
    public function ritornaDatiTesserato ($IdTesserato = false) {
        $Database = \Config\Database::connect("gestionale");        
        $QueryBuilder = $Database->table('anagrafica');
        $QueryBuilder->select ("Id_anagrafica, Cognome, Nome, CONCAT(Cognome,' ',Nome) AS Tesserato");
        $QueryBuilder->where("Id_anagrafica", $IdTesserato);
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $DatiTesserato = $RisultatoQuery->getRowArray();

        return $DatiTesserato;
       
    }
    
}

?>
