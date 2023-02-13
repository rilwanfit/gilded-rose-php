<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\ConjuredItemUpdater;
use PHPUnit\Framework\TestCase;

final class ConjuredItemUpdaterTest extends TestCase
{
    public function testUpdateQuality(): void
    {
        $conjuredItem = new Item('Conjured Mana Cake', 10, 10);
        $itemUpdated = new ConjuredItemUpdater();
        $itemUpdated->update($conjuredItem);

        $this->assertSame('Conjured Mana Cake', $conjuredItem->name);
        $this->assertSame(9, $conjuredItem->quality);
    }

    public function testQualityDegradesTwiceAsFastAfterSellByDateHasPassed(): void
    {
        $conjuredAfterSellBy = new Item('Conjured Mana Cake', 0, 10);

        $itemUpdated = new ConjuredItemUpdater();
        $itemUpdated->update($conjuredAfterSellBy);

        $this->assertEquals(8, $conjuredAfterSellBy->quality);
    }
}
