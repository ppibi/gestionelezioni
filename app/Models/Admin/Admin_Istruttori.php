<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Admin_Istruttori extends Model
{
    protected $table = "istruttori";

    protected $allowedFields = ["IdIstruttore ", "Istruttore", "UsernameIstruttore", "PasswordIstruttore", "Note"];
    
    public function ritornaIstruttori ($Istruttore = false)
    {
        if ($Istruttore === false) {
            return $this->findAll();
        }

        return $this->where(["Istruttore" => $Istruttore])->first();
    }
    
}

?>
