<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class BrandRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT brand
            FROM ProductBundle:Brand brand
            WHERE
            brand.id = :id AND
            brand.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllObjects()
	{
		return $this->createQueryBuilder('o')
			->where('o.isActive = :active')
			->orderBy('o.id', 'ASC')
			->setParameter('active', true)
			;
	}

}
