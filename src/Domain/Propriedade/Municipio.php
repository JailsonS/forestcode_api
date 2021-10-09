<?php
namespace Src\Domain\Propriedade;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Jsor\Doctrine\PostGIS\Types\PostGISType;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class Municipio
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(type: "integer", nullable:false)]
    public int $cod_ibge;

    #[ORM\Column(type: "string", nullable:false, length: 150)]
    public string $nome;

    #[ORM\Column(type: "string", columnDefinition: "CHAR(2) NOT NULL")]
    public string $uf;

    #[ORM\Column(type: "float", precision: 4, nullable:false)]
    public float $mf;

    #[ORM\OneToMany(
        targetEntity: "Propriedade",
        mappedBy: "municipio",
        cascade: ["all"]
    )]
    private ArrayCollection $propriedades;

    public function __construct (int $codIgbe, string $nome, string $uf, float $mf) 
    {
        $this->cod_ibge = $codIgbe;
        $this->nome = $nome;
        $this->uf = $uf;
        $this->mf = $mf;
        $this->propriedade = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return "{$this->nome} - {$this->uf}";
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function mf(): float 
    {   
        return $this->mf;
    }

    public function addPropriedade(Propriedade $propriedade): self
    {
        $this->propriedades-add($propriedade);
        return $this;
    }

    public function propriedades(): Collection
    {
        return $this->propriedades;
    }
}