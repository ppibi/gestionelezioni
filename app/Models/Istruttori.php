<?php

namespace App\Models;

use CodeIgniter\Model;

class Istruttori extends Model
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
