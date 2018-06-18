<?php

namespace App\Controller;

use App\Entity\Poi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PoiController extends Controller
{
    /**
     * www.monsite.com
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $repository = $this -> getDoctrine() -> getRepository(Poi::class);
        $pois = $repository -> findAll();

        
        // Un peu de SQL :)
        $em = $this -> getDoctrine() -> getManager();
        $query = $em -> createQuery("SELECT DISTINCT p.categorie FROM App\Entity\Poi p");
        $categories = $query -> getResult();
        
        
        $params = array(
            'pois' => $pois,
            'categories' => $categories,
            'Lieu' => 'Lieu'
        );

       return $this->render('Poi/terra.html.twig', $params);
    }

    /**
     * www.monsite.com/terra/lieu
     * @Route("/terra/{categorie}", name="terra")
     */
    public function terraAction($categorie)
    {
        $repository =$this -> getDoctrine() -> getRepository(Poi::class);
        $pois = $repository -> findBy(['categorie'=>$categorie]);

        
        // un peu de SQL
        $em = $this -> getDoctrine() -> getManager();
        $query = $em -> createQuery(" SELECT DISTINCT p.categorie FROM TerraBundle\Entity\Poi p");
        $categories = $query -> getResult();
        

        $params = array(
            "pois" => $pois,
            "categories" => $categories,
            "lieu" => 'Pois : ' . $categorie
        );


        return $this->render('Poi/terra.html.twig', $params);
    }
                        

    /**
    * www.terra.dev/poi/5
    * @Route("/poi/{id}", name="poi")
    * 
    */
    public function poiAction($id)
    {
        $em = $this -> getDoctrine() -> getManager();
        $poi = $em -> find(Poi::class, $id);

        if(!is_null($poi)){
            $params = array(
                'poi'=>$poi,
                'lieu' => $poi->getLieu()
            );
            return $this -> render('Poi/poi.html.twig', $params);
        }
        else{
            return new Response('Le point d\'intérêt n\'existe pas !');
        }
    
    }

    /**
    * @Route("/register")
    * 
    */

 public function registerPoiAction()
    {
        $poi = new Poi;
        $poi 
            -> setPoi('poitest')
            -> setLieu('Lac de Mingchi')
            -> setDescription('Yilan est une ville de Taïwan, capitale du comté de Yilan.')
            -> setPhoto('photo.jpg')
            -> setCategorie('rouge')
            -> setAdresse('No.1, Mingchishanzhuang, canton de Datong, comté de Yilan Taiwan, R.O.C.
            ')
            -> setVille('Yilan city')
            -> setRegion('Yilan')
            -> setPays('Taïwan');

        // On récupère l'entityManager
        $em = $this -> getDoctrine() -> getManager();

        // On prépare l'insertion des BDD : On l'enregistreraen BDD au prochain appel de la fonction flush().
        $em -> persist($poi);

        // On enregistre !!
        $em -> flush();

        return new Response("OK pour l'enregistrement");
    }

    /**
     * 
     * @Route("/update/{id}")
     * 
     */
    public function updateAction($id){
        $em = $this -> getDoctrine() -> getManager();

        $poi = $em -> find(Poi::class, $id);
        $poi -> setLieu('Yilan');

        $em -> flush();

        return new Response("OK pour la modification");
        //url à tester : localhost:8000/update/2
    }

    /**
     * @Route("/delete/{id}")
     * 
     */
    public function deletePoiAction($id){
        $em = $this -> getDoctrine() -> getManager();
        $poi = $em -> find(Poi::class, $id);

        $em -> remove($poi);
        $em -> flush();

        return new Response("Ok pour la suppression");
        //url à tester : localhost:8000/delete/5
    }

}