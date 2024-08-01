<?php

namespace Fred\IceBomb\item;

use Fred\IceBomb\item\IceBomb;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static IceBomb ICE_BOMB()
 */
class IBVanillaItems
{
    use CloningRegistryTrait;

    private function __construct()
    {
        //NOOP
    }

    /**
     * @param string $name
     * @param Item $item
     * @return void
     */
    protected static function register(string $name, Item $item): void
    {
        self::_registryRegister($name, $item);
    }

    /**
     * @return Item[]
     */
    public static function getAll(): array
    {
        /** @var Item[] $result */
        $result = self::_registryGetAll();
        return $result;
    }

    /**
     * @return void
     */
    protected static function setup(): void
    {
        self::register(
            "ice_bomb",
            new IceBomb(new ItemIdentifier(ItemTypeIds::newId()), "Ice Bomb")
        );
    }
}
