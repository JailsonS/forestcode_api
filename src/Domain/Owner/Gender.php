<?php
namespace Src\Domain\Owner;

class Gender
{
    private string $gender;

    public function __construct(string $gender)
    {
        $this->verifyGender($gender);
    }

    private function verifyGender(string $gender): self
    {   
        $g = strtoupper($gender);

        if(strlen($g) > 1) {
            throw new \InvalidArgumentException('Formato inválido! Não é permitido mais de um caractere na definição do gênero');
        }

        if($g !== 'F' || $g !== 'M' || $g !== 'O') {
            throw new \InvalidArgumentException('Formato inválido');
        }

        $this->gender = $g;

        return $this;
    }

    public function __toString(): string
    {
        return $this->gender;
    }
}