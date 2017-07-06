<?php

namespace Models\Domain;

class InfosContributeur
{
    /**
     * InfosContributeur id.
     *
     * @var integer
     */
    private $id;

    /**
     * InfosContributeur id_user.
     *
     * @var int
     */
    private $id_user;

    /**
     * InfosContributeur nom.
     *
     * @var varchar
     */
    private $nom;

    /**
     * InfosContributeur visible_name.
     *
     * @var varchar
     */
    private $visible_name;

    /**
     * InfosContributeur email.
     *
     * @var varchar
     */
    private $email;

    /**
     * InfosContributeur photo_logo.
     *
     * @var varchar
     */
    private $photo_logo;

    /**
     * InfosContributeur photo_fond.
     *
     * @var integer
     */
    private $photo_fond;

    /**
     * InfosContributeur url.
     *
     * @var int
     */
    private $url;

    /**
     * InfosContributeur facebook.
     *
     * @var varchar
     */
    private $facebook;

    /**
     * InfosContributeur twitter.
     *
     * @var varchar
     */
    private $twitter;

    /**
     * InfosContributeur linkedin.
     *
     * @var varchar
     */
    private $linkedin;

    /**
     * InfosContributeur adresse.
     *
     * @var varchar
     */
    private $adresse;

    /**
     * InfosContributeur cp.
     *
     * @var integer
     */
    private $cp;

    /**
     * InfosContributeur ville.
     *
     * @var int
     */
    private $ville;

    /**
     * InfosContributeur telephone.
     *
     * @var varchar
     */
    private $telephone;

    /**
     * InfosContributeur lat.
     *
     * @var varchar
     */
    private $lat;

    /**
     * InfosContributeur lng.
     *
     * @var varchar
     */
    private $lng;

    /**
     * InfosContributeur boutique.
     *
     * @var varchar
     */
    private $boutique;

    /**
     * InfosContributeur paragraphe_info.
     *
     * @var varchar
     */
    private $paragraphe_info;

    /**
     * InfosContributeur activite.
     *
     * @var varchar
     */
    private $activite;

    /**
     * InfosContributeur dixmots_paragraphe.
     *
     * @var varchar
     */
    private $dixmots_paragraphe;

    /**
     * InfosContributeur dechets_reval.
     *
     * @var varchar
     */
    private $dechets_reval;

    /**
     * InfosContributeur activation.
     *
     * @var varchar
     */
    private $activation;

    /**
     * InfosContributeur token.
     *
     * @var varchar
     */
    private $token;

    /**
     * InfosContributeur gh.
     *
     * @var varchar
     */
    private $gh;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return varchar
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param varchar $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return varchar
     */
    public function getVisibleName()
    {
        return $this->visible_name;
    }

    /**
     * @param varchar $visible_name
     */
    public function setVisibleName($visible_name)
    {
        $this->visible_name = $visible_name;
    }

    /**
     * @return varchar
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param varchar $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return varchar
     */
    public function getPhotoLogo()
    {
        return $this->photo_logo;
    }

    /**
     * @param varchar $photo_logo
     */
    public function setPhotoLogo($photo_logo)
    {
        $this->photo_logo = $photo_logo;
    }

    /**
     * @return int
     */
    public function getPhotoFond()
    {
        return $this->photo_fond;
    }

    /**
     * @param int $photo_fond
     */
    public function setPhotoFond($photo_fond)
    {
        $this->photo_fond = $photo_fond;
    }

    /**
     * @return int
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param int $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return varchar
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param varchar $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return varchar
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param varchar $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return varchar
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param varchar $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return varchar
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param varchar $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param int $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return int
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param int $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return varchar
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param varchar $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return varchar
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param varchar $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return varchar
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param varchar $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return varchar
     */
    public function getBoutique()
    {
        return $this->boutique;
    }

    /**
     * @param varchar $boutique
     */
    public function setBoutique($boutique)
    {
        $this->boutique = $boutique;
    }

    /**
     * @return varchar
     */
    public function getParagrapheInfo()
    {
        return $this->paragraphe_info;
    }

    /**
     * @param varchar $paragraphe_info
     */
    public function setParagrapheInfo($paragraphe_info)
    {
        $this->paragraphe_info = $paragraphe_info;
    }

    /**
     * @return varchar
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param varchar $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }

    /**
     * @return varchar
     */
    public function getDixmotsParagraphe()
    {
        return $this->dixmots_paragraphe;
    }

    /**
     * @param varchar $dixmots_paragraphe
     */
    public function setDixmotsParagraphe($dixmots_paragraphe)
    {
        $this->dixmots_paragraphe = $dixmots_paragraphe;
    }

    /**
     * @return varchar
     */
    public function getDechetsReval()
    {
        return $this->dechets_reval;
    }

    /**
     * @param varchar $dechets_reval
     */
    public function setDechetsReval($dechets_reval)
    {
        $this->dechets_reval = $dechets_reval;
    }

    /**
     * @return varchar
     */
    public function getActivation()
    {
        return $this->activation;
    }

    /**
     * @param varchar $activation
     */
    public function setActivation($activation)
    {
        $this->activation = $activation;
    }

    /**
     * @return varchar
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param varchar $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return varchar
     */
    public function getGh()
    {
        return $this->gh;
    }

    /**
     * @param varchar $gh
     */
    public function setGh($gh)
    {
        $this->gh = $gh;
    }


}
