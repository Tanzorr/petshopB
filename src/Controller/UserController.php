<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;


/**
 * @Route("/api/petshop", name="petshop")
 */


class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($users);

    }

    /**
     * @Route ("/get_auth_user", name="get_auth_user")
     */


    public function getUser(): ?User
    {
        $currentUser = $this->container->get('security.context')->getToken()->getUser();
    }
}
