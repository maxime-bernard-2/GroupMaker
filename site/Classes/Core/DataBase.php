<?php
/**
 * Objet de gestion de la base de donées.
 *
 * @package Core
 * @author Maxime Bernard
 * @version 3
 */

namespace App\Core;

use PDO;
use PDOException;

/**
 * Class DataBase
 */
class DataBase
{
    /**
     * Fonction permettant de se connecter à la base de données.
     * @return PDO
     */
    public function connect(): PDO
    {
        try {
            return new PDO("mysql:host=database;dbname=groupMaker;port=3306", 'groupMaker', 'kJI6zkVYcXmo6Ebt');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}