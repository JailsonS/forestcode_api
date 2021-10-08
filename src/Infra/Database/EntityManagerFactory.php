<?php   
namespace Src\Infra\Database;

use Dotenv\Dotenv;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Jsor\Doctrine\PostGIS\Functions\Configurator;
use Doctrine\ORM\Configuration as ORMConfiguration;
use Doctrine\DBAL\Configuration as DBALConfiguration;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use Jsor\Doctrine\PostGIS\Event\ORMSchemaEventSubscriber;
use Jsor\Doctrine\PostGIS\Event\DBALSchemaEventSubscriber;

class EntityManagerFactory
{
    private static ?Connection $_conn = null;

    private ?EntityManagerInterface $_em = null;

    private ?SchemaTool $_schemaTool = null;
    
    private array $dbParams = [];

    public function __construct() {
        $this->dbParams = $this->getDbParams();
    }

    private function getDbParams(): array 
    {
        $rootDir = __DIR__ . '/../../..';
        
        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->safeLoad();

        return 
        [
            'driver' => $_ENV['DB_DRIVER'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'port' => $_ENV['DB_PORT'],
        ];
    }

    private function connection(): Connection
    {
        // padrão singleton, permite apenas uma instância de conexão
        if(isset(self::$_conn)) {
            return self::$_conn;
        }
        
        if (class_exists(ORMConfiguration::class)) {
            self::$_conn = DriverManager::getConnection($this->getDbParams(), new ORMConfiguration());
            
            self::$_conn->getEventManager()->addEventSubscriber(new ORMSchemaEventSubscriber());
            
            Configurator::configure(self::$_conn->getConfiguration());
        } else {
            self::$_conn = DriverManager::getConnection($this->getDbParams(), new DBALConfiguration());

            self::$_conn->getEventManager()->addEventSubscriber(new DBALSchemaEventSubscriber());
        }

        if (!Type::hasType('tsvector')) {
            Type::addType('tsvector', 'Doctrine\DBAL\Types\TextType');
        }

        $platform = self::$_conn->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('tsvector', 'tsvector');

        // Prevent "Unknown database type..." exceptions thrown during
        $platform->registerDoctrineTypeMapping('_text', 'string');

        return self::$_conn;
    }

    /**
     * @param array $paths deve conter o dir raiz onde as entidades estão localizadas
     * no caso, o dir src/
     */
    private function _setupConfiguration(ORMConfiguration $config, array $paths): ORMConfiguration
    {
        $config->setProxyDir(__DIR__ . '/tmp');
        $config->setProxyNamespace('Proxy');
        $config->setMetadataDriverImpl($this->_getMappingDriver($paths));

        return $config;
    }

    /**
     * @return retorna um objeto que configura o mapeamento dos atributos
     */
    private function _getMappingDriver(array $paths): MappingDriver
    {
        return new AttributeDriver($paths);
    }

    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function _getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../../..';
        $paths = [$rootDir . '/src'];

        if($this->_em !== null) {
            return $this->_em;
        }

        $connection = $this->connection();
        $config = $connection->getConfiguration();

        $this->_setupConfiguration($config, $paths);

        $em = EntityManager::create($connection, $config);

        $this->_em = $em;

        return $this->_em;
    }
}