<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    // Pas d'annotation car on ne veut pas le mapper
    private $file;

    /**
     * @var int
     *
     * @ORM\Column(name="id_poi", type="integer")
     *
     */
    private $id_poi;

         /**
     * Set id
     * 
     * @param int $id
     * 
     * @return Photo
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    // Getter et Setter de File de notre objet Photo uploadé
    public function getFile(){
        return $this->file;
    }

    public function setFile(UploadedFile $file = NULL){
        $this -> file = $file;

        return $this;
    }

    public function chargementPhoto(){
        if(!$this -> file){
            return;
        }

        $nom_photo = $this -> file -> getClientOriginalName(); // On récupère le nom original de la photo ($_FILES['photo']['name'])

        $new_nom_photo = $this -> renameFile($nom_photo);

        $this -> photo = $new_nom_photo;

        $this -> file -> move($this -> photoDir(), $new_nom_photo); //photoDir() est notre fonction qui retourne le chemin des photos et $new_nom_photo est le nom de la photo enregistré en BDD
    }

    public function photoDir(){
        return __DIR__ . '/../../../web/photo';
    }

    public function renameFile($name){
        return 'photo_' . time() . '_' . rand(1, 9999) . '_' . $name; // si la photo s'appelle 'tshirt' ça return => 'photo_1500000_7541_tshirt.jpg'
    }

     /**
     * Set idPoi
     *
     * @param integer $id_poi
     *
     * @return Photo
     */
    public function setIdPoi($id_poi)
    {
        $this->idPoi = $id_poi;

        return $this;
    }

    /**
     * Get idPoi
     *
     * @return int
     */
    public function getIdPoi()
    {
        return $this->idPoi;
    }
}