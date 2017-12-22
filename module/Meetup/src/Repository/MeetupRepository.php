<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
//use Zend\Form\Element\Date;

final class MeetupRepository extends EntityRepository
{

    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function createFilmFromNameAndDescription(string $name, string $description,  $datedebut , $datefin)
    {
        return new Meetup($name, $description ,$datedebut ,$datefin);
    }
}
