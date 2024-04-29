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
        foreach ($musicians as &$musician) {
            if (isset($musician->image)) {
                $musician->image = $this->constructImageDataURI($musician->image);
            }
        }

        $data['title'] = ucfirst("home");

        // Pass musician data to the view
        $data['musicians'] = $musicians;

        // Load the main page view with musician data
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/home", $data);
        echo view("templates/footer", $data);
    }
    private function constructImageDataURI($imageData)
    {
        if ($imageData) {
            // Construct the image data URI
            $imageDataURI = 'data:image/jpeg;base64,' . base64_encode($imageData);
            return $imageDataURI;
        } else {
            // If image data is empty, return placeholder image URI or empty string
            return ''; // Set a default image path or leave it empty
        }
    }
}