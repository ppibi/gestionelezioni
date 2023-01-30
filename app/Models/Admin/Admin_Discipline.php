<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Admin_Discipline extends Model
{
    protected $table = "discipline";

    protected $allowedFields = [
        "IdDisciplina", 
        "Disciplina"
        ];
    
    public function ritornaDiscipline ($Disciplina = false)
    {
        if ($Disciplina === false) {
            return $this->findAll();
        }

        return $this->where(["Disciplina" => $Disciplina])->first();
    }
    
}

?>
