<?php

namespace Src\Domain\Farm\Repository;

use Shapefile\Shapefile;
use Src\Domain\Farm\Farm;
use Shapefile\ShapefileReader;
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
                ) / 10000 AS value 
            FROM Src\Domain\Farm\Farm polygon
            WHERE
                polygon.id = :id"
        );

        $query->setParameters(['id' => $farm->id()]);

        $result = $query->getSingleResult();

        return $result['value'];
    }

    public function uploadFarms(array $files): void
    {
        $shp = new ShapefileReader([
            Shapefile::FILE_SHP => fopen($files['shp'], 'rb'),
            Shapefile::FILE_SHX => fopen($files['shx'], 'rb'),
            Shapefile::FILE_DBF => fopen($files['dbf'], 'rb'),
            Shapefile::OPTION_DBF_FORCE_ALL_CAPS => true,
        ]);

        // close stream
        echo "<pre>";
            print_r($sql);
        echo "</pre>";
    }
}