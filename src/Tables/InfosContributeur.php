<?php

namespace Models\Tables;

use Doctrine\DBAL\Connection;

class InfosContributeur
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function userWithCoord() {
        $sql = "select * from infos_contributeur where lat != 0 and lng != 0";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return a list of all infos_contributeur.
     *
     * @return array A list of all infos_contributeur.
     */
    public function getAll() {
        $sql = "select * from infos_contributeur";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return one user from infos_contributeur with user_id=$id and activation set to 'oui'
     *
     * @return array with one user.
     */
    public function getUserActivated($id) {
        $sql = "select * from infos_contributeur where id_user = $id and activation='oui'";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return one user from infos_contributeur with user_id=$id
     *
     * @return array with one user.
     */
    public function getUser($id) {
        $sql = "select * from infos_contributeur where id_user = $id";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

//    protected function buildDomainObject(array $row) {
//        $infos_contributeur = new InfosContributeur();
//        $infos_contributeur->setId($row['id']);
//        $infos_contributeur->setIdUser($row['id_user']);
//        $infos_contributeur->setNom($row['nom']);
//        $infos_contributeur->setVisibleName($row['visible_name']);
//        $infos_contributeur->setEmail($row['email']);
//        $infos_contributeur->setPhotoLogo($row['photo_logo']);
//        $infos_contributeur->setPhotoFond($row['photo_fond']);
//        $infos_contributeur->setUrl($row['url']);
//        $infos_contributeur->setFacebook($row['facebook']);
//        $infos_contributeur->setTwitter($row['twitter']);
//        $infos_contributeur->setLinkedin($row['linkedin']);
//        $infos_contributeur->setAdresse($row['adresse']);
//        $infos_contributeur->setCp($row['cp']);
//        $infos_contributeur->setVille($row['ville']);
//        $infos_contributeur->setTelephone($row['telephone']);
//        $infos_contributeur->setLat($row['lat']);
//        $infos_contributeur->setLng($row['lng']);
//        $infos_contributeur->setBoutique($row['boutique']);
//        $infos_contributeur->setParagrapheInfo($row['paragraphe_info']);
//        $infos_contributeur->setActivite($row['activite']);
//        $infos_contributeur->setDixmotsParagraphe($row['dixmots_paragraphe']);
//        $infos_contributeur->setDechetsReval($row['dechets_reval']);
//        $infos_contributeur->setActivation($row['activation']);
//        $infos_contributeur->setToken($row['token']);
//        $infos_contributeur->setGh($row['gh']);
//        return $infos_contributeur;
//    }
//
//    function buildUsersArray(InfosContributeur $user) {
//        $data  = array(
//            'id'=>$user->getId(),
//            'id_user'=>$user->getIdUser(),
//            'nom'=>$user->getNom(),
//            'visible_name'=>$user->getVisibleName(),
//            'email'=>$user->getEmail(),
//            'email'=>$user->getPhotoLogo(),
//            'photo_fond'=>$user->getPhotoFond(),
//            'url'=>$user->getUrl(),
//            'facebook'=>$user->getFacebook(),
//            'twitter'=>$user->getTwitter(),
//            'linkedin'=>$user->getLinkedin(),
//            'adresse'=>$user->getAdresse(),
//            'cp'=>$user->getCp(),
//            'ville'=>$user->getVille(),
//            'telephone'=>$user->getTelephone(),
//            'lat'=>$user->getLat(),
//            'lng'=>$user->getLng(),
//            'boutique'=>$user->getBoutique(),
//            'paragraphe_info'=>$user->getParagrapheInfo(),
//            'activite'=>$user->getActivite(),
//            'dixmots_paragraphe'=>$user->getDixmotsParagraphe(),
//            'dechets_reval'=>$user->getDechetsReval(),
//            'activation'=>$user->getActivation(),
//            'token'=>$user->getToken(),
//            'gh'=>$user->getGh()
//        );
//        return $data;
//    }
}
