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

    public function addFarm(string $farmName, Municipality $municipality, string $geom): void
    {
        $farm = new Farm($farmName, $municipality);
        
        $wktGeom = new WKTGeom($geom, $farm);

        $farm->addGeometry($wktgeom);
        $farm = $this->calculateArea($farm);
        $farm->calculateMf();

        $this->em->persist($farm);
        $this->em->flush();
    }

    /**
     * @return Farm retorna o objeto com a propriedade area calculada em hectares (unidade padrão do projeto)
     */
    private function calculateArea(Farm $farm)//: Farm
    {
        $query = $this->em->createQuery(
            "SELECT ST_Area(ST_GeomFromText({$farm->geom})) AS value FROM {$farm}"
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