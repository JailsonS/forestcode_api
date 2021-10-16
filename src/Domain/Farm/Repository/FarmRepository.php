<?php

namespace Src\Domain\Farm\Repository;

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Src\Domain\Farm\Repository\FarmRepositoryInterface;

class FarmRepository extends EntityRepository implements FarmRepositoryInterface
{

    public function addFarm(string $farmName, Municipality $municipality, string $geom)
    {
        $em = $this->getEntityManager();

        // create farm
        $farm = new Farm($farmName, $municipality);
        
        $farm->addGeometry($geom);

        $em->persist($farm);
        
        // insert to database
        $em->flush();
        
        // calculate area and fiscal module
        $farm->addArea($this->calculateArea($farm));
        $farm->calculateMf();

        // insert to database
        $em->flush();
        $em->clear();

    }

    /**
     * @return Farm retorna o objeto com a propriedade area calculada em hectares (unidade padrão do projeto)
     */
    public function calculateArea(Farm $farm): float
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            "SELECT 
                ST_Area(
                    ST_GeomFromText('{$farm->getGeom()}',{$farm->getSrid()})
                ) AS value 
            FROM Src\Domain\Farm\Farm polygon
            WHERE
                polygon.id = :id"
        );

        $query->setParameters(['id' => $farm->id()]);

        $result = $query->getSingleResult();

        return $result['value'];
    }


}