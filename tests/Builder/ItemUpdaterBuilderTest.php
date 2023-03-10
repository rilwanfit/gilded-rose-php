<?php

declare(strict_types=1);

namespace Tests\Builder;

use GildedRose\Builder\ItemUpdaterBuilder;
use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use GildedRose\ItemUpdater\BackstagePassesItemUpdater;
use GildedRose\ItemUpdater\ItemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;
use PHPUnit\Framework\TestCase;

final class ItemUpdaterBuilderTest extends TestCase
{
    /**
     * @dataProvider data()
     * @param class-string<ItemUpdater> $expectedClass
     */
    public function testBuildByItemName(string $itemName, $expectedClass): void
    {
        $itemUpdater = ItemUpdaterBuilder::buildByItemName($itemName);
        $this->assertInstanceOf($expectedClass, $itemUpdater);
    }

    public function data(): iterable
    {
        yield [
            'itemName' => 'Aged Brie',
            'expectedClass' => AgedBrieItemUpdater::class,
        ];

        yield [
            'itemName' => 'Backstage passes to a TAFKAL80ETC concert',
            'expectedClass' => BackstagePassesItemUpdater::class,
        ];

        yield [
            'itemName' => 'Sulfuras, Hand of Ragnaros',
            'expectedClass' => SulfurasItemUpdater::class,
        ];

        yield [
            'itemName' => 'Any other',
            'expectedClass' => NormalItemUpdater::class,
        ];
    }
}
