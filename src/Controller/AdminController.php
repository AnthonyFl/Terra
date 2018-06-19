<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Poi;
use App\Entity\Membre;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MembreType;
use App\Form\PoiType;

class AdminController extends Controller
{

    // Point d'intérêt (Poi)

    /**
     * @Route("/admin/poi/show", name="adminPoi")
     */
    public function showPoiAction(){
        $poi = $this -> getDoctrine() -> getRepository(Poi::class) -> findAll();

        $params = array(
            'poi' => $poi,
            'title' => "Gestion des Points d'intérêt"
        );

        return $this->render('admin/poi/show.html.twig', $params);
    }

    /**
     * @Route("/admin/poi/delete/{id}", name="deletePoi")
     */
    public function deletePoiAction($id, Request $request){
        $em = $this -> getDoctrine() -> getManager();
		$poi = $em -> find(Poi::class, $id);
		$em -> remove($poi);
        $em -> flush();
        $session = $request -> getSession();
        $session -> getFlashBag() -> add('success', 'Le point d\'intérêt n°' . $id . ' à bien été supprimé');
        return $this->redirectToRoute('adminPoi');
    }

    /**
     * @Route("/admin/poi/create", name="createPoi")
     */
    public function createPoiAction(Request $request){
        $poi = new Poi;
        $form = $this -> createForm(PoiType::class, $poi);

        if($request -> isMethod('POST') && $form -> handleRequest($request) -> isValid()){
            // A partir de là on dit que le formulaire hydrate l'objet Produit... Sauf qu'il n'y à pas de champs photo dans mon formulaire...
            $poi -> chargementPhoto();

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($poi);
            $em -> flush();

            $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez ajouter le point d\'intérêt : ' . $poi -> getPoi());
            return $this -> redirectToRoute('adminPoi');
        }

        $formView = $form -> createView();
        $params = array(
            'poiForm' => $formView,
            'title' => "Ajout de point d'intérêt"
        );

        return $this->render('admin/poi/create.html.twig', $params);
    }

    /**
     * @Route("/admin/poi/update/{id}", name="updatePoi")
     */
    public function updatePoiAction($id, Request $request){
        $poi = $this -> getDoctrine() -> getManager() -> find(Poi::class, $id);
        
        $form = $this -> createForm(PoiType::class, $poi);

        if($request -> isMethod('POST')){
            $form -> handleRequest($request); // A partir de MAINTENANT notre objet $membre contient les infos postées dans le formulaire == HYDRATATION

            if($form -> isValid()){
                $poi -> chargementPhoto();
                $em = $this -> getDoctrine() -> getManager();
                $em -> persist($poi);
                $em -> flush();

                $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez modifier le point d\'intérêt : ' . $poi -> getPoi());
                return $this -> redirectToRoute('adminPoi');
            }
        }

        $formView = $form -> createView();

        $params = array(
            'poiForm' => $formView,
            'title' => "Modification du point d'intérêt"
        );


        return $this->render('admin/poi/create.html.twig', $params);
    }

    // ======================= MEMBRES ============================

    /**
     * @Route("/admin/membres/show", name="adminMembre")
     */
    public function showMembresAction(){
        $membres = $this -> getDoctrine() -> getRepository(Membre::class) -> findAll();

        $params = array(
            'membres' => $membres,
            'title' => "Gestion des membres"
        );

        return $this->render('admin/membre/show.html.twig', $params);
    }

    /**
     * @Route("/admin/membres/delete/{id}", name="deleteMembre")
     */
    public function deleteMembresAction($id, Request $request){
        $em = $this -> getDoctrine() -> getManager();
		$membre = $em -> find(Membre::class, $id);
		$em -> remove($membre);
        $em -> flush();
        $session = $request -> getSession();
        $session -> getFlashBag() -> add('success', 'Le membre n°' . $id . ' à bien été supprimé');
        return $this->redirectToRoute('adminMembre');
    }

    /**
     * @Route("/admin/membres/create", name="createMembre")
     */
    public function createMembresAction(Request $request){
        $membre = new Membre;
       
        // Version longue : $form = $this -> get(form.factory) -> create(MembreType::class, $membre);

        // Version raccourcie : $form = $this -> createForm(MembreType::class, $membre);
        $form = $this -> createForm(MembreType::class, $membre);

        if($request -> isMethod('POST')){
            $form -> handleRequest($request); // A partir de MAINTENANT notre objet $membre contient les infos postées dans le formulaire == HYDRATATION

            if($form -> isValid()){
                $em = $this -> getDoctrine() -> getManager();
                $em -> persist($membre);
                $em -> flush();

                $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez ajouter le membre : ' . $membre -> getUsername());
                return $this -> redirectToRoute('adminMembre');
            }
        }

        $formView = $form -> createView();
        $params = array(
            'membreForm' => $formView,
            'title' => "Ajout de membre"
        );

        return $this->render('admin/membre/create.html.twig', $params);
    }

    /**
     * @Route("/admin/membres/update/{id}", name="updateMembre")
     */
    public function updateMembresAction($id, Request $request){
        $em = $this -> getDoctrine() -> getManager();
        $membre = $em -> find(Membre::class, $id);
        
        $form = $this -> createForm(MembreType::class, $membre);

        if($request -> isMethod('POST')){
            $form -> handleRequest($request); // A partir de MAINTENANT notre objet $membre contient les infos postées dans le formulaire == HYDRATATION

            if($form -> isValid()){
                $em = $this -> getDoctrine() -> getManager();
                $em -> persist($membre);
                $em -> flush();

                $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez modifier le membre : ' . $membre -> getUsername());
                return $this -> redirectToRoute('adminMembre');
            }
        }

        $formView = $form -> createView();

        $params = array(
            'membreForm' => $formView,
            'title' => "Modification du membre"
        );

        return $this->render('admin/membre/create.html.twig', $params);
    }

}