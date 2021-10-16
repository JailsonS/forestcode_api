<?php

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;
use Src\Infra\Database\EntityManagerFactory;

$emFactory = new EntityManagerFactory();
$em = $emFactory->_getEntityManager();

test('O formato do município ao qual uma propriedade está localizada de ve ser: MUNICÍPIO - UF', function() {

    // arrange
    $munRepo = $em->getRepository(Municipality::class);
    
    // act
    $municipio = $munRepo->findBy(['cod_ibge' => 1508308]);

    // assert
    $this->assertEquals($municipio, 'Vigia - PA');

});