<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Photo;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    
		// Un peu de SQL
		// $em = $this -> getDoctrine() -> getManager();
		// $query = $em -> createQuery("SELECT DISTINCT p.categorie FROM App\Entity\Produit p");
		// $categories = $query -> getResult();

    /**
     * 
     * @Route("/poi/{id}", name="poi")
     */
    public function photoAction($id){

        $em = $this -> getDoctrine() -> getManager();
		$query = $em -> createQuery("SELECT photo.photo FROM photo, poi WHERE photo.id_poi = poi.id");
		$photo = $query -> getResult();

        //SELECT photo.photo FROM photo, poi WHERE photo.id_poi = poi.id

    $params = array(
        'photo' => $photo,
    );
        
        return $this->render('Poi/poi.html.twig', $params);
	}
    
    /**
     * @Route("/register", name="register)
     */
	public function photoRegisterAction(Request $request){
        $photo = new Photo;
        $form = $this -> createForm(PhotoType::class, $photo);

        if($request -> isMethod('POST') && $form -> handleRequest($request) -> isValid()){

            $photo -> chargementPhoto();

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($photo);
            $em -> flush();
        }

        $formView = $form -> createView();
        $params = array(
            'photoForm' => $formView,
        );

        return $this->render('Poi/form.html.twig', $params);
    }
}
