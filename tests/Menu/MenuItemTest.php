<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Menu;

use ColorlibHQ\AdminLteBundle\Menu\MenuItem;
use PHPUnit\Framework\TestCase;

final class MenuItemTest extends TestCase
{
    public function testLeafHasNoChildren(): void
    {
        $item = new MenuItem(label: 'Dashboard', url: '/admin');

        self::assertFalse($item->hasChildren());
        self::assertSame('text-bg-secondary', $item->badgeClass);
        self::assertFalse($item->header);
    }

    public function testBranchExposesChildren(): void
    {
        $child = new MenuItem(label: 'List', url: '/admin/users');
        $parent = new MenuItem(label: 'Users', children: [$child], active: true);

        self::assertTrue($parent->hasChildren());
        self::assertTrue($parent->active);
        self::assertSame($child, $parent->children[0]);
    }

    public function testHeaderItem(): void
    {
        $header = new MenuItem(label: 'MANAGEMENT', header: true);

        self::assertTrue($header->header);
        self::assertNull($header->url);
    }
}
