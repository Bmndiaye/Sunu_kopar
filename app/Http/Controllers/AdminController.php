<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Afficher le tableau de bord admin
    public function index()
    {
        return view('admin.dashboard');
    }

    public function userList()
    {
        return view('admin.user-list');
    }
    public function tontineList()
    {
        return view('admin.tontine-list');
    }

    public function detailTontine()
    {
        return view('admin.detailTontine');
    }
    




    
}
