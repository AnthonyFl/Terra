<?php

namespace App\Controller;

use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\MembreType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    private $passwordEncoder;
 
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $membre = new Membre;
        $membre -> setRole('ROLE_USER');

        $form = $this -> createForm(MembreType::class, $membre);

        if($request -> isMethod('POST')){
            $form -> handleRequest($request); // HYDRATATION
            if($form -> isSubmitted()){
                if($form -> isValid()){
                    $password = $passwordEncoder->encodePassword($membre, $membre->getPassword());
                    $membre->setPassword($password);
                    // $salt = substr(md5(time()), 0, 23); 
                    // $password = $passwordEncoder -> encodePassword($membre, $salt);
                    // $membre -> setPassword($password) -> setSalt($salt);

                    $em = $this -> getDoctrine() -> getManager();
                    $em -> persist($membre);
                    $em -> flush();

                    $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, ' . $membre -> getUsername() . ' vous êtes inscrit');
                    return $this -> redirectToRoute('inscription');
                }
            }
        }

        $formView = $form -> createView();

        $params = array(
            'membreForm' => $formView,
            'title' => 'Formulaire d\'inscription'
        );

        return $this->render('Membre/inscription.html.twig', $params);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(AuthenticationUtils $helper): Response
    {
        return $this->render('connexion.html.twig', [
            // dernier username saisi (si il y en a un)
            'last_username' => $helper->getLastUsername(),
            // La derniere erreur de connexion (si il y en a une)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexionAction(){
        
    }
}