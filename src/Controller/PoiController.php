<?php
namespace App\Controller;
use App\Entity\Poi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PoiType;
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
            'categories' => $categories
        );
       return $this->render('Poi/terra.html.twig', $params);
    }
    /**
     * www.monsite.com
     * www.monsite.com/terra/
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
            "categories" => $categories
        );
        return $this->render('Poi/terra.html.twig', $params);
    }
    /**
    * 
    * @Route("/poi/{id}", name="poi")
    * 
    */
    public function poiAction($id)
    {
        $em = $this -> getDoctrine() -> getManager();
        $poi = $em -> find(Poi::class, $id);
        if(!is_null($poi)){
            $params = array(
                'poi'=>$poi                
            );
            return $this -> render('Poi/poi.html.twig', $params);
        }
        else{
            return new Response('Le point d\'intérêt n\'existe pas !');
        }
    }
    /**
    * @Route("/register", name="register")
    * 
    */
 public function registerPoiAction(Request $request){
        $poi = new Poi;
        $form = $this -> createForm(PoiType::class, $poi);

        if($request -> isMethod('POST') && $form -> handleRequest($request) -> isValid()){
            $poi -> chargementPhoto();

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($poi);
            $em -> flush();

            $request -> getSession() -> getFlashBag() -> add('succes', 'Le point d\'intérêt a bien été enregistré !');
            return $this -> redirectToRoute('register');
        }
    $formView = $form -> createView();
    $params = array('poiForm' => $formView, 'title' => 'Ajout de Point d \'intérêt');
    return $this -> render ('Poi/form.html.twig', $params);
    }
    /**
     * 
     * @Route("/update/{id}")
     * 
     */
    public function updateAction($id){
        $em = $this -> getDoctrine() -> getManager();
        $poi = $em -> find(Poi::class, $id);
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