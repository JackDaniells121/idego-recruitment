<?php

namespace App\Controller;

use App\Model\UserCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    protected \Symfony\Component\HttpFoundation\Session\SessionInterface $session;
    protected string $otp = '111111';

    public function __construct(
        RequestStack $requestStack,
        protected $userCollection = new UserCollection()
    )
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
            'error' => $this->session->get('error'),
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login( Request $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if ($email && $password) {

            $user = $this->userCollection->findUser($email, $password);

            if ($user) {

                $this->session->set('email', $email);

                if ($user->otpEnabled()) {

                    return $this->render('login/otp.html.twig');
                }
                else {
                    $this->session->set('logged', 'true');
                }
            }
            else {
                // not found in users collection
                $this->session->set('error', 'Incorrect email or password');
            }
        }
        else {
            $this->session->set('error', 'Incorrect email or password');
        }
        return $this->redirectToRoute('start');
    }

    #[Route('/otp', name: 'otp')]
    public function otp( Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $email = $this->session->get('email');
        $otp = $request->get('otp');

        if ($email && $otp == $this->otp) {
            $this->session->set('logged', 'true');
        }

        $this->session->set('error', 'Incorrect One Time Password');

        return $this->redirectToRoute('start');
    }

    #[Route('/logout', name: 'logout')]
    public function logout( Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $this->session->set('logged', 'false');
        $this->session->set('email', '');

        $this->session->set('error', 'You have been logged out');

        return $this->redirectToRoute('start');
    }
}
