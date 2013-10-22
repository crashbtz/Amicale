<?php
namespace Amicale\UserBundle\Component\Authentication\Handler;
 
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
 
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
 
    protected $router;
    protected $security;
 
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }
 
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            $result = array('success' => true);
            return new Response('success');
        } else {
            // Handle non XmlHttp request here
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            $result = array('success' => false);
            return new Response('fails');
        } else {
            // Handle non XmlHttp request here
        }
    }
 
}	