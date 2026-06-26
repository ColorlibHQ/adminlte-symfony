# Changelog

All notable changes to `colorlibhq/adminlte-symfony` are documented here.
The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Initial Symfony 8.1 bundle targeting AdminLTE 4 + Bootstrap 5.3.
- AssetMapper-first asset pipeline (no Webpack Encore required).
- Twig Components for the layout shell (`DashboardLayout`, `Sidebar`, `SidebarNav`,
  `SidebarNavItem`, `Topbar`, `Footer`, `ColorModeToggle`).
- Widget Twig Components: `Card`, `SmallBox`, `InfoBox`, `Alert`.
- Form Twig Components: `Button`, `Input`.
- Config-driven sidebar menu with active-route detection and a `permission` security filter.
- SSR-safe color/dark-mode toggle (no flash of incorrect theme) persisted to `localStorage`.
- Optional **AdminLTE theme for EasyAdmin** (`templates/bundles/EasyAdminBundle`).

[Unreleased]: https://github.com/ColorlibHQ/adminlte-symfony/commits/main
