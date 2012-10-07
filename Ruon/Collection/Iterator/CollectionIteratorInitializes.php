<?php

namespace Ruon\Collection\Iterator;

/**
 *
 * Инициализирующий итератор.
 * Для каждой модели из коллекции будет создан объект.
 *
 * @author Goorus
 *
 */
class CollectionIteratorInitializes extends CollectionIteratorAbstract
{

    /**
     *
     * @var \Ruon\Entity\Entity
     */
    protected $current;

    /**
     * Хранилище обеъктов
     *
     * @service \Ruon\Entity\EntityManager
     * @var \Ruon\Entity\EntityManager
     */
    protected $entityManager;

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
        $this->current = $this->entityManager->getEntityInstance(
            $this->collection->getEntityName(),
            $this->arrayIterator->next()
        );

        return $this->current;
    }

    /**
     * Сбрасывает итератор и возвращает первый элемент коллекции
     *
     * @return \Ruon\Entity\Entity
     */
    public function rewind()
    {
        $this->current = $this->entityManager->getEntityInstance(
            $this->collection->getEntityName(),
            $this->arrayIterator->rewind()
        );

        return $this->current;
    }

}
