<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
   
    public function __construct(ManagerRegistry $registry, EntityManagerInterface  $em)
    {

        $this->em =  $em;
        parent::__construct($registry, Service::class  );
       


    }


    // /**
    //  * @return Service[] Returns an array of Service objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Service
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function transformAll()
    {
        $services = $this->findAll();
        $serviceArray = [];
        foreach ( $services  as  $service ) {
            $serviceArray [] = $this->transform( $service);
        }
        return  $serviceArray ;
    
    }

    
    public function transform(Service $services)
    {
        return [
                'id'    => (int)$services->getId(),
                'title' => (string) $services->getTitle(),
                'description' => (string) $services->getDescription(),                 
        ];
    }


   

    public function  updateService(Service  $service)
    {
        $this->em->persist($service);
        $this->em->flush();

        return $service;
    }


    public function removeService(Service  $service)
    {
        $this->em->remove($service);
        $this->em->flush();
    }
}

