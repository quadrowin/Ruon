<?php

namespace Ruon\Collection\Iterator;

/**
 *
 * Для моделей коллекции будет создан единственный обект, данные
 * которого будут подменяться на каждой итерации.
 *
 * @author Goorus
 *
 */
class CollectionIteratorSingleton extends CollectionIteratorAbstract
{

    /**
     *
     * @var \Ruon\Entity\Entity
     */
    protected $current;

    /**
     *
     * @var \Ruon\Entity\EntityFactory
     */
    protected $entityFactory;

    /**
     * Возвращает текущий элемент
     *
     * @return \Ruon\Entity\Entity
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * @return \Ruon\Entity\Entity
     */
    public function next()
    {
        $row = $this->arrayIterator->next();

        if (!$this->current) {
            $this->current = $this->entityFactory->create(
                $this->collection->getEntityName(),
                $row
            );
        } else {
            $this->current
                ->replaceFields($row)
                ->setUpdatedFields(array());
        }

        return $this->current;
    }

    /**
     * Сбрасывает итератор и возвращает первый элемент коллекции
     *
     * @return \Ruon\Entity\Entity
     */
    public function rewind()
    {
        $row = $this->arrayIterator->rewind();

        if (!$this->current) {
            $this->current = $this->entityFactory->create(
                $this->collection->getEntityName(),
                $row
            );
        } else {
            $this->current
                ->replaceFields($row)
                ->setUpdatedFields(array());
        }

        return $this->current;
    }

}
