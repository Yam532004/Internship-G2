<?php
class Users{}
class Comment {}

class Post{
    protected $user;
    protected $comments;

    public function __construct($user, $comments) {
        $this->user = $user;
        $this->comments = $comments;
    }
    public function display (){
        echo "Hello Post";
    }
}

$user = new Users();
$comment = new Comment();
$post = new Post($user, $comment);
$post->display();
?> 
