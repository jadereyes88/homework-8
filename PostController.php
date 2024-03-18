<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Post; // Ensure correct namespace for the Post model.

class PostController extends Controller
{
    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getAll(); 

        // Load the Twig template for displaying posts.
        $template = $this->twig->load('posts/index.twig');
        echo $template->render(['posts' => $posts, 'success_message' => $_SESSION['success_message'] ?? null]);

        // Clear the message after displaying it
        unset($_SESSION['success_message']);
        
    }


    public function create()
    {
    // Sanitizing input and the validation
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name) || empty($description)) {
        // setting a 400 response code and output an error
        http_response_code(400);
        echo "Both name and description are required.";
        return;
    }

    // Create a new post using the sanitized data
    $postModel = new Post();
    $result = $postModel->save(['name' => $name, 'description' => $description]);

    if ($result) {
        // Set success message
        $_SESSION['success_message'] = "Post created successfully!";
        
        // Redirect back to the posts page
        header("Location: /posts");
        exit;
    } else {
        // Handles failure (e.g., unable to save the post)
        http_response_code(500);
        echo "Failed to create the post.";
    }
    }
}
