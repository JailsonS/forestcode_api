<?php
namespace Src\Domain\Propriedade;

use Doctrine\ORM\Mapping as ORM;
use Jsor\Doctrine\PostGIS\Types\PostGISType;


class Municipios
{

    private int $id;


    private int $cod_ibge;


    private string $nome;

    
    private string $uf;
}