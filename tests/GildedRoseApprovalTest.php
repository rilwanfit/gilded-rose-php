<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

final class GildedRoseApprovalTest extends TestCase
{
    public function testGildedRose(): void
    {
        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            new Item('Conjured Mana Cake', 3, 6),
        ];

        $gildedRose = new GildedRose($items);

        $output = "OMGHAI!\n";
        for ($i = 0; $i < 31; $i++) {
            $output .= "-------- day {$i} --------\n";
            $output .= "name, sellIn, quality\n";
            foreach ($items as $item) {
                $output .= $item . "\n";
            }
            $gildedRose->updateQuality();
            $output .= "\n";
        }

        $this->assertStringEqualsFile(
            __DIR__ . '/approvals/ApprovalTest.testTestFixture.approved.txt',
            $output,
        );
    }
}
