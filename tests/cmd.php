<?php

use Src\Domain\WKTGeom;
use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;

require '../vendor/autoload.php';



$municipality = new Municipality();
$farm = new Farm('TESTE', $municipality);
$farm->addGeometry('SRID=3785;POINT(37.4220761 -122.0845187)');

$wktGeom = new WKTGeom($farm);
$wktGeom->isValidGeom();