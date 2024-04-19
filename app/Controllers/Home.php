<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        // Fetch musician data from the database
        $musicianModel = new UserModel();
        $musicians = $musicianModel->findAll();

        // Pass musician data to the view
        $data['musicians'] = $musicians;

        // Load the main page view with musician data
        return view('pages/home', $data);
    }
}
