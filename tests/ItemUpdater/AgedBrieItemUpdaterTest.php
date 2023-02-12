<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use PHPUnit\Framework\TestCase;

final class AgedBrieItemUpdaterTest extends TestCase
{
    /** @test */
    public function agedBrieQualityIncreasesWithAge()
    {
        $agedBrie = new Item("Aged Brie", 10, 10);
        $itemUpdated = new AgedBrieItemUpdater();
        $itemUpdated->update($agedBrie);

        $this->assertGreaterThan(10, $agedBrie->quality);
    }
}
