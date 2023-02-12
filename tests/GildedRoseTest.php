<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /** @test */
    public function updateQualityForNormalItem(): void
    {
        $normalItem = new Item("foo", 10, 20);
        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertSame('foo', $normalItem->name);
        $this->assertSame(9, $normalItem->sellIn);
        $this->assertSame(19, $normalItem->quality);
    }

    /** @test */
    public function qualityDegradesTwiceAsFastAfterSellByDateHasPassed()
    {
        $itemBeforeSellBy = new Item("Normal Item", 5, 10);
        $itemAfterSellBy = new Item("Normal Item", 0, 10);

        $gildedRose = new GildedRose([$itemBeforeSellBy, $itemAfterSellBy]);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $itemBeforeSellBy->quality);
        $this->assertEquals(8, $itemAfterSellBy->quality);
    }

    /** @test */
    public function qualityNeverNegative()
    {
        $normalItem = new Item("foo", 5, 0);

        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $normalItem->quality);
    }
}
