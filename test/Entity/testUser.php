<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\Model\Entity\User;
use PHPUnit\Framework\TestCase;

class testUser extends TestCase
{
    private User $user;
    private string $email = "noah.decroix3@gmail.com";

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function testSetEmail()
    {
        $result = $this->user->setEmail('noah.decroix3@gmail.com');
        $this->assertIsObject($result);
    }

    public function testGetEmail()
    {
        $this->user->setEmail('noah.decroix3@gmail.com');
        $result = $this->user->getEmail();
        $this->assertIsString($result);
    }


}