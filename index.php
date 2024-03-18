<?php
session_start();
require_once '../app/vendor/autoload.php';
require_once "../app/core/Controller.php";
require_once "../app/models/User.php";
require_once "../app/models/Post.php";
require_once "../app/controllers/MainController.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/PostController.php";

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\PostController;

// Parse the URL to get the path for routing
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Initialize controllers
$mainController = new MainController();
$postController = new PostController();

// Switch statement to handle different routes
switch ($url) {
    case "/":
        // Return the homepage view
        $mainController->homepage();
        break;
    case "/posts":
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $postController->index();
        } 
        break;
    case "/posts/create":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postController->create();
        } else {
            // Redirect to a 405 Method Not Allowed error
            http_response_code(405);
            echo "Method Not Allowed";
        }
        break;
    default:
        // Return a 404 view
        $mainController->notFound();
        break;
}
