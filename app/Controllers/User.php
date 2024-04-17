<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class User extends Controller
{
    protected $helpers = ['url', 'form'];
    public function getAdmin_list()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user/list', $data);
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("user/list", $data);
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
        $data['content'] = view('user/user_ok', ['name'=> session()->user->name]);
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
            if ($file->isValid() && ! $file->hasMoved()) {
                $imageData = file_get_contents($file->getTempName()); // Read file contents
                $data['image'] = base64_encode($imageData); // Convert to base64 and store in database
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
}