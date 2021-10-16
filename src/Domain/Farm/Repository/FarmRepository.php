<?php

namespace Src\Domain\Farm\Repository;

use Src\Domain\Farm\Farm;
use Doctrine\ORM\EntityRepository;

class FarmRepository extends EntityRepository implements FarmRepositoryInterface
{
    private ?EntityManagerInterface $em = null;

    public function __construct()
    {
        $this->em = $this->getEntityManager();
    }

    public function addFarm(string $farmName, Municipality $municipality, string $geom)
    {
        // create farm
        $farm = new Farm($farmName, $municipality);
        
        $farm->addGeometry($geom);

        $this->em->persist($farm);
        
        // insert to database
        $this->em->flush();
        
        // calculate area and fiscal module
        $farm->addArea($this->calculateArea($farm));
        $farm->calculateMf();

        // insert to database
        $this->em->flush();
        $this->em->clear();

    }

    /**
     * @return Farm retorna o objeto com a propriedade area calculada em hectares (unidade padrão do projeto)
     */
    public function calculateArea(Farm $farm)
    {

        $class = new \ReflectionClass($farm);
        
        $query = $this->em->createQuery(
            "SELECT ST_Area(ST_GeomFromText({$farm->geom})) AS value FROM {$class->getName()} polygon"
        );

        $result = $query->getSingleResult();

        print_r($result); exit;

        /*
        array_walk_recursive($result, static function (&$data): void {
            if (is_resource($data)) {
                $data = stream_get_contents($data);

                if (false !== ($pos = strpos($data, 'x'))) {
                    $data = substr($data, $pos + 1);
                }
            }

            $data = (float) $data;
        });
        */
    }


}