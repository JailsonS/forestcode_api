<?php

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;
use Src\Infra\Database\EntityManagerFactory;

require '../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$em = $entityManagerFactory->_getEntityManager();

$munRepository = $em->getRepository(Municipality::class);

/** @var Municipality[] $munList */
$munList = $munRepository->findAll();

foreach ($munList as $mun) {
    echo "{$mun->cod_ibge} - {$mun}" . PHP_EOL;
}
