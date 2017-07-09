<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;
use \PDO;

class DechetsModel
{
    private $pdo;

    public function __construct(Connection $db)
    {

        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=circus;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /**
     * Récupère les dechets ayant un nom similaire à $word
     *
     * @param string $word
     *
     * @return array $result
     */
    function getDechetsSearch($word)
    {
        $dechets=[];

        $sql = $this->pdo->prepare("SELECT * FROM dechets WHERE nom_dechets LIKE :word OR dechetassocie LIKE :word OR recherche_associee LIKE :word");
        $sql->bindValue(":word", $word.'%', PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetchAll();

        foreach ($results as $result) {
            $sql = $this->pdo->prepare("SELECT * FROM contribution WHERE dechet LIKE :dechet.'%'");
            $sql->bindValue(":dechet", $result['nom_dechets'], PDO::PARAM_INT);
            $sql->execute();
            $contributions = $sql->fetchAll();
            foreach ($contributions as $contribution) {
                array_push($dechets, $contribution);
            }
        }

        $sql->closeCursor();
        $sql = NULL;
        return $dechets;
    }

    /**
     * Récupère les résultats correspondant à $word dans dechets donne la contribution associée/contribution/infos_contributeur
     *
     * @param $word
     *
     * @return array $result
     */
    function levenshtein($word)
    {
        $sql = $this->pdo->prepare("SELECT * FROM dechets");
        $sql->execute();
        $resultsDechet = $sql->fetchAll();

        for ($i = 1; $i <= count($resultsDechet)-1; $i++) {
            $test = $this->accentMinus($resultsDechet[$i]['dechetassocie']);
            $test2 = $this->accentMinus($resultsDechet[$i]['nom_dechets']);
            $test3 = $this->accentMinus($resultsDechet[$i]['recherche_associee']);
            $leven1 = levenshtein($word, $test);
            $leven2 = levenshtein($word, $test2);
            $leven3 = levenshtein($word, $test3);
            if ($i == 1 || levenshtein($word, $test) < $resultDechet[2] || levenshtein($word, $test2) < $resultDechet[2] || levenshtein($word, $test3) < $resultDechet[2]) {
                $resultDechet[0] = $resultsDechet[$i]['id'];
                $resultDechet[1] = $resultsDechet[$i]['nom_dechets'];
                $resultDechet[2] = min($leven1, $leven2, $leven3);
            }

        }

        $sql = $this->pdo->prepare("SELECT * FROM contribution WHERE dechet =:dechet");
        $sql->bindValue(":dechet", $resultDechet[1], PDO::PARAM_INT);
        $sql->execute();
        $queryDechets = $sql->fetchAll();

        $results["dechets_levenshtein"] = $queryDechets;

        $sql = "SELECT * FROM contribution";
        $resultsContrib = $this->db->fetchAll($sql);

        for ($i = 1; $i <= count($resultsContrib)-1; $i++) {
            $test = $this->accentMinus($resultsContrib[$i]['dechet']);
            if ($i == 1 || levenshtein($word, $test) < $resultContrib["note_levenshtein"]) {
                $resultContrib["id"] = $resultsContrib[$i]['id'];
                $resultContrib["titre"] = $resultsContrib[$i]['titre'];
                $resultContrib["note_levenshtein"] = levenshtein($word, $test);

            }

        }

        $results["contribution_levenshtein"] = $resultContrib;

        $sql = $this->pdo->prepare("SELECT * FROM infos_contributeur");
        $sql->execute();
        $resultsInfosContrib = $sql->fetchAll();

        for ($i = 1; $i <= count($resultsInfosContrib)-1; $i++) {
            $test = $this->accentMinus($resultsInfosContrib[$i]['visible_name']);
            $test2 = $this->accentMinus($resultsInfosContrib[$i]['nom']);
            $test3 = $this->accentMinus($resultsInfosContrib[$i]['dixmots_paragraphe']);
            $leven1 = levenshtein($word, $test);
            $leven2 = levenshtein($word, $test2);
            $leven3 = levenshtein($word, $test3);
            if ($i == 1 || levenshtein($word, $test) < $resultInfosContrib["note_levenshtein"] || levenshtein($word, $test2) < $resultInfosContrib["note_levenshtein"] || levenshtein($word, $test3) < $resultInfosContrib["note_levenshtein"]) {
                $resultInfosContrib["id"] = $resultsInfosContrib[$i]['id'];
                $resultInfosContrib["nom"] = $resultsInfosContrib[$i]['nom'];
                $resultInfosContrib["note_levenshtein"] = min($leven1, $leven2, $leven3);
            }

        }

        $results["infos_contributeur_levenshtein"] = $resultInfosContrib;

        $sql->closeCursor();
        $sql = NULL;
        return array($results);
    }

    function accentMinus($word) {
        $input = strtolower($word);
        $from = 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝáàâäãåçéèêëíìîïñóòôöõúùûüýÿ'; // these chars are in UTF-8
        $to   = 'AAAAAACEEEEIIIINOOOOOUUUUYaaaaaaceeeeiiiinooooouuuuyy';
        $input_sansaccent= $this->my_strtr($input, $from, $to);
        return $input_sansaccent;
    }

    function my_strtr($inputStr, $from, $to, $encoding = 'UTF-8') {
        $inputStrLength = mb_strlen($inputStr, $encoding);

        $translated = '';

        for($i = 0; $i < $inputStrLength; $i++) {
            $currentChar = mb_substr($inputStr, $i, 1, $encoding);

            $translatedCharPos = mb_strpos($from, $currentChar, 0, $encoding);

            if($translatedCharPos === false) {
                $translated .= $currentChar;
            }
            else {
                $translated .= mb_substr($to, $translatedCharPos, 1, $encoding);
            }
        }

        return $translated;
    }
}
