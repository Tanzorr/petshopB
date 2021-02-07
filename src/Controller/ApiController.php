<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;


class ApiController extends AbstractController
{

    private $security;

    public function __construct(Security  $security)
    {
        $this->security = $security;

    }

    public function getUser()
    {
        return parent::getUser(); // TODO: Change the autogenerated stub
    }

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $content = json_decode($request->getContent());
        $email = $content->email;
        $password = $content->password;
        $name = $content->name;
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setUsername($name);
        $user->setRoles(['ROLES_USER']);
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User is successfylly created', $user->getUsername()));
    }



    public function api()
    {




    }

    /**
     * @Route("/is_login", name="is_login")
     */

    public function isLogin( Request $request, Security  $security)
    {

        dd($this->security->getToken()->getUser());


        if ($lastUsername){
            return new Response(sprintf('Logged in as ', $lastUsername));
        }
        return new Response($error);

    }
}

