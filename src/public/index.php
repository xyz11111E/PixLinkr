<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$router = new Router();

// --- Specify Routes Here ---
$router->get("/", "home@PageController");
$router->get("/about", "about@PageController");
$router->get("/contact", "contact@PageController");

$router->get("/dashboard", "dashboard@PageController");

$router->get("/login", "login@AuthController");
$router->get("/register", "register@AuthController");
$router->get("/account", "account@AuthController");

$router->get("/users", "all@UserController");
$router->get("/user", "getById@UserController");

$router->get("/set-lang", "setLang@LangController");

$router->post("/login", "loginPost@AuthController");
$router->post("/register", "registerPost@AuthController");
$router->post("/logout", "logoutPost@AuthController");

$router->post("/add-user-role", "addRolePost@UserController");
$router->post("/del-user-role", "delRolePost@UserController");

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);