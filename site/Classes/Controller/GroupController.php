<?php
/**
 * Controlleur principal de l'application.
 *
 * @package GroupMaker
 * @author Maxime Bernard
 * @version 3
 */

namespace App\Controller;

use App\Core\DataBase;
use App\Core\Utils;
use App\Model\StudentPool;
use http\Exception;

/**
 * Class GroupController
 */
class GroupController {

    /**
     * Fonction d'affichage de la page d'accueil.
     */
    public function indexShow(): void
    {
        require 'Classes/View/indexView.php';
    }

    /**
     * Fonction de gestion des données envoyées par la page d'accueil.
     */
    public function calculate(): void
    {
        try {
            $pool = new StudentPool($_GET['maxNumber'], $_GET['file']);
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            header('Location: /');
        }

        $pool->shuffleArray();
        $pool->createGroups();

        $_SESSION['pool'] = $pool;
        unlink("public/" . $_GET['file']);
        header('Location: result');
    }

    /**
     * Fonction d'affichage des listes.
     */
    public function resultShow(): void
    {
        if (isset($_GET['share'])) {
            $this->sharePage();
        }

        $this->generateFile();

        require 'Classes/View/resultView.php';
    }

    /**
     * Fonction de téléchargement du fichier.
     */
    public function getDoc(): void
    {
        \App\Core\Utils::getDoc();
    }

    /**
     * Fonction d'upload du fichier de l'utilisateur.
     */
    public function fileUpload(): void
    {
        \App\Core\Utils::fileUpload();
    }

    /**
     * Fonction de traitement et d'affichage pour le partage.
     */
    public function generateShare(): void
    {
        $utils = new Utils();
        $token = $utils->generateRandomString();

        $database = new DataBase();
        $pdo = $database->connect();

        $stmt = $pdo->query("SELECT * FROM share");
        $share = $stmt->fetchAll();

        $exist = false;
        foreach ($share as $item) {
            if ($item['list'] === serialize($_SESSION['pool'])) {
                $token = $item['token'];
                $exist = true;
            }
        }

        if (!$exist) {
            $sql = "INSERT INTO share (id, token, list) VALUES (NULL, ?, ?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$token, serialize($_SESSION['pool'])]);
        }

        require 'Classes/View/shareView.php';
    }

    /**
     * Fonction d'affichage de la page d'erreur.
     */
    public function error(): void
    {
        require 'Classes/View/errorView.php';
    }

    /**
     * Fonction de vérification pour la page de partage.
     *
     * Si le token dans l'URL est valide et présente dans la base de données,
     * récupère la liste des étudiants.
     * Sinon, redirige vers l'accueil avec un message d'erreur.
     */
    public function sharePage(): void
    {
        $token = $_GET['share'];

        $database = new DataBase();
        $pdo = $database->connect();

        $stmt = $pdo->prepare("SELECT list FROM share WHERE token=?");
        $stmt->execute([$token]);
        $pool = $stmt->fetch();

        if ($pool) {
            $_SESSION['pool'] = unserialize($pool['list']);
        } else {
            $_SESSION['message'] = "Lien invalide ! Cette liste n'existe pas/plus.";
            header('Location: /');
        }
    }

    /**
     * Fonction de génération du fichier à télécharger.
     */
    public function generateFile() {
        $result = array();
        $result[0] = array();
        $result[0][] = "Prénom";
        $result[0][] = "Nom";
        $result[0][] = "Groupe";

        $compt = 1;
        foreach ($_SESSION['pool']->getStudentArray() as $student) {
            $result[$compt] = array();
            $result[$compt][] = $student->getFirstName();
            $result[$compt][] = $student->getSecondName();
            $result[$compt][] = $student->getGroup();
            $compt++;
        }

        $_SESSION['result'] = $result;
    }
}

