<?php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ApplicationRepository extends EntityRepository
{
  public function getApplicationsWithAdvert($limit)
  {
    $qb = $this->createQueryBuilder('a');


    $qb
      ->innerJoin('a.advert', 'adv')
      ->addSelect('adv')
    ;


    $qb->setMaxResults($limit);


    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  /**
   * @param string   $ip
   * @param integer  $seconds
   * @return bool    True si au moins une candidature créée il y a moins de $seconds secondes a été trouvée. False sinon.
   */
  public function isFlood($ip, $seconds)
  {
    return (bool) $this->createQueryBuilder('a')
      ->select('COUNT(a)')
      ->where('a.date >= :date')
      ->setParameter('date', new \Datetime($seconds.' seconds ago'))


      ->getQuery()
      ->getSingleScalarResult()
    ;
  }
}
