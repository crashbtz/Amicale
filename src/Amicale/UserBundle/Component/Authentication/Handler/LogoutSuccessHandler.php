<?php
namespace Amicale\UserBundle\Component\Authentication\Handler;
 
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
 
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
 
    protected $router;
 
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function onLogoutSuccess(Request $request)
    {
        $response = new RedirectResponse($this->router->generate('amicale_accueil_homepage'));        
        return $response;
    }
 
}	