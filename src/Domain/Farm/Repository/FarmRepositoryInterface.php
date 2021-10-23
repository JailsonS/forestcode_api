<?php
namespace Src\Domain\Farm\Repository;

use Src\Domain\Farm\Farm;
use Src\Domain\Farm\Municipality;

interface FarmRepositoryInterface
{
   // public function findAll(): mixed;

    public function addFarm(string $farmName, Municipality $municipality, string $geom);

    public function calculateArea(Farm $farm);

    //public function uploadFarms(string|array $files): void;
}