<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\SulfurasItemUpdater;
use PHPUnit\Framework\TestCase;

final class SulfurasItemUpdaterTest extends TestCase
{
    /** @test */
    public function sulfurasSellInOrQualityNeverAlters()
    {
        $sulfurasItem = new Item("Sulfuras, Hand of Ragnaros", 5, 80);

        $itemUpdated = new SulfurasItemUpdater();
        $itemUpdated->update($sulfurasItem);

        $this->assertSame(5, $sulfurasItem->sellIn);
        $this->assertSame(80, $sulfurasItem->quality);
    }

}
