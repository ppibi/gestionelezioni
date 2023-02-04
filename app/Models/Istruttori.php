<?php

namespace App\Models;

use CodeIgniter\Model;

class Istruttori extends Model
{
    protected $table = "istruttori";

    protected $allowedFields = ["IdIstruttore ", "Istruttore", "IdUser", "Note" , "IstruttoreAttivo"];
    
    public function ritornaIstruttori ($IdIstruttore = false)
    {
        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('istruttori');
        $QueryBuilder->select ("*");
        $QueryBuilder->join("users", "users.id = istruttori.IdUser");
        $QueryBuilder->orderBy ("Istruttore");
        
        if ($IdIstruttore !== false) {
            
            $QueryBuilder->where("IdIstruttore", $IdIstruttore);
        }
        $QueryBuilder->where("IstruttoreAttivo", TRUE);
/*        if ($Istruttore === false) {
            return $this->findAll();
        }
*/
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoIstruttori = $RisultatoQuery->getResultArray();
        return $ElencoIstruttori;
       
//        return $this->where(["Istruttore" => $Istruttore])->first();
    }
    
}

?>
