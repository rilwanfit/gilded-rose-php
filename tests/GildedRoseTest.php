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

    /** @test */
    public function agedBrieQualityIncreasesWithAge()
    {
        $agedBrie = new Item("Aged Brie", 10, 10);

        $gildedRose = new GildedRose([$agedBrie]);
        $gildedRose->updateQuality();

        $this->assertGreaterThan(10, $agedBrie->quality);
    }

    /** @test */
    public function qualityNeverIncreasesAboveFifty()
    {
        $normalItem = new Item("foo", 5, 50);

        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertLessThanOrEqual(50, $normalItem->quality);
    }

    /** @test */
    public function sulfurasSellInOrQualityNeverAlters()
    {
        $sulfurasItem = new Item("Sulfuras, Hand of Ragnaros", 5, 80);

        $gildedRose = new GildedRose([$sulfurasItem]);
        $gildedRose->updateQuality();

        $this->assertSame(5, $sulfurasItem->sellIn);
        $this->assertSame(80, $sulfurasItem->quality);
    }

    /** @test */
    public function backstagePassesQualityIncreasesWithAge()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertGreaterThan(10, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityIncreasesByTwoWhenThereAreTenDaysOrLess()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(22, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityIncreasesByThreeWhenThereAreFiveDaysOrLess()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(23, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityDropsToZeroAfterTheConcert()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(0, $backstagePasses->quality);
    }
}
