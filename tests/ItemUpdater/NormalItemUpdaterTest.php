<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\NormalItemUpdater;
use PHPUnit\Framework\TestCase;

final class NormalItemUpdaterTest extends TestCase
{
    public function testUpdateQualityForNormalItem(): void
    {
        $normalItem = new Item('foo', 10, 20);
        $itemUpdated = new NormalItemUpdater();
        $itemUpdated->update($normalItem);

        $this->assertSame('foo', $normalItem->name);
        $this->assertSame(9, $normalItem->sellIn);
        $this->assertSame(19, $normalItem->quality);
    }

    public function testQualityDegradesTwiceAsFastAfterSellByDateHasPassed(): void
    {
        $itemAfterSellBy = new Item('Normal Item', 0, 10);

        $itemUpdated = new NormalItemUpdater();
        $itemUpdated->update($itemAfterSellBy);

        $this->assertEquals(8, $itemAfterSellBy->quality);
    }
}
