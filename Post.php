<?php

namespace app\models;

class Post {
    private $posts = [
        ['id' => 1, 'name' => 'Post One', 'description' => 'Content for post one.'],
        ['id' => 2, 'name' => 'Post Two', 'description' => 'Content for post two.'],
        ['id' => 3, 'name' => 'Post Three', 'description' => 'Content for post three.'],
    ];

    public function getAll() {
        return $this->posts;
    }

    // Method to add a new post
    public function save($postData) {
        $newId = count($this->posts) + 1; // ID assignment
        $postData['id'] = $newId;
        $this->posts[] = $postData; 
        return true; // Indicates success
    }
}
