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

    /*
    public function uploadFarms(string|array $files): void
    {

        if(is_array($files)) {

            $shp = new ShapefileReader([
                Shapefile::FILE_SHP => fopen('/path/to/file.shp', 'rb'),
                Shapefile::FILE_SHX => fopen('/path/to/file.shx', 'rb'),
                Shapefile::FILE_DBF => fopen('/path/to/file.dbf', 'rb'),
            ]);
            
        } else {
            $shp = new ShapefileReader('myshape.shp');
        } 

        // close stream
        $shp = null;
    }
    */


}