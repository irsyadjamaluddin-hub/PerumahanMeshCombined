# MESH Dark Mode: where everything is

Added October 2026. A sun/moon switch sits in the header, just left of the announcements bell. Light is the default. The user's choice is saved in their browser (`localStorage` key `mesh-theme`) and kept across pages and visits.

Every change is marked in the code with `#========== NEWLY ADDED ============`. Original code that was replaced is kept, commented out, inside `#============= ORI CODE ==============`.

## How it works

1. `inc/theme-head.blade.php` runs at the end of `<head>`. If the saved choice is dark, it sets `data-mesh-theme="dark"` on `<html>` before the page appears. It also loads `public/css/mesh-dark.css`.
2. The layout gives `<body>` the class `mesh-dark-ready`.
3. Dark styles apply only when both are present: `html[data-mesh-theme="dark"]` and `body.mesh-dark-ready`.
4. Clicking the switch (`inc/theme-toggle.blade.php`) runs the handler in `public/js/mesh-v4.js`. It flips the attribute and saves the choice.

**Keeping one page light:** add `@section('mesh_dark_off', '1')` to that page. It stays light and the switch is hidden on it.

## New files

| File | What it holds |
|---|---|
| `resources/views/inc/theme-head.blade.php` | Saved-choice script and the `mesh-dark.css` link. Included last in `<head>`. |
| `resources/views/inc/theme-toggle.blade.php` | The sun/moon switch button. Included in the header, left of the bell. |
| `public/css/mesh-dark.css` | Dark styles for the parts every page shares: cards, tables, DataTables, simple-datatables, forms, buttons, dropdowns, popups, bell announcement popups, alerts, tabs, accordions, list groups, pagination, badges, Tailwind grey classes, Select2, bootstrap-select, date pickers, Quill, CKEditor 5, TinyMCE toolbar, Dropzone and ApexCharts. |
| `DARK-MODE-NOTES.md` | This file. |

## Changed files

| File | Change |
|---|---|
| `resources/views/layouts/app-all.blade.php` | Includes `inc.theme-head` before `</head>`. `<body>` gets `mesh-dark-ready`; the original `<body>` line is kept as ORI CODE. Includes `inc.theme-toggle` in the header, left of the bell. |
| `resources/views/layouts/app-pdms.blade.php` | Same three changes as `app-all`. |
| `public/css/mesh-v4.css` | "Dark mode" section at the end of the file: the colour tokens (`--mesh-d-*`), the switch's sun/moon icons, and the dark header, profile menu, bell panel, sidebar, footer and back-to-top button. |
| `public/js/mesh-v4.js` | Light/dark switch click handler, at the top of the `$(function () { ... })` block. |
| `resources/views/inc/home-greeting.blade.php` | Dark greeting banner, Services search, service cards and service popups, at the end of its `<style>` block. Used by Home and PDMS Home. |

`public/assets/css/admin.css` and the vendor CSS files are **not** changed. `mesh-dark.css` overrides them.

## Colours

| Token | Value | Used for |
|---|---|---|
| `--mesh-d-bg` | `#0a0e18` | Page background |
| `--mesh-d-surface` | `#121829` | Header, footer, cards, popups |
| `--mesh-d-raised` | `#161e34` | Table headers, dropdowns, card headers |
| `--mesh-d-input` | `#0f1525` | Form fields |
| `--mesh-d-card` | `#1c1340` | Home service cards |
| `--mesh-d-card-border` | `#3a2768` | Home service card borders |
| `--mesh-d-border` | `#232c45` | Lines and borders |
| `--mesh-d-text` | `#e8eaf4` | Body text |
| `--mesh-d-muted` | `#9aa2bd` | Secondary text |
| `--mesh-d-link` | `#a5b4fc` | Links |
| `--mesh-d-gold` | `#f3c35f` | Active sidebar link, Home "View options" |
| Sidebar | `#140c33` to `#2e1a5c` | Sidebar gradient |

## Not covered yet

- **Layouts without the switch:** `layouts/app2` (26 pages), `layouts/app`, `layouts/app3`, `hrs/layouts/*` and `layout/main-layout`. These have their own designs and don't load `mesh-v4.css`.
- **Inline colours:** pages that write colours directly in `style="..."` or in their own `<style>` block can't be reached from `mesh-dark.css`. Fix them in the page itself, inside NEWLY ADDED / ORI CODE markers. Pages to check first: `superadmindashboard`, `admindashboard`, `servicesdashboard`, `homereport`, `artreport`, `ccareport`, `jawatankosongreport`, `onsdashboard`.
- **Charts:** Chart.js and ECharts draw on a canvas, so their text and grid colours have to be set in each chart's options.
- **TinyMCE:** the editing area is inside an iframe and stays light.
