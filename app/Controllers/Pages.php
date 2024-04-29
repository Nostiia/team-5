<?php
namespace App\Controllers;

class Pages extends BaseController
{
    public function getIndex()
    {
        return view("welcome_message");
    }
    public function getView($page = "home")
    {
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        // Load musician data
        $musicianModel = new \App\Models\UserModel();
        $musicians = $musicianModel->findAll();

        foreach ($musicians as &$musician) {
            if (isset($musician->image)) {
                $musician->image = $this->constructImageDataURI($musician->image);
            }
        }

        $data['title'] = ucfirst($page);
        $data['musicians'] = $musicians;

        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/" . $page, $data);
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