<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\BackstagePassesItemUpdater;
use PHPUnit\Framework\TestCase;

final class BackstagePassesItemUpdaterTest extends TestCase
{
    public function testBackstagePassesQualityIncreasesWithAge(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertGreaterThan(10, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityIncreasesByTwoWhenThereAreTenDaysOrLess(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(22, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityIncreasesByThreeWhenThereAreFiveDaysOrLess(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(23, $backstagePasses->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterTheConcert(): void
    {
        $backstagePasses = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(0, $backstagePasses->quality);
    }
}
