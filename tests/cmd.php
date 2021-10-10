<?php

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;

require '../vendor/autoload.php';


$municipality = new Municipality();
$farm = new Farm('TESTE', $municipality);
