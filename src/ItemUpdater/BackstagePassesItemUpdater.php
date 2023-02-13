<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class BackstagePassesItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        $item->quality = $this->incrementQuality($item->sellIn, $item->quality);

        $this->decreaseSellIn($item);

        $this->whenSellByDateHasPassed($item);
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }

    private function whenSellByDateHasPassed(Item $item): void
    {
        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }

    private function incrementQuality(int $sellIn, int $quality): int
    {
        $qualityIncrement = 1;

        if ($sellIn < 11) {
            $qualityIncrement++;
        }

        if ($sellIn < 6) {
            $qualityIncrement++;
        }

        return min(50, $quality + $qualityIncrement);
    }
}
