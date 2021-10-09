<?php
namespace Src\Domain;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Src\Infra\Database\EntityManagerFactory;
use Jsor\Doctrine\PostGIS\Entity\PointsEntity;

class WKTGeom
{
    public object $entity;
    private ?EntityManager $em = null;

    public function __construct(object $entity)
    {
        $this->entity = $entity;
        $emFactory = new EntityManagerFactory();
        $this->em = $emFactory->_getEntityManager();
    }

    public function fromGeoJson()
    {

    }

    public function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function isValidGeom()//: bool
    {
        $query = $this->em->createQuery(
            "SELECT ST_IsValid(ST_GeomFromText('POLYGON((0 0, 1 1, 1 2, 1 1, 0 0))')) AS value FROM Src\\Domain\\Farm\\Farm polygon"
        );

        $result = $query->getSingleResult();

        print_r($result); exit;
    }
}