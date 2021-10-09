<?php
namespace Src\Domain\Farm\Repository;

use Src\Domain\Farm\Farm;
use Doctrine\Common\Collections\Collection;

interface FarmRepositoryInterface
{
   // public function findAll(): Collection;

    public function addFarm(Farm $farm): void;

    public function calculateArea(Farm $farm): Farm;
}