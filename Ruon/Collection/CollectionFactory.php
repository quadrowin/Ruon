<?php

namespace Ruon\Collection;

/**
 *
 * Билдер коллекций
 *
 * @author Goorus, Morph
 *
 */
class CollectionFactory
{

    /**
     *
     * @param string $entity
     * @return CollectionArray
     */
    public function create($entity)
    {
        $collection = new CollectionArray;
        $collection->setEntityName($entity);
        return $collection;
    }

}
