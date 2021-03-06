<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Poi
 *
 * @ORM\Table(name="poi")
 * @ORM\Entity(repositoryClass="App\Repository\PoiRepository")
 */
class Poi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_POI", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="POI", type="string", length=25)
     */
    private $poi; 

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=25)
     */
    private $categorie;
    
   /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;
   
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=20)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20)
     */
    private $pays;

      /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=300)
     */
    private $photo;
    private $file;

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
     * Set poi
     *
     * @param string $poi
     * @return Poi
     */
    public function setPoi($poi)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * Get poi
     *
     * @return string
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Poi
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Poi
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Poi
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    
    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Poi
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Poi
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
    
    /**
     * Set region
     *
     * @param string $region
     *
     * @return Poi
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Poi
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Poi
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

    public function getFile()
    {
        return $this -> file;
    }

    public function setFile(UploadedFile $file = NULL){
        $this -> file  = $file;

        return $this;
    }
    public function chargementPhoto()
    {
        if(!$this -> file)
        {
            return;
        }
        $nom_photo = $this -> file -> getClientOriginalName();
        // On récupère le nom original de la photo ($_FILES['photo']['name'])

        $new_nom_photo = $this -> renameFile($nom_photo);

        $this -> photo = $new_nom_photo;

        $this -> file -> move($this -> photoDir(),$new_nom_photo);
        // photoDir() est notre fonction qui retourne le chemin des photos, et$new_nom_photo est le nom de la photo enregistrée en BDD.
    }
    
    public function photoDir(){
        return __DIR__ . '/../../public/photo';
    }
    public function renameFile($name){
        return 'photo_' . time() . '_' . rand(1,9999) . '_' . $name;
        // return 'photo_1500000000_7548_thirt.jpg'
    }
}