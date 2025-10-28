<?php

namespace App\Http\Controllers;
use Barryvdh\Debugbar\Facades\Debugbar;


abstract class Controller
{
   

public function index()
{
    Debugbar::info('Halo King! Debugbar aktif nih 😎');
    Debugbar::warning('Ini peringatan!');
    Debugbar::error('Ada error nih!');
    Debugbar::addMessage('Pesan custom kamu di debug bar.');

    return view('index');
}

}
