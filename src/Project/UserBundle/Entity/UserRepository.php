<?php

namespace Project\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function getAllLength()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(u.id) FROM ProjectUserBundle:User u'
            )
            ->getSingleScalarResult();
    }
}
