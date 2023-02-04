<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Utenti;
use CodeIgniter\Shield\Entities\User;

class Admin_GestioneUtenti extends \App\Controllers\BaseController
{
    public function index()
    {
        $Modello = new Admin_Utenti();

        $Dati = [
            "ElencoUtenti"  => $Modello->ritornaUtenti(),
            "Titolo" => "Elenco Utenti",
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/utenti/elencoutenti")
            . view("templates/footer");
    }

    public function view ( $Utente = null )
    {
        $Modello = new Admin_Utenti();

        $Dati["Utente"] = $Modello->ritornaUtenti($Utente);
        
        if (empty($Dati["Utente"])) {
            throw new PageNotFoundException("Non trovo l'utente: " . $Utente);
        }

        $Dati["Titolo"] = "Visualizzazione utente";

        return view("templates/header_admin", $Dati)
            . view("admin/utenti/visualizzautente")
            . view("templates/footer");
    }
    
    public function nuovoutente()
    {
        helper("form");

        $Modello = new Admin_Utenti();

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) {
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo utente"])
                . view("admin/utenti/nuovoutente")
                . view("templates/footer");
        }

        $post = $this->request->getPost(["Username", "Email", "Gruppo", "Password"]);

        // Verifica se i dati sono validati
        if (! $this->validateData($post, [
            "Username"  => "required|max_length[20]|min_length[5]",
            "Email"  => "required|valid_email",
            "Password"  => "required|max_length[30]|min_length[5]",
        ])) {
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo utente"])
                . view("admin/utenti/nuovoutente")
                . view("templates/footer");
        }

        $Utente = new User([
            'username' => $post["Username"],
            'email'    => $post["Email"],
            'password' => $post["Password"],
        ]);
        $Utenti = model('UserModel');
        $Utenti->save($Utente);

/*        // To get the complete user object with ID, we need to get from the database
        $IdNuovoUtente = $Utenti->getInsertID(); 
        $Utente = $Utenti->findById($Utenti->getInsertID());

        // Add to default group
        $Utenti->addToDefaultGroup($Utente);
*/        
        $Utente = $Utenti->findById($Utenti->getInsertID());
        $Utente->addGroup($post["Gruppo"]);

        $Dati["ElencoUtenti"] = $Modello->ritornaUtenti();
        $Dati["Titolo"] = "Elenco utenti";
        $Dati["NuovoUtente"] = $post["Username"];
        
        return view("templates/header_admin", $Dati)
            . view("admin/utenti/elencoutenti")
            . view("templates/footer");
    } 
}

?>
