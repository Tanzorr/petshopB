<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $password_encoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->password_encoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$name, $password, $email, $role ]) {
            $user = new User();
            $user->setUsername($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRoles($role);
            $manager->persist($user);
        }
        $manager->flush();
    }


    private function getUserData():array
    {
        return [
            ['John1', '1234', 'jh@ukr.net', ['ROLE_ADMIN'],]

        ];
    }

}
