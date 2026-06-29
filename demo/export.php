<?php

declare(strict_types=1);

/*
 * Static-export the AdminLTE Symfony demo to demo/dist/*.html.
 *
 * Boots DemoKernel, renders every demo template inside the real AdminLTE layout
 * (pushing each page's request path so the sidebar active-state is correct), and
 * writes self-contained HTML (CSS/JS come from the jsDelivr CDN). Templates that
 * don't exist yet are skipped, so this is safe to run incrementally.
 *
 *     php demo/export.php
 */

require \dirname(__DIR__).'/vendor/autoload.php';
require __DIR__.'/DemoKernel.php';

use App\Demo\DemoKernel;
use Symfony\Component\HttpFoundation\Request;

$slugs = [
    'dashboard-v2', 'dashboard-v3',
    'widgets-small-box', 'widgets-info-box', 'widgets-cards',
    'ui-general', 'ui-icons', 'ui-timeline',
    'forms-elements', 'forms-layout', 'forms-validation', 'forms-wizard',
    'tables-simple', 'tables-data',
    'mailbox-inbox', 'mailbox-compose', 'mailbox-read',
    'calendar', 'kanban', 'chat', 'file-manager',
    'profile', 'projects', 'invoice', 'pricing', 'settings', 'faq',
    '404', '500', 'maintenance',
    'login', 'register', 'login-v2', 'register-v2', 'lockscreen',
];

/** @var list<array{out:string,tpl:string,path:string}> $pages */
$pages = [['out' => 'index.html', 'tpl' => 'dashboard.html.twig', 'path' => '/']];
foreach ($slugs as $s) {
    $pages[] = ['out' => $s.'.html', 'tpl' => $s.'.html.twig', 'path' => '/'.$s.'.html'];
}

$kernel = new DemoKernel('prod', false);
$kernel->boot();
/** @var \Psr\Container\ContainerInterface $c */
$c = $kernel->getContainer()->get('test.service_container');
$twig = $c->get('twig');
$requestStack = $c->get('request_stack');
$router = $c->get('router');

$dist = __DIR__.'/dist';
$written = 0;
$skipped = [];

foreach ($pages as $p) {
    $tpl = '@AdminLte/demo/'.$p['tpl'];
    if (!$twig->getLoader()->exists($tpl)) {
        $skipped[] = $p['tpl'];
        continue;
    }

    $request = Request::create($p['path']);
    $requestStack->push($request);
    $router->getContext()->fromRequest($request);
    try {
        $html = $twig->render($tpl);
    } finally {
        $requestStack->pop();
    }

    $file = $dist.'/'.$p['out'];
    if (!is_dir(\dirname($file))) {
        mkdir(\dirname($file), 0o777, true);
    }
    file_put_contents($file, $html);
    ++$written;
    echo "✓ {$p['out']}\n";
}

echo "\nwrote {$written} page(s)";
if ($skipped) {
    echo '; skipped '.\count($skipped).' (no template yet): '.implode(', ', $skipped);
}
echo "\n";
