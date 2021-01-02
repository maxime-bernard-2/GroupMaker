<?php
/**
 * Objet représentant un groupe d'étudiants.
 *
 * @package GroupMaker
 * @author Maxime Bernard
 * @version 1
 */

namespace App\Model;

use Exception;

/**
 * Class StudentPool
 */
class StudentPool
{
    /**
     * @var int
     */
    private int $maxStudentperGroup;
    /**
     * @var int
     */
    private int $groupNumber;
    /**
     * @var array
     */
    private array $studentArray;

    /**
     * Constructeur de l'objet.
     * @param $maxStudentperGroup
     * @param $xlsx
     * @throws Exception
     */
    public function __construct($maxStudentperGroup, $xlsx)
    {
        $this->maxStudentperGroup = $maxStudentperGroup;
        $this->groupNumber = 0;
        $this->studentArray = array();

        if ( $xlsx = SimpleXLSX::parse('public/' . $xlsx) ) {
            foreach ($xlsx->rows() as $elt) {

                $newStudent = new Student($elt[2], $elt[1]);
                $this->addStudent($newStudent);

            }
        } else {
            throw new Exception('Erreur: Mauvais format de fichier. ( XLSX requis )');
        }
    }

    /**
     * Mélange la liste d'étudiants.
     */
    public function shuffleArray(): void
    {
        $studentList = $this->getStudentArray();

        if (shuffle($studentList)) {
            $this->setStudentArray($studentList);
        } else {
            echo "Erreur lors du mélange !";
        }
    }

    /**
     * Attribue un groupe à chaque étudiant.
     */
    public function createGroups(): void
    {
        $compt = 1;
        $group = 1;
        foreach($this->getStudentArray() as $student) {
            $this->setGroupNumber($group);
            $student->setGroup($group);
            if($compt == $this->getMaxStudentperGroup()) {
                $compt = 1;
                $group += 1;
            } else {
                $compt += 1;
            }
        }
    }

    /**
     * @param Student $student
     */
    public function addStudent(Student $student): void
    {
        $this->studentArray[] = $student;
    }

    /**
     * @return int
     */
    public function getMaxStudentperGroup(): int
    {
        return $this->maxStudentperGroup;
    }

    /**
     * @param int $maxStudentperGroup
     */
    public function setMaxStudentperGroup(int $maxStudentperGroup): void
    {
        $this->maxStudentperGroup = $maxStudentperGroup;
    }

    /**
     * @return int
     */
    public function getGroupNumber(): int
    {
        return $this->groupNumber;
    }

    /**
     * @param int $groupNumber
     */
    public function setGroupNumber(int $groupNumber): void
    {
        $this->groupNumber = $groupNumber;
    }

    /**
     * @return array
     */
    public function getStudentArray(): array
    {
        return $this->studentArray;
    }

    /**
     * @param array $studentArray
     */
    public function setStudentArray(array $studentArray): void
    {
        $this->studentArray = $studentArray;
    }

}