<?php

declare(strict_types=1);

namespace Tests\ItemUpdater;

use GildedRose\Item;
use GildedRose\ItemUpdater\NormalItemUpdater;
use PHPUnit\Framework\TestCase;

final class NormalItemUpdaterTest extends TestCase
{
    /** @test */
    public function updateQualityForNormalItem(): void
    {
        $normalItem = new Item("foo", 10, 20);
        $itemUpdated = new NormalItemUpdater();
        $itemUpdated->update($normalItem);

        $this->assertSame('foo', $normalItem->name);
        $this->assertSame(9, $normalItem->sellIn);
        $this->assertSame(19, $normalItem->quality);
    }
}
