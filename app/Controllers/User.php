<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    protected $helpers = ['url', 'form'];

    public function home()
    {
        $musicianModel = new \App\Models\UserModel();
        $musicians = $musicianModel->findAll();

        $data['musicians'] = $musicians;
        $data['content'] = view('pages/home', $data);

        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/home", $data);
        echo view("templates/footer", $data);
    }

    public function getLogin()
    {
        $data['content'] = view('pages/login');
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/login", $data);
        echo view("templates/footer", $data);
    }
    public function getUser_ok()
    {
        $userId = session()->user->id;

        // Load the UserModel
        $userModel = new \App\Models\UserModel();

        // Retrieve the user by ID
        $user = $userModel->find($userId);

        // Check if the user and image exist
        if ($user && isset($user->image)) {
            // Construct the image data URI
            $imageData = base64_encode($user->image);
            $imageMimeType = 'image/jpeg'; // Change this to match your image MIME type if needed
            $image = 'data:' . $imageMimeType . ';base64,' . $imageData;
        } else {
            // If user or image not found, set a placeholder image
            $image = ''; // Set a default image path or leave it empty
        }

        // Pass data to the view
        $data['content'] = view('user/user_ok', [
            'name' => session()->user->name,
            'description' => session()->user->description,
            'image' => $image
        ]);

        // Load views
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("user/user_ok", $data);
        echo view("templates/footer", $data);
    }


    public function postLogin()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $rules = [
            "email" => [
                "label" => "email",
                "rules" => "required"
            ],
            "password" => [
                "label" => "password",
                "rules" => "required"
            ]
        ];
        $data = [];
        $session = session();
        if ($this->validate($rules)) {
            $email = $request->getVar('email');
            $password = $request->getVar('password');
            $user = model('UserModel')->authenticate($email, $password);
            if ($user) {
                $session->set('logged_in', TRUE);
                $session->set('user', $user);
                return redirect()->to(base_url('user/user_ok'));
            } else {
                $session->setFlashdata('msg', 'Wrong credentials');
            }
        } else {
            $data["errors"] = $validation->getErrors();
        }
        $data['content'] = view('pages/login', $data);
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/login", $data);
        echo view("templates/footer", $data);
    }

    public function getLogout()
    {
        session()->destroy();
        return redirect()->to(base_url('pages/login'));
    }

    public function getSignup()
    {
        $data['content'] = view('pages/signup');
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/signup", $data);
        echo view("templates/footer", $data);
    }

    public function postSignup()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $rules = [
            "name" => "required",
            "email" => "required|valid_email|is_unique[user.email]",
            "password" => "required|min_length[6]",
            // Add more validation rules as needed
        ];

        if ($this->validate($rules)) {
            // Get form input data
            $data = [
                'name' => $request->getVar('name'),
                'email' => $request->getVar('email'),
                'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
                'description' => $request->getVar('description'),

            ];

            // Handle file upload
            $file = $request->getFile('userfile');
            if ($file->isValid() && !$file->hasMoved()) {
                $imageData = file_get_contents($file->getTempName()); // Read file contents
                $data['image'] = $imageData;
            }

            // Insert user data into the database
            $userModel = new \App\Models\UserModel();
            $userModel->insert($data);

            // Redirect to a success page or login page
            return redirect()->to(base_url('user/login'));
        } else {
            // If validation fails, return to sign-up form with errors
            $data["errors"] = $validation->getErrors();
            $data['content'] = view('pages/signup', $data);
            echo view("templates/header", $data);
            echo view("templates/navbar", $data);
            echo view("pages/signup", $data);
            echo view("templates/footer", $data);
        }
    }

    public function getEdit()
    {
        $userId = session()->user->id;

        // Load the UserModel
        $userModel = new \App\Models\UserModel();

        // Retrieve the user by ID
        $user = $userModel->find($userId);

        if ($user && isset($user->image)) {
            // Construct the image data URI
            $imageData = base64_encode($user->image);
            $imageMimeType = 'image/jpeg'; // Change this to match your image MIME type if needed
            $image = 'data:' . $imageMimeType . ';base64,' . $imageData;
        } else {
            // If user or image not found, set a placeholder image
            $image = ''; // Set a default image path or leave it empty
        }

        $data['content'] = view('user/user_ok', [
            'name' => session()->user->name,
            'description' => session()->user->description,
            'email' => session()->user->email,
            'image' => $image
        ]);

        $data['content'] = view('user/edit');
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("user/edit", $data);
        echo view("templates/footer", $data);
    }
    public function postEdit()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $rules = [
            "name" => "required",
            "email" => "required|valid_email",
            "password" => "min_length[6]", // optional: only validate if password is provided
            // Add more validation rules as needed
        ];

        if ($this->validate($rules)) {
            // Get form input data
            $data = [
                'name' => $request->getVar('name'),
                'email' => $request->getVar('email'),
                'description' => $request->getVar('description'),
            ];

            // Handle file upload
            $file = $request->getFile('userfile');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // New file is uploaded, process it
                $imageData = file_get_contents($file->getTempName()); // Read file contents
                $data['image'] = $imageData;
            } else {
                // No new file uploaded, retain the existing photo
                $userId = session()->user->id;
                $userModel = new \App\Models\UserModel();
                $user = $userModel->find($userId);
                $data['image'] = $user->image; // Retain the existing photo
            }

            // Get the user ID from session or however you manage it
            $userId = session()->user->id;

            // Fetch existing user data from the database
            $userModel = new \App\Models\UserModel();
            $existingUserData = $userModel->find($userId);

            // Compare form input data with existing user data
            $dataToUpdate = [];
            foreach ($data as $key => $value) {
                // Only update if the form input value is different from the existing user data
                if ($existingUserData->$key !== $value) {
                    $dataToUpdate[$key] = $value;
                }
            }

            // Update user data in the database if changes are detected
            if (!empty($dataToUpdate)) {
                $userModel->update($userId, $dataToUpdate);
            }

            // Redirect to a success page or profile page
            return redirect()->to(base_url('user/user_ok'));
        } else {
            // If validation fails, return to edit form with errors
            $data["errors"] = $validation->getErrors();
            $data['content'] = view('user/edit', $data);
            echo view("templates/header", $data);
            echo view("templates/navbar", $data);
            echo view("user/edit", $data);
            echo view("templates/footer", $data);
        }
    }
}