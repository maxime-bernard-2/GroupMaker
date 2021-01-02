<?php
/**
 * Objet regroupant des fonctions diverses.
 *
 * @package Core
 * @author Maxime Bernard
 * @version 3
 */

namespace App\Core;

use App\Model\SimpleXLSXGen;

/**
 * Class Utils
 */
class Utils
{

    /**
     * Fonction permettant de générer une chaine de caractères aléatoires.
     *
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public function generateRandomString($length = 30): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getDoc(): void
    {
        $xlsx = SimpleXLSXGen::fromArray($_SESSION['result']);
        $xlsx->downloadAs('result.xlsx');
    }

    public static function fileUpload(): void
    {
        $uploaddir = __DIR__ . '/../../public/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

        header('Location: /calculate?maxNumber=' . $_POST['maxNumber'] . '&file=' . $_FILES['file']['name']);
    }

}