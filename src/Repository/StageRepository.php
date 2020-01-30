<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    /**
    * @return Stage[] Returns an array of Stage objects
    */
    
    public function findByEntreprise($entreprise)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.monEntreprise = :entreprise')
            ->setParameter('entreprise', $entreprise)
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
    * @return Stage[] Returns an array of Stage objects
    */
    
    public function findByFormation($formation)
    {
        // Récupération du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        // Construction de la requête
        $requete = $gestionnaireEntite->createQuery(
            'SELECT s, f, e
            FROM App\Entity\Stage s
            JOIN s.mesFormations f
            JOIN s.monEntreprise e
            WHERE f = :formation');

        // Définition de la valeur des paramètres injectés dans la requête
        $requete->setParameter('formation', $formation);

        // Retourner les résultats
        return $requete->execute();
    }
    

    public function findStagesEtEntreprises()
    {
        // Récupération du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        // Construction de la requête
        $requete = $gestionnaireEntite->createQuery(
            'SELECT s, f, e
            FROM App\Entity\Stage s
            JOIN s.monEntreprise e
            JOIN s.mesFormations f');

        // Retourner les résultats
        return $requete->execute();
    }


    // /**
    //  * @return Stage[] Returns an array of Stage objects
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
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
