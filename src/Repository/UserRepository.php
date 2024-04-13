<?php
namespace App\Repository;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function getAllUsers($currentPage = 1)
    {
        $query = $this->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'DESC')
            ->getQuery();
        $paginator = $this->paginate($query, $currentPage);
        return $paginator;
    }
    public function paginate($dql, $page = 1, $limit = 10)
    {
        $paginator = new Paginator($dql);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) 
            ->setMaxResults($limit);
        return $paginator;
    }
}
