<?php

namespace App\Controllers;

use App\Models\User;

class PageController extends Controller
{
    public function home()
    {
        require __DIR__ . "/../Views/home.php";
    }

    public function about()
    {
        require __DIR__ . "/../Views/about.php";
    }

    public function contact()
    {
        require __DIR__ . "/../Views/contact.php";
    }

    public function dashboard()
    {
        if (!User::loggedIn())
        {
            header("Location: /login");
            exit;
        }

        if (!in_array("admin", $_SESSION["user_roles"]))
        {
            header("Location: /account");
            exit;
        }

        require __DIR__ . "/../Views/dashboard.php";
    }
}