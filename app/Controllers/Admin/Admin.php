<?php

namespace App\Controllers\Admin;

class Admin extends \App\Controllers\BaseController
{
    public function index()
    {
        
        $data['Titolo'] = TitoloMenuAmministrazione;

        return view('templates/header_admin', $data)
            . view('admin/admin_page')
            . view('templates/footer'); 
    }
}
