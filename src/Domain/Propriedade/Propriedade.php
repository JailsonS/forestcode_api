<?php
namespace Src\Domain\Propriedade;

use Doctrine\ORM\Mapping as ORM;
use Src\Domain\Propriedade\Municipio;
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

    #[ORM\ManyToOne(targetEntity: "Municipio", cascade: ["all"], fetch: "EAGER")]
    private Municipio $municipio;


    public function __construct(string $nome, Municipio $municipio) 
    {
        $this->nome = $nome;
        $this->municipio = $municipio;
    }


    public function nome(): string
    {
        return $this->nome;
    }

    public function area(): string
    {
        return $this->area;
    }

    public function municipio(): string
    {
        return $this->municipio;
    }

    public function addNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function addArea(float $area): self
    {
        $this->area = $area;
        /*
         * calcula automaticamente o módulo fiscal da propriedade
         * $var mf da propriedade = área da propriedade / módulo fiscal do município
        */
        $this->mf = $area / $this->municipio->mf;

        return $this;
    }
    
}