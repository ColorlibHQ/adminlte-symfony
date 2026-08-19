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
- Widget Twig Components: `Card`, `SmallBox`, `InfoBox`, `Alert`, `Callout`, `Progress`,
  `ProgressGroup`, `Timeline` + `TimelineItem`, `ProfileCard`, `DescriptionBlock`,
  `Breadcrumb`, `Ratings`, `Toast`, `Modal`, `Accordion` + `AccordionItem`, `Tabs`,
  `NavNotifications`, `NavMessages`, `NavTasks`, and a ⌘K `CommandPalette` indexed from
  the sidebar menu — parity with the Vue/React component inventory.
- Form Twig Components: `Button`, `Input`, `Select`, `Textarea`, `InputSwitch`,
  `InputColor`, `InputFile`.
- Config-driven sidebar menu with active-route detection and a `permission` security filter.
- SSR-safe color/dark-mode toggle (no flash of incorrect theme) persisted to `localStorage`.
- Optional **AdminLTE theme for EasyAdmin** (`templates/bundles/EasyAdminBundle`).

### Changed
- Pinned the CDN links in every layout, demo template and the EasyAdmin theme to
  **admin-lte 4.8.1** (was 4.0.2), and the demo footer version with them. Core has
  shipped a lot since 4.0.2 and all of it is now available to this bundle without a
  markup change:
  - **4.4.0** — opt-in extended palette (`dist/css/adminlte-colors.css`, 14 colours
    plus the matching sidebar/navbar skins), restyled header search, sidebar height fix.
  - **4.5.0** — `dist/css/adminlte-colors-v3.css`, the 18 AdminLTE 3 colours exactly
    as they were, for ports of v3 apps.
  - **4.6.0** — `data-lte-primary="teal"` on `<html>` promotes any palette colour to
    Bootstrap's `primary` (buttons, links, pagination, form focus rings).
  - **4.7.0** — `data-lte-print="plain"` for pages meant to print as documents.
  - **4.8.0** — `data-lte-contrast="aa"` for WCAG AA text on the v3 palette.
  - **4.8.1** — pagination focus-ring fix.

  The two palette stylesheets are additive and opt-in: add the one you want next to
  `adminlte.min.css` in the `stylesheets` block. Nothing in the bundle's own markup
  changed, so existing overrides keep working.

[Unreleased]: https://github.com/ColorlibHQ/adminlte-symfony/commits/main
