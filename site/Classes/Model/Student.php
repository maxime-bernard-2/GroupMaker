<?php
/**
 * Objet représentant un étudiant.
 *
 * @package GroupMaker
 * @author Maxime Bernard
 * @version 1
 */

namespace App\Model;

/**
 * Class Student
 */
class Student
{
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $secondName;
    /**
     * @var int
     */
    private int $group;

    /**
     * Constructeur de l'objet étudiant.
     * @param $firstName
     * @param $secondName
     */
    public function __construct($firstName, $secondName)
    {
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->group = 0;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return int
     */
    public function getGroup(): int
    {
        return $this->group;
    }

    /**
     * @param int $group
     */
    public function setGroup(int $group): void
    {
        $this->group = $group;
    }
}