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
}
