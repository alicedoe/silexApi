<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;

class DechetsModel
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
     * Récupère les dechets ayant un nom similaire à $word
     *
     * @param string $word
     *
     * @return array $result
     */
    function getDechetsSearch($word)
    {
        $dechets=[];

        $sql = "SELECT * FROM dechets WHERE nom_dechets LIKE '$word%' OR dechetassocie LIKE '$word%' OR recherche_associee LIKE '$word%'";
        $results = $this->db->fetchAll($sql);

        foreach ($results as $result) {
            $sql = "SELECT * FROM contribution WHERE dechet LIKE '".$result['nom_dechets']."'";
            $contributions = $this->db->fetchAll($sql);
            foreach ($contributions as $contribution) {
                array_push($dechets, $contribution);
            }
        }
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

        $sql = "SELECT * FROM dechets";
        $resultsDechet = $this->db->fetchAll($sql);

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

        $sql = "SELECT * FROM contribution WHERE dechet = '$resultDechet[1]'";
        $queryDechets = $this->db->fetchAll($sql);

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

        $sql = "SELECT * FROM infos_contributeur";
        $resultsInfosContrib = $this->db->fetchAll($sql);

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
