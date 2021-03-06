<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
    /**
     * Gets all records paginated.
     *
     * @param int $page Page number
     *
     * @return \Pagerfanta\Pagerfanta Result
     */
    public function findAllPaginated($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryAll(), false));
        $paginator->setMaxPerPage(Tag::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
     * Query all Attributes.
     *
     * @return \Doctrine\ORM\Query
     */
    protected function queryAll()
    {
        return $this->_em->createQuery('
            SELECT tag
            FROM AppBundle:Tag tag
        ');
    }

    /**
     * Save entity.
     *
     * @param Tag $tag Tag entity
     */
    public function save(Tag $tag)
    {
        $this->_em->persist($tag);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Tag $tag Tag entity
     */
    public function delete(Tag $tag)
    {
        $this->_em->remove($tag);
        $this->_em->flush();
    }
}
