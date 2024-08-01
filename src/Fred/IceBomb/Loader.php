<?php

declare(strict_types=1);

namespace Fred\IceBomb;

use Fred\IceBomb\item\IceBomb;
use Fred\IceBomb\item\IBVanillaItems;
use Fred\IceBomb\entity\IceBomb as IceBombEntity;

use pocketmine\entity\EntityDataHelper as Helper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\StringToItemParser;
use pocketmine\data\bedrock\item\ItemTypeNames;
use pocketmine\data\bedrock\item\SavedItemData;
use pocketmine\world\format\io\GlobalItemDataHandlers;
use pocketmine\inventory\CreativeInventory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class Loader extends PluginBase
{
    public function onEnable(): void
    {
        $itemDeserializer = GlobalItemDataHandlers::getDeserializer();
        $itemSerializer = GlobalItemDataHandlers::getSerializer();
        $stringToItemParser = StringToItemParser::getInstance();
        $creativeInventory = CreativeInventory::getInstance();

        $ice_bomb = IBVanillaItems::ICE_BOMB();
        $itemDeserializer->map(
            ItemTypeNames::ICE_BOMB,
            static fn() => clone $ice_bomb
        );
        $itemSerializer->map(
            $ice_bomb,
            static fn() => new SavedItemData(ItemTypeNames::ICE_BOMB)
        );
        $stringToItemParser->register(
            "ice_bomb",
            static fn() => clone $ice_bomb
        );
        $creativeInventory->add(IBVanillaItems::ICE_BOMB());

        EntityFactory::getInstance()->register(
            IceBombEntity::class,
            function (World $world, CompoundTag $nbt): IceBombEntity {
                return new IceBombEntity(
                    Helper::parseLocation($nbt, $world),
                    null,
                    $nbt
                );
            },
            ["minecraft:ice_bomb"]
        );
    }
}
