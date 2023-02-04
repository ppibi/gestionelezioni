<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Admin_Utenti extends Model
{
    protected $DBGroup = 'default';
    
    protected $table = "users";

    protected $allowedFields = [
        "IdLezione", 
        "Utenti_IdIstruttore", 
        "Utenti_IdDisciplina", 
        "Utenti_GiornoSettimana", 
        "Utenti_Ora",
        "Utenti_MaxAllievi",
        "Utenti_Attiva"
        ];
    
    public function ritornaUtenti ($Utente = false)
    {
        $Database = \Config\Database::connect();        
        $QueryBuilder = $Database->table('users');
        $QueryBuilder->select ("username, group, secret as email");
        $QueryBuilder->join("auth_groups_users", "auth_groups_users.user_id = users.id");
        $QueryBuilder->join("auth_identities", "auth_identities.user_id = users.id");
        $QueryBuilder->orderBy ("users.username");
        
        if ($Utente !== false) {
            
            $QueryBuilder->where("Utente", $Utente);
        }
        
        $RisultatoQuery = $QueryBuilder->get();
        
        $ElencoUtenti = $RisultatoQuery->getResultArray();
        return $ElencoUtenti;
    } 
    
    public function ritornaGruppiUtenti ()
    {
        $ElencoGruppiUtenti = array (
                array (
                    "gruppo" => "superadmin"
                ),
                array (
                    "gruppo" => "admin"
                ),
                array (
                    "gruppo" => "istruttore"
                ),
            );
        return $ElencoGruppiUtenti;
    } 
    
}

?>
