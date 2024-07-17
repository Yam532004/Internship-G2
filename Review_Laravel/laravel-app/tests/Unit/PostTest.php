<?php
use PHPUnit\Framework\TestCase;

class MockUser extends Users {}

class MockComment extends Comment {}

class PostTest extends TestCase
{
    public function testDisplay()
    {
        $mockUser = new MockUser();
        $mockComment = new MockComment();
        $post = new Post($mockUser, $mockComment);
        $result = $post->display();
        
        $this->assertEquals("Displaying post with user and comment.", $result);
    }
}
