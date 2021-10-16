<?php
namespace Src\Domain\Farm;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Jsor\Doctrine\PostGIS\Types\PostGISType;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class Municipality
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(type: "integer", nullable:false)]
    public int $cod_ibge;

    #[ORM\Column(type: "string", nullable:false, length: 150)]
    public string $name;

    #[ORM\Column(type: "string", columnDefinition: "CHAR(2) NOT NULL")]
    public string $uf;

    #[ORM\Column(type: "float", precision: 4, nullable:false)]
    public float $mf;

    #[ORM\Column(type: "float", precision: 4, nullable:false)]
    public float $area;
    
    #[ORM\Column(
        type: PostGISType::GEOMETRY, 
        options: ['geometry_type' => 'MULTIPOLYGON', 'srid' => 5641],
    )]
    public string $geom;

    #[ORM\OneToMany(
        targetEntity: "Farm",
        mappedBy: "municipality",
        cascade: ["all"]
    )]
    private Collection $farms;

    public function __construct () 
    {
        $this->farms = new Collection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return "{$this->name} - {$this->uf}";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMf(): float 
    {   
        return $this->mf;
    }

    public function addFarm(Farm $farm): self
    {
        $this->farms->add($farm);
        return $this;
    }

    public function getArea(): float
    {
        return $this->area;
    }

    public function getFarms(): Collection
    {
        return $this->farms;
    }

    public function getCodIbge(): int
    {
        return $this->cod_ibge;
    }
}