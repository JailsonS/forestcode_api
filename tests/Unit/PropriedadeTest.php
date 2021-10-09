<?php

use Src\Domain\Propriedade\Municipio;
use Src\Domain\Propriedade\Propriedade;

test('O formato do município ao qual uma propriedade está localizada de ve ser: MUNICÍPIO - UF', function() {

    // arrange
    $municipio = new Municipio(1, 'CASTANHAL', 'PA', 75);
    $propriedade = new Propriedade('Sítio Bela Moça', $municipio);

    // act
    $nomeMunicipio = $propriedade->municipio();
    $nomeMunicipioEsperado = 'CASTANHAL - PA';

    // assert
    $this->assertSame($nomeMunicipio, $nomeMunicipioEsperado);
});
