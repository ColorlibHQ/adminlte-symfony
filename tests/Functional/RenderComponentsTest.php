<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

final class RenderComponentsTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public function testFullDashboardRenders(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        // Give the menu/active-state logic a current request.
        $container->get('request_stack')->push(Request::create('/admin'));

        /** @var Environment $twig */
        $twig = $container->get('twig');
        $html = $twig->render('@AdminLte/demo/dashboard.html.twig');

        // Layout shell
        self::assertStringContainsString('class="app-wrapper"', $html);
        self::assertStringContainsString('app-header navbar', $html);
        self::assertStringContainsString('app-sidebar', $html);
        self::assertStringContainsString('app-footer', $html);
        self::assertStringContainsString('data-bs-theme', $html);

        // Widgets from the demo
        self::assertStringContainsString('small-box', $html);
        self::assertStringContainsString('New Orders', $html);
        self::assertStringContainsString('info-box', $html);
        self::assertStringContainsString('card card-primary card-outline', $html);

        // Footer config came through
        self::assertStringContainsString('v1.0.0', $html);
    }

    public function testSidebarMenuRendersConfigDrivenItems(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        $container->get('request_stack')->push(Request::create('/admin'));

        /** @var Environment $twig */
        $twig = $container->get('twig');
        $html = $twig->createTemplate('<twig:Adminlte:Sidebar />')->render();

        self::assertStringContainsString('nav-header', $html); // the "MANAGEMENT" header item
        self::assertStringContainsString('Dashboard', $html);
        self::assertStringContainsString('nav-treeview', $html); // the Users submenu
        self::assertStringContainsString('nav-badge', $html); // the "12" badge
        self::assertStringContainsString('target="_blank"', $html); // the external Docs link
        // The dashboard route ("/admin") matches the current request → active.
        self::assertMatchesRegularExpression('/nav-link active[^>]*>\s*<i class="nav-icon bi bi-speedometer2/', $html);
    }

    public function testStandaloneComponentRenders(): void
    {
        self::bootKernel();
        /** @var Environment $twig */
        $twig = self::getContainer()->get('twig');

        $html = $twig->createTemplate(
            '<twig:Adminlte:SmallBox title="150" text="Orders" variant="success" icon="bi bi-bag" url="/x" />'
        )->render();

        self::assertStringContainsString('small-box text-bg-success', $html);
        self::assertStringContainsString('<h3>150</h3>', $html);
        self::assertStringContainsString('small-box-footer', $html);
    }

    public function testParityComponentsRender(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        $container->get('request_stack')->push(Request::create('/admin'));

        /** @var Environment $twig */
        $twig = $container->get('twig');

        $template = <<<'TWIG'
            <twig:Adminlte:Callout variant="warning" title="Note">body</twig:Adminlte:Callout>
            <twig:Adminlte:Progress :value="70" variant="success" showLabel />
            <twig:Adminlte:ProgressGroup label="Cart" :current="160" :total="200" />
            <twig:Adminlte:Timeline>
                <twig:Adminlte:TimelineItem icon="bi bi-envelope" variant="info" time="12:05" header="Mail">b</twig:Adminlte:TimelineItem>
            </twig:Adminlte:Timeline>
            <twig:Adminlte:ProfileCard name="Jane" title="Dev" image="/u.jpg" />
            <twig:Adminlte:DescriptionBlock header="$35K" text="Revenue" percentage="17%" trend="up" />
            <twig:Adminlte:Breadcrumb :items="[{ label: 'Home', url: '/' }, { label: 'Now', active: true }]" />
            <twig:Adminlte:Ratings :value="3.5" showValue />
            <twig:Adminlte:Toast title="Hi" variant="primary">msg</twig:Adminlte:Toast>
            <twig:Adminlte:Modal id="m1" title="Confirm">sure?</twig:Adminlte:Modal>
            <twig:Adminlte:Accordion id="acc">
                <twig:Adminlte:AccordionItem id="a1" parent="acc" title="Q" open>A</twig:Adminlte:AccordionItem>
            </twig:Adminlte:Accordion>
            <twig:Adminlte:Tabs id="t" :items="[{ id: 'h', title: 'Home', content: '<p>hi</p>', active: true }]" />
            <twig:Adminlte:NavNotifications badge="3" :items="[{ icon: 'bi bi-envelope', text: '4 msgs', time: '3m' }]" />
            <twig:Adminlte:NavMessages badge="2" :items="[{ name: 'Brad', message: 'Call me', time: '4h' }]" />
            <twig:Adminlte:NavTasks badge="5" :items="[{ text: 'Design', progress: 20, variant: 'danger' }]" />
            <twig:Adminlte:CommandPalette />
            <twig:Adminlte:Select name="role" label="Role" value="b" :options="[{ value: 'a', label: 'A' }, { value: 'b', label: 'B' }]" />
            <twig:Adminlte:Textarea name="bio" label="Bio" :rows="4" />
            <twig:Adminlte:InputSwitch name="notify" label="Notify" checked />
            <twig:Adminlte:InputColor name="accent" label="Colour" value="#0d6efd" />
            <twig:Adminlte:InputFile name="avatar" label="Avatar" accept="image/*" />
            TWIG;

        $html = $twig->createTemplate($template)->render();

        $markers = [
            'callout callout-warning', 'progress-bar bg-success', 'progress-group', 'timeline',
            'box-profile', 'description-block', 'breadcrumb', 'bi-star', 'toast', 'modal fade',
            'accordion', 'nav-tabs', 'navbar-badge', 'adminlte-command-palette', 'form-select',
            'form-switch', 'form-control-color', 'type="file"',
        ];
        foreach ($markers as $marker) {
            self::assertStringContainsString($marker, $html, "Expected markup for: {$marker}");
        }

        // The command palette indexed the config-driven menu (Dashboard route + the Users submenu).
        self::assertStringContainsString('data-label="dashboard', $html);
    }
}
