<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Admin_Lezioni extends Model
{
    protected $DBGroup = 'default';
    
    protected $table = "lezioni";

    protected $allowedFields = [
        "IdLezione", 
        "Lezioni_IdIstruttore", 
        "Lezioni_IdDisciplina", 
        "Lezioni_GiornoSettimana", 
        "Lezioni_Ora",
        "Lezioni_MaxAllievi",
        "Lezioni_Attiva"
        ];
    
/*    public function ritornaLezioni ($Lezione = false)
    {
        if ($Lezione === false) {
            return $this->findAll();
        }

        return $this->where(["Lezione" => $Lezione])->first();
    } */
    
    public function ritornaLezioni ($Lezione = false)
    {
        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('lezioni');
        $QueryBuilder->select ("*");
        $QueryBuilder->join("istruttori", "istruttori.IdIstruttore = lezioni.Lezioni_IdIstruttore");
        $QueryBuilder->join("discipline", "discipline.IdDisciplina = lezioni.Lezioni_IdDisciplina");
        $QueryBuilder->orderBy ("Lezioni_GiornoSettimana");
        
        if ($Lezione !== false) {
            
            $QueryBuilder->where("Lezione", $Lezione);
        }
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoLezioni = $RisultatoQuery->getResultArray();
        return $ElencoLezioni;
    }
    
}

?>
