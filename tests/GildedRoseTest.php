<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testUpdateQualityForNormalItem(): void
    {
        $normalItem = new Item('foo', 10, 20);
        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertSame('foo', $normalItem->name);
        $this->assertSame(9, $normalItem->sellIn);
        $this->assertSame(19, $normalItem->quality);
    }

    public function testQualityDegradesTwiceAsFastAfterSellByDateHasPassed(): void
    {
        $itemBeforeSellBy = new Item('Normal Item', 5, 10);
        $itemAfterSellBy = new Item('Normal Item', 0, 10);

        $gildedRose = new GildedRose([$itemBeforeSellBy, $itemAfterSellBy]);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $itemBeforeSellBy->quality);
        $this->assertEquals(8, $itemAfterSellBy->quality);
    }

    public function testQualityNeverNegative(): void
    {
        $normalItem = new Item('foo', 5, 0);

        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $normalItem->quality);
    }

    public function testAgedBrieQualityIncreasesWithAge(): void
    {
        $agedBrie = new Item('Aged Brie', 10, 10);

        $gildedRose = new GildedRose([$agedBrie]);
        $gildedRose->updateQuality();

        $this->assertGreaterThan(10, $agedBrie->quality);
    }

    public function testQualityNeverIncreasesAboveFifty(): void
    {
        $normalItem = new Item('foo', 5, 50);

        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertLessThanOrEqual(50, $normalItem->quality);
    }

    public function testSulfurasSellInOrQualityNeverAlters(): void
    {
        $sulfurasItem = new Item('Sulfuras, Hand of Ragnaros', 5, 80);

        $gildedRose = new GildedRose([$sulfurasItem]);
        $gildedRose->updateQuality();

        $this->assertSame(5, $sulfurasItem->sellIn);
        $this->assertSame(80, $sulfurasItem->quality);
    }

    public function testBackstagePassesQualityIncreasesWithAge(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertGreaterThan(10, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityIncreasesByTwoWhenThereAreTenDaysOrLess(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(22, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityIncreasesByThreeWhenThereAreFiveDaysOrLess(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(23, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterTheConcert(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20);

        $gildedRose = new GildedRose([$backstagePasses]);
        $gildedRose->updateQuality();

        $this->assertSame(0, $backstagePasses->quality);
    }

    public function testConjuredQualityDegradesTwiceAsFastAsNormalItem(): void
    {
        $this->markTestSkipped();
        $normalItem = new Item('foo', 10, 10);
        $conjuredItem = new Item('Conjured Mana Cake,', 10, 10);

        $gildedRose = new GildedRose([$normalItem, $conjuredItem]);
        $gildedRose->updateQuality();

        $this->assertSame(9, $normalItem->quality);
        $this->assertSame(8, $conjuredItem->quality);
    }
}
