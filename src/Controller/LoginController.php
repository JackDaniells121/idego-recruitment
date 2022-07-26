<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    protected $session;

    public function __construct( RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/start', name: 'start')]
    public function index(): Response
    {
        $logged = $this->session->get('logged');

        if ($logged == "true") {
            $email = $this->session->get('email');
            return $this->render('login/home.html.twig', [
                'email' => $email,
            ]);
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);

    }

    #[Route('/login', name: 'login')]
    public function login( Request $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if ($email) {
            $this->session->set('email', $email);

            // TODO: check hardcoded email
        }
        else {
            return $this->redirectToRoute('start');
        }
        return $this->render('login/otp.html.twig');
    }

    #[Route('/otp', name: 'otp')]
    public function otp( Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $email = $this->session->get('email');
        $otp = $request->get('otp');

        if ($email && $otp == '111111') {
            $this->session->set('logged', 'true');
        }

        return $this->redirectToRoute('start');
    }

    #[Route('/logout', name: 'logout')]
    public function logout( Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $this->session->set('logged', 'false');
        $this->session->set('email', '');

        return $this->redirectToRoute('start');
    }
}
