<?php

namespace App\Controller;

use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MembreType;

class MembreController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profilAction(){
        return $this->render('Membre/profil.html.twig');
    }
}