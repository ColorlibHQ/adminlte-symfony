<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Menu;

use ColorlibHQ\AdminLteBundle\Menu\MenuBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class MenuBuilderTest extends TestCase
{
    public function testResolvesRoutesAndDetectsActiveItem(): void
    {
        $builder = $this->builder([
            ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'bi bi-speedometer2'],
            ['label' => 'Settings', 'route' => 'settings'],
        ], currentPath: '/admin/dashboard');

        $items = $builder->build();

        self::assertCount(2, $items);
        self::assertSame('/admin/dashboard', $items[0]->url);
        self::assertTrue($items[0]->active, 'Item matching the current path is active');
        self::assertFalse($items[1]->active);
    }

    public function testHeaderItem(): void
    {
        $items = $this->builder([['header' => 'MANAGEMENT']])->build();

        self::assertTrue($items[0]->header);
        self::assertSame('MANAGEMENT', $items[0]->label);
    }

    public function testBranchIsActiveWhenChildIsActive(): void
    {
        $builder = $this->builder([
            [
                'label' => 'Users',
                'children' => [
                    ['label' => 'List', 'route' => 'users_list'],
                ],
            ],
        ], currentPath: '/admin/users_list');

        $parent = $builder->build()[0];

        self::assertTrue($parent->hasChildren());
        self::assertTrue($parent->active, 'Parent is active because a child is active');
        self::assertTrue($parent->children[0]->active);
    }

    public function testExternalUrlAndBadgePreserved(): void
    {
        $items = $this->builder([
            ['label' => 'Docs', 'url' => 'https://adminlte.io', 'target' => '_blank', 'badge' => 'new', 'badge_class' => 'text-bg-success'],
        ])->build();

        self::assertSame('https://adminlte.io', $items[0]->url);
        self::assertSame('_blank', $items[0]->target);
        self::assertSame('new', $items[0]->badge);
        self::assertSame('text-bg-success', $items[0]->badgeClass);
    }

    public function testPermissionFiltersDeniedItems(): void
    {
        $checker = $this->createMock(AuthorizationCheckerInterface::class);
        $checker->method('isGranted')->willReturnCallback(
            static fn (mixed $attribute): bool => 'ROLE_ADMIN' === $attribute
        );

        $builder = $this->builder([
            ['label' => 'Admin area', 'route' => 'admin', 'permission' => 'ROLE_ADMIN'],
            ['label' => 'Secret', 'route' => 'secret', 'permission' => 'ROLE_SUPER'],
        ], authChecker: $checker);

        $items = $builder->build();

        self::assertCount(1, $items, 'Only granted items survive');
        self::assertSame('Admin area', $items[0]->label);
    }

    public function testPermissionIgnoredWhenNoSecurity(): void
    {
        $items = $this->builder([
            ['label' => 'Admin area', 'route' => 'admin', 'permission' => 'ROLE_ADMIN'],
        ])->build();

        self::assertCount(1, $items, 'Without an authorization checker, permissions are not enforced');
    }

    /**
     * @param array<int, array<string, mixed>> $menu
     */
    private function builder(array $menu, string $currentPath = '/', ?AuthorizationCheckerInterface $authChecker = null): MenuBuilder
    {
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->method('generate')->willReturnCallback(
            static fn (string $route): string => '/admin/'.$route
        );

        $requestStack = new RequestStack();
        $requestStack->push(Request::create($currentPath));

        return new MenuBuilder($urlGenerator, $requestStack, $authChecker, $menu);
    }
}
