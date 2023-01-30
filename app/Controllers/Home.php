<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        $data['Titolo'] = "La Secca - Gestione Lezioni";

        return view('templates/header', $data)
            . view('prima_pagina')
            . view('templates/footer'); 
    }
}
