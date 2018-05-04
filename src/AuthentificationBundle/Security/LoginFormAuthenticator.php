<?php

namespace AuthentificationBundle\Security;



use AuthentificationBundle\Form\LoginCandidatForm;
use AuthentificationBundle\Form\LoginPersonnelForm;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $formFactory;
    private $em;
    private $router;
    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em, RouterInterface $router,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (array_key_exists('_cin', $credentials)){
            $username = $credentials['_cin'];
            return $this->em->getRepository('AuthentificationBundle:Candidat')
                ->findOneBy(['cin' => $username]);
        }
        if (array_key_exists('_matricule', $credentials)){
            $username = $credentials['_matricule'];
            return $this->em->getRepository('AuthentificationBundle:Personnel')
                ->findOneBy(['matricule' => $username]);
        }

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
       /* if ($password == '0000') {
            return true;
        }*/
        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            return true;
        }
       return false;
    }


    public function getCredentials(Request $request)
    {

        $isLoginPersonnelSubmit = $request->getPathInfo() == '/login_per' && $request->isMethod('POST');
        $isLoginCandidatSubmit = $request->getPathInfo() == '/login_candidat' && $request->isMethod('POST');
        if ((!$isLoginPersonnelSubmit)&&(!$isLoginCandidatSubmit)) {
            return ;
        }
        if($isLoginPersonnelSubmit){
            $form = $this->formFactory->create(LoginPersonnelForm::class);
            $username = 'matricule';
        }

        elseif ($isLoginCandidatSubmit){
            $form = $this->formFactory->create(LoginCandidatForm::class);
            $username = 'cin';
        }

        $form->handleRequest($request);

        $data = $form->getData();
        var_dump($data);
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_'.$username.'']
        );
        return $data;

    }
    protected function getLoginUrl()
    {

        return $this->router->generate('login_candidat');

    }
    use TargetPathTrait;

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // if the user hits a secure page and start() was called, this was
        // the URL they were on, and probably where you want to redirect to
        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);

        if (!$targetPath) {
            $targetPath = $this->router->generate('homepage');
        }
        return new RedirectResponse($targetPath);
    }

    /**
     * Override to change what happens after a bad username/password is submitted.
     *
     * @return RedirectResponse
     */
   public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $credentials = $this->getCredentials($request);
        $url='';
         if ($request->getSession() instanceof SessionInterface) {
            $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        }
        if(array_key_exists('_matricule',$credentials))
        $url = $this->router->generate('login_personnel');
        if(array_key_exists('_cin',$credentials))
            $url = $this->router->generate('login_candidat');
        return new RedirectResponse($url);
    }




}