<?php

declare(strict_types=1);

namespace GildedRose\Builder;

use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use GildedRose\ItemUpdater\BackstagePassesItemUpdater;
use GildedRose\ItemUpdater\ItemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

final class ItemUpdaterBuilder
{
    public static function buildByItemName(string $itemName): ItemUpdater
    {
        return match ($itemName) {
            'Aged Brie' => new AgedBrieItemUpdater(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassesItemUpdater(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasItemUpdater(),
            default => new NormalItemUpdater()
        };
    }
}
