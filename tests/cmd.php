<?php

use Src\Domain\Farm\Farm;
use Src\Infra\Http\HttpCurl;
use Src\Domain\Farm\Municipality;
use Src\Infra\Database\EntityManagerFactory;
use Src\Domain\Farm\Repository\FarmRepository;
use Src\Infra\Services\Inpe\DeforestationInpe;

require '../vendor/autoload.php';

/*
$entityManagerFactory = new EntityManagerFactory();
$em = $entityManagerFactory->_getEntityManager();

$munRepo = $em->getRepository(Municipality::class);
$municipio = $munRepo->findOneBy(['cod_ibge' => 1508308]);

$farmRepo = $em->getRepository(Farm::class);
$farmRepo->addFarm('Sitio Santa Luzia', $municipio, 'SRID=5641;POLYGON((743238 2967416,743238 2967450,743265 2967450,743265.625 2967416,743238 2967416))');
*/

$http = new HttpCurl();
$df = new DeforestationInpe($http);

//print_r($df->listApplications();

print_r($df->configPeriods('prodes_amazon'));
