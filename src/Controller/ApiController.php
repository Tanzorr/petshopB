<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiController extends AbstractController
{
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

   public function api ()
   {
       return new Response(sprintf('Logged in as ', $this->getUser() , $this->getUser()->getUsername()));
   }
}
