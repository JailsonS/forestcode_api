<?php
namespace Src\Domain\Owner;

use Src\Domain\Owner\Gender;
use Doctrine\ORM\Mapping as ORM;
use Src\Domain\Farm\Municipality;

class Owner
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(type: "string", nullable:false, length: 150)]
    private string $name;

    #[ORM\Column(type: "string", columnDefinition: "CHAR(1) NOT NULL")]
    private Gender $gender;

    #[ORM\OneToMany(
        targetEntity: "Farm",
        mappedBy: "owner",
        cascade: ["all"]
    )]
    private Collection $farms;

    public function __construct(string $name, Gender $gender)
    {
        $this->name = $name;
        $this->gender = $gender;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getFarms(): Collection
    {
        return $this->farms;
    }
}