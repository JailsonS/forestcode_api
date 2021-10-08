<?php
namespace Src\Domain\Propriedade;

use Doctrine\ORM\Mapping as ORM;
use Jsor\Doctrine\PostGIS\Types\PostGISType;

#[ORM\Entity]
class Propriedade
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(type: "string", nullable:false, length: 150)]
    private string $nome;

    #[ORM\Column(type: "float", precision:4, nullable:true)]
    private float $area;
    
    #[ORM\Column(type:"float", precision:4, nullable:true)]
    private float $mf;
}