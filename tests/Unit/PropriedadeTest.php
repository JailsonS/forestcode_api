<?php

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;
use Src\Domain\Farm\Repository\FarmRepository;
use Src\Infra\Database\EntityManagerFactory;


beforeEach(function () {
    $this->emFactory = new EntityManagerFactory();
    $this->em = $emFactory->_getEntityManager();
});


afterEach(function () {
    $this->em->clear();
});

test('O formato do município ao qual uma propriedade está localizada de ve ser: MUNICÍPIO - UF', function() {

    // arrange
    $munRepo = $this->em->getRepository(Municipality::class);
    
    // act
    $municipio = $munRepo->findBy(['cod_ibge' => 1508308]);

    // assert
    $this->assertEquals($municipio, 'Vigia - PA');

});