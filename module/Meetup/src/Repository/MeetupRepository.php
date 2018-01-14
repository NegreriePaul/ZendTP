<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
//use Zend\Form\Element\Date;

final class MeetupRepository extends EntityRepository
{

    public function delete(string $id): void
    {
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }


    public function createMeetup($meetup): void
    {
        if (!is_array($meetup)) {
            $createMeetup = $this->find($meetup->getId());
        } else {
            $createMeetup = new Meetup();
            /** @var $hydrator DoctrineHydrator */
            $hydrator = new DoctrineHydrator($this->getEntityManager());
            $hydrator->hydrate($meetup, $createMeetup);
        }

            $this->getEntityManager()->persist($createMeetup);
            $this->getEntityManager()->flush($createMeetup);

    }
}
