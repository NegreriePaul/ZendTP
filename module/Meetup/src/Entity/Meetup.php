<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\DateTimeSelect;


/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Meetup\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="datetime", length=50, nullable=false)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime", length=50, nullable=false)
     */
    private $datefin;


    public function __construct(string $title, string $description = '', DateTimeSelect $datedebut , DateTimeSelect $datefin)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDatedebut() : \DateTime
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut(datetime $datedebut) : void
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin() : \DateTime
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin(datetime $datefin) : void
    {
        $this->datefin = $datefin;
    }




}
