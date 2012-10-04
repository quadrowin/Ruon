<?php

namespace Ruon\Entity\Repository;

/**
 *
 * Description of IdentityMap
 *
 * @author Goorus
 *
 */
class EntityRepositoryArray extends EntityRepositorySimple
{

    public function __construct()
    {
        $this->repository = new \Ruon\Data\DataRepositoryArray;
    }

}
