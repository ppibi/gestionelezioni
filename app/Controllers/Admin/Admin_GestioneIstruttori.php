<?php

namespace App\Controllers\Admin;

use \App\Models\Admin\Admin_Istruttori;
use CodeIgniter\Shield\Entities\User;

class Admin_GestioneIstruttori extends \App\Controllers\BaseController
{
    public function index()
    {
        $Modello = new Admin_Istruttori();

        $Dati = [
            "ElencoIstruttori"  => $Modello->ritornaIstruttori(),
            "Titolo" => "Elenco Istruttori",
        ];

        return view("templates/header_admin",  $Dati)
            . view("admin/istruttori/elencoistruttori")
            . view("templates/footer");
    }

    public function view ( $Istruttore = null )
    {
        $Modello = new Admin_Istruttori();

        $Dati["Istruttore"] = $Modello->ritornaIstruttori($Istruttore);
        
        if (empty($Dati["Istruttore"])) {
            throw new PageNotFoundException("Non trovo l'istruttore: " . $Istruttore);
        }

        $Dati["Titolo"] = "Visualizzazione istruttore";

        return view("templates/header_admin", $Dati)
            . view("admin/istruttori/visualizzaistruttore")
            . view("templates/footer");
    }
    
    public function nuovoistruttore()
    {
        helper("form");

        // Checks whether the form is submitted.
        if (! $this->request->is("post")) {
            // The form is not submitted, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo istruttore"])
                . view("admin/istruttori/nuovoistruttore")
                . view("templates/footer");
        }

        $post = $this->request->getPost(["Istruttore", "UsernameIstruttore", "EmailIstruttore", "PasswordIstruttore", "Note"]);

        // Verifica se i dati sono validati
        if (! $this->validateData($post, [
            "Istruttore" => "required|max_length[100]|min_length[3]",
            "UsernameIstruttore"  => "required|max_length[20]|min_length[5]",
            "EmailIstruttore"  => "required|valid_email",
            "PasswordIstruttore"  => "required|max_length[30]|min_length[5]",
        ])) {
            // The validation fails, so returns the form.
            return view("templates/header_admin", ["Titolo" => "Inserimento nuovo istruttore"])
                . view("admin/istruttori/nuovoistruttore")
                . view("templates/footer");
        }

        $Modello = model(Admin_Istruttori::class);
        
        $Utenti = model('UserModel');
        $Utente = new User([
            'username' => $post["UsernameIstruttore"],
            'email'    => $post["EmailIstruttore"],
            'password' => $post["PasswordIstruttore"],
        ]);
        $Utenti->save($Utente);

        // To get the complete user object with ID, we need to get from the database
        $IdNuovoUtente = $Utenti->getInsertID();
        $Utente = $Utenti->findById($Utenti->getInsertID());

        // Add to default group
        $Utenti->addToDefaultGroup($Utente);
        
        $DatiNuovoRecord = ([
            "Istruttore" => $post["Istruttore"],
            "IdUser"  => $IdNuovoUtente,
            "Note"  => $post["Note"]
        ]);

        $Modello->save($DatiNuovoRecord);
        $IdNuovoIstruttore = $Modello->getInsertId();

        $Dati["ElencoIstruttori"] = $Modello->ritornaIstruttori();
        $Dati["Titolo"] = "Elenco istruttori";
        $Dati["IdNuovoIstruttore"] = $IdNuovoIstruttore;
        
        return view("templates/header_admin", $Dati)
            . view("admin/istruttori/elencoistruttori")
            . view("templates/footer");
    } 
}

?>
