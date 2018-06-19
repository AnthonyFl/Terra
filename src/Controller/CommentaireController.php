<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireType;


class CommentaireController extends Controller
{
/**
     * @Route("/comment/create", name="createComment")
     */
    public function createCommentAction(Request $request){
        $comment = new Commentaire;
        $form = $this -> createForm(CommentaireType::class, $comment);

        if($request -> isMethod('POST') && $form -> handleRequest($request) -> isValid()){
            
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($comment);
            $em -> flush();

            $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez ajouter un commentaire');
            return $this -> redirectToRoute('createComment');
        }

        $formView = $form -> createView();
        $params = array(
            'commentForm' => $formView,
            'title' => "Ajout de commentaire"
        );

        return $this->render('commentcreate.html.twig', $params);
    }
}