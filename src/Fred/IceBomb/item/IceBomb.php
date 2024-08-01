<?php

declare(strict_types=1);

namespace Fred\IceBomb\item;

use Fred\IceBomb\entity\IceBomb as IceBombEntity;

use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ProjectileItem;
use pocketmine\player\Player;

class IceBomb extends ProjectileItem
{
    public function getMaxStackSize(): int
    {
        return 16;
    }

    protected function createEntity(
        Location $location,
        Player $thrower
    ): Throwable {
        return new IceBombEntity($location, $thrower);
    }

    public function getThrowForce(): float
    {
        return 1.5;
    }

    public function getCooldownTicks(): int
    {
        return 10;
    }
}
