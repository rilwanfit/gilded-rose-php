<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use GildedRose\ItemUpdater\BackstagePassesItemUpdater;
use PHPUnit\Framework\TestCase;

final class BackstagePassesItemUpdaterTest extends TestCase
{
    /** @test */
    public function backstagePassesQualityIncreasesWithAge()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertGreaterThan(10, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityIncreasesByTwoWhenThereAreTenDaysOrLess()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(22, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityIncreasesByThreeWhenThereAreFiveDaysOrLess()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(23, $backstagePasses->quality);
    }

    /** @test */
    public function backstagePassesQualityDropsToZeroAfterTheConcert()
    {
        $this->markTestSkipped();
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 20);

        $itemUpdater = new BackstagePassesItemUpdater();
        $itemUpdater->update($backstagePasses);

        $this->assertSame(0, $backstagePasses->quality);
    }
}
