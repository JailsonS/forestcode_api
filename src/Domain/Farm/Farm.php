<?php
namespace Src\Domain\Farm;

use Doctrine\ORM\Mapping as ORM;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;
use Jsor\Doctrine\PostGIS\Types\PostGISType;

#[ORM\Entity(repositoryClass: FarmRepository::class, readOnly: false)]
class Farm
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(type: "string", nullable:false, length: 150)]
    private string $name;

    /** @var area is in hactares */
    #[ORM\Column(type: "float", precision:4, nullable:true)]
    private float $area;
    
    #[ORM\Column(type:"float", precision:4, nullable:true)]
    private float $mf;

    #[ORM\ManyToOne(targetEntity: "Municipality", cascade: ["all"], fetch: "EAGER")]
    private Municipality $municipality;

    #[ORM\Column(
        type: PostGISType::GEOMETRY, 
        options: ['geometry_type' => 'POLYGON', 'srid' => 5641],
    )]
    private string $geom;


    public function __construct(string $name, Municipality $municipality) 
    {
        $this->name = $name;
        $this->municipality = $municipality;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getGeom(): string
    {
        $geom = explode(';', $this->geom);

        return $geom[1];
    }

    public function getSrid(): string
    {
        $geom = explode(';', $this->geom);
        $srid = explode('=', $geom[0]);
        return $srid[1];
    }

    public function getMunicipality(): string
    {
        return $this->municipality;
    }

    public function addGeometry(string $geom): self
    {
        $this->geom = $geom;
        return $this;
    }

    public function addArea(float $area): self
    {   
        $this->area = $area;
        return $this;
    }

    public function calculateMf(): self
    {
        if(!$this->municipality || !$this->area) {
            throw new \DomainException('É necessário que a área e o módulos fiscal do município estejam calculados');
        }

        /**
         * @var mf (módulo fiscal) é igual a área da propriedade em hectares divida pelo valor do mf do município
         */
        $this->mf = $this->area / $this->municipality->mf;
        return $this;
    }
    
}