<?php

namespace App\Models;

use CodeIgniter\Model;

class Presenze extends Model {
    protected $table = "presenze_lezioni";

    protected $allowedFields = ["IdPresenzeLezioni", "IdLezione", "IdTesserato", "Data", "Presenza"];
    
    public function ritornaPresenza ($Presenza = false) {
        if ($Presenza === false) :
            return $this->findAll();
        endif;

        return $this->where(["Presenza" => $Presenza])->first();
    }

    public function verificaPresenzaTesseratoinLezione ($IdTesserato, $IdLezione, $GiornoLezione ) {
        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('presenze_lezioni');
        $QueryBuilder->where("IdTesserato", $IdTesserato);
        $QueryBuilder->where("IdLezione", $IdLezione);
        $QueryBuilder->where("Data", date_format (date_create($GiornoLezione), "Y-m-d"));

        $RisultatoQuery = $QueryBuilder->get();

        $DatiPresenzaTesserato = $RisultatoQuery->getRowArray();

        if (empty($DatiPresenzaTesserato)) :
            $TesseratoPresente = 0;
        else:
            $TesseratoPresente = 1;
        endif;
        
        return $TesseratoPresente;
    }

    public function ritornaTesseratiTipoLezione ($IdLezione) {
        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('presenze_lezioni');
        $QueryBuilder->distinct (TRUE);
        $QueryBuilder->select ("IdTesserato");
        $QueryBuilder->where("IdLezione", $IdLezione);
       
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoTesseratiTipoLezione = $RisultatoQuery->getResultArray();
        
        return $ElencoTesseratiTipoLezione;

    }

    public function ritornaTesseratiTipoLezioneNonPresenti ($IdLezione, $GiornoLezione) {
        $ModelloAllievi = new \App\Models\Allievi;

        $ElencoTesseratiNonPresenti = array();
        
        $ElencoTesserati = $this-> ritornaTesseratiTipoLezione ($IdLezione);

        $NProgTesserati = 0;
        foreach ($ElencoTesserati as $Tesserato) :
            if (!$this->verificaPresenzaTesseratoinLezione($Tesserato["IdTesserato"], $IdLezione, $GiornoLezione)) :
                $ElencoTesseratiNonPresenti[$NProgTesserati]["IdTesserato"] = $Tesserato["IdTesserato"];
                $ElencoTesseratiNonPresenti[$NProgTesserati]["Tesserato"] = $ModelloAllievi->ritornaDatiTesserato($Tesserato["IdTesserato"])["Tesserato"];
                $NProgTesserati++;
            endif;
        endforeach;
        
        return $ElencoTesseratiNonPresenti;

    }

    public function ritornaPartecipantiLezione ($IdLezione, $GiornoLezione) {
        $ModelloAllievi = new \App\Models\Allievi;

        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('presenze_lezioni');
        $QueryBuilder->select ('*');
        $QueryBuilder->where("IdLezione", $IdLezione);
        $QueryBuilder->where("Data", date_format (date_create($GiornoLezione), "Y-m-d"));
        $RisultatoQuery = $QueryBuilder->get();
        $ElencoPartecipanti = $RisultatoQuery->getResultArray();

        $ElencoCompletoPartecipanti = array();
        $NProgPartecipanti = 0;
        foreach ($ElencoPartecipanti as $Partecipante) :
            $ElencoCompletoPartecipanti[$NProgPartecipanti]["IdTesserato"] = $Partecipante["IdTesserato"];
            $ElencoCompletoPartecipanti[$NProgPartecipanti]["Tesserato"] = $ModelloAllievi->ritornaDatiTesserato($Partecipante["IdTesserato"])["Tesserato"];
            $NProgPartecipanti++;
        endforeach;
        
        return $ElencoCompletoPartecipanti;

    }

    
}

?>
