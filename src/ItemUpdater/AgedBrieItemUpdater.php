<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class AgedBrieItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }

        $this->decreaseSellIn($item);

        $this->whenSellByDateHasPassed($item);
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }

    private function whenSellByDateHasPassed(Item $item): void
    {
        if ($item->sellIn < 0 && $item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }
}
