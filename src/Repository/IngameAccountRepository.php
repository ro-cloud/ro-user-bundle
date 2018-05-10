<?php

namespace RoCloud\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use RoCloud\UserBundle\Entity\IngameAccountInterface;

/**
 * Repository class for IngameAccountRepository.
 *
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class IngameAccountRepository extends EntityRepository
{
    /**
     * @param string $username
     *
     * @return null|IngameAccountInterface
     */
    public function findOneByUsername(string $username): ?IngameAccountInterface
    {
        return $this->findOneBy([
            'userid' => $username,
        ]);
    }
}
