<?php   
namespace Src\Infra\Database;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Dotenv\Dotenv;
use Jsor\Doctrine\PostGIS\Event\ORMSchemaEventSubscriber;

class EntityManagerFactory
{

    public function __construct()
    {

    }
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {

        $rootDir = __DIR__ . '/../../..';
        $isDevMode = true;
        $paths = [$rootDir . '/src'];

        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->safeLoad();

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode
        );

        $connection = [
            'driver' => $_ENV['DB_DRIVER'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'port' => $_ENV['DB_PORT'],
        ];

        $entityManager = EntityManager::create($connection, $config);
        $entityManager->getEventManager()->addEventSubscriber(new ORMSchemaEventSubscriber());

        return $entityManager;
    }
}