# Adking Elementor Widget Development Guidelines

This document is the standard reference for building and updating all Adking Elementor widgets.
Follow this strictly to keep all widgets consistent, dynamic, maintainable, and style-safe.

## 1. Scope and Goal

- Convert static widget markup into fully dynamic Elementor controls.
- Match frontend classes and structure from `style.scss`.
- Add rich Style Tab controls for each visible component.
- Keep render output escaped, predictable, and reusable.
- Avoid changing unrelated logic or conditions.

## 2. Mandatory Rules (Non-Negotiable)

1. Every visible text/image/link/icon in widget markup must come from Elementor controls.
2. Every `<img>` must have a `MEDIA` control.
3. Every repeated UI block must use `REPEATER`.
4. Every optional block (title area, button area, right content, etc.) must have `SWITCHER` on/off control.
5. Every style section must map to real selectors from `style.scss`.
6. All CSS selectors in controls must be scoped with `{{WRAPPER}}`.
7. Escape all output in render (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post` when needed).
8. Keep existing frontend class names so SCSS/JS continue to work.
9. Do not hardcode content values in render.
10. Run `php -l` on edited widget files before finalizing.

## 3. Standard Widget File Structure

Use this structure:

1. `register_controls()`
2. `register_layout_controls()` (if multi-style)
3. `register_style_X_content_controls()`
4. `register_style_controls()` and internal style sections
5. helper methods:
   - `get_default_*()`
   - `get_asset_url()` (if theme assets are needed)
   - `get_link_attributes()` (for URL control attrs)
   - sanitizer/helper methods for class variants, repeater transforms
6. `render()`

## 4. Naming Convention

Use control IDs in this pattern:

- `adking_{widget}_{group}_{field}`
- Examples:
  - `adking_team_details_name`
  - `adking_services_style_three_show_section_title`
  - `adking_award_gallery_items`

For style controls:

- `adking_{widget}_style_{component}_{property}`

For section IDs:

- `adking_{widget}_{content|layout|style_*}`

## 5. Content Controls Rules

### 5.1 Textual Elements

- Subtitle/label: `TEXT`
- Title: `TEXT` or `TEXTAREA` (prefer `TEXTAREA` for long text)
- Description/body: `TEXTAREA`
- Keep `label_block => true` for long or important fields.

### 5.2 Images and Logos (Required)

If markup has `<img>`:

1. Add `MEDIA` control for that image.
2. Default value:
   - Generic image: `Utils::get_placeholder_image_src()`
   - Theme-specific asset (logo/signature/vector): use `get_asset_url()`.
3. In render:
   - use media URL if present
   - fallback to placeholder or default asset
4. Handle alt text:
   - use `Control_Media::get_image_alt($media_data)` when `id` exists.

### 5.2.1 Icons (Required)

If markup has an icon slot (`<svg>`, icon image, icon wrapper, button icon, card icon, list icon, etc.):

1. Add an Elementor `Controls_Manager::ICONS` control for that icon position.
2. Use `Icons_Manager::render_icon()` in render for every icon control.
3. Do not add a separate `MEDIA` control for normal icons; image uploads are only for real image/logo slots, not icon slots.
4. Escape icon output:
   - Elementor icon with `Icons_Manager::render_icon()`
   - legacy inline SVG fallback, if needed for old widget data, with `wp_kses()` and a limited SVG allowlist.
5. Keep icon style controls mapped to the real icon selectors, including `svg path` and icon font `i` selectors when styling applies.

### 5.3 Links and Buttons

- Always use `URL` control for links.
- Use a helper like `get_link_attributes()` to apply:
  - `href`
  - `target="_blank"` when external
  - `rel="noopener nofollow"` when needed

### 5.3.1 Button Rules (Mandatory)

If a widget contains any button, you MUST add all of the following:

1. Button text control.
2. Button URL control.
4. Button typography control.
5. Button color control (normal).
6. Button background control (normal).
7. Button hover styles (text/icon/background/border as applicable).
8. Button border control.
9. Button padding control.

Notes:

- Use `{{WRAPPER}}` selectors for all button style controls.
- If the button includes icon/svg, style icon normal/hover together with text where needed.
- Keep button classes and structure unchanged so existing SCSS/JS behavior remains stable.

### 5.3.2 Button Conditions and Selector Mapping (Mandatory)

For widgets with one or more buttons, follow these additional rules:

1. If a button is optional, add a dedicated `SWITCHER` for that specific button or button group.
2. Apply the same `condition` to:
   - button text control
   - button URL control
   - all related Style Tab controls
   - the render markup for that same button
3. For multiple buttons in the same widget/style, define each button Style Tab section separately.
4. Write button style selectors explicitly per button section instead of relying on a shared generic selector pattern when selectors differ.
5. Keep separate selectors for the following when needed:
   - typography selector
   - text/icon color selector
   - background selector
   - border selector
   - padding selector
   - hover text/icon selector
   - hover background selector
6. When the hover background is driven by pseudo elements such as `::after` or `::before`, target that pseudo element directly in the hover control selector.

Example expectation:

- `Primary Button` controls use only the primary button selector chain.
- `Secondary Button` controls use only the secondary button selector chain.
- Do not mix selectors like `.primary-btn1, .primary-btn2` in one button control block unless both buttons are intentionally shared.

### 5.4 Repeated Elements (Required)

Use `REPEATER` for any list/cards/items/tabs/social blocks.

Examples:

- Team members
- Feature items (`key-features-list`)
- Tabs
- Social icons
- Skills/progress items

Repeater standards:

1. Add minimal but complete fields for each item.
2. Use `title_field` for editor clarity.
3. Provide usable default items through `get_default_*()`.
4. Skip empty items safely in render.

### 5.5 Optional Areas

For conditional areas (section title, right content, button block, dark logo block), add a `SWITCHER`:

- `return_value => 'yes'`
- default explicit (`'yes'` or `''`) based on current design behavior.
- apply `condition` to dependent controls.
- gate render markup with the same condition.
- if a component is hidden by switcher, hide its related Style Tab controls/sections using the same `condition`.

### 5.6 Multi-Style Widgets

For widgets with variants (`style_one`, `style_two`, etc.):

1. Add `Layout` section with style `SELECT`.
2. Split content controls by style using `condition`.
3. Split style controls by style using `condition`.
4. Keep style-specific class names in render.
5. Do not cross-mix controls across styles unless intentionally shared.

### 5.7 Common Query Controls for CPT/Post Listing Widgets (Mandatory)

If a widget renders posts from a CPT (example: `portfolio`) and supports multiple styles, every style must include the same base query controls:

1. `Posts Per Page` (NUMBER).
2. `Select Categories` (SELECT2, multiple) using available taxonomy options.
3. `Select Posts` / `Select Portfolio` (SELECT2, multiple) using post options.
4. `Order By` (SELECT) with at least:
   - `ID`
   - `author`
   - `title`
   - `date`
   - `rand`
   - `menu_order`
5. `Order` (SELECT): `ASC` / `DESC`.

Implementation rules:

- Keep these controls consistently named per style (for example: `adking_{widget}_{style}_posts_per_page`, etc.).
- Apply all query controls in render/query methods.
- When specific post IDs are selected, use `post__in` while still allowing taxonomy filters.
- Keep backward compatibility with any legacy query control IDs if the widget already exists.
- Always sanitize/validate `orderby`, `order`, IDs, and term IDs before building query args.

### 5.8 Tab Assignment (Dynamic Only)

For tabbed widgets :

1. Do not use manual free-text tab key input for assignment.
2. Tabs repeater should keep only tab label (and content fields if needed).
3. Item repeater must use a `SELECT` control for tab assignment (`tab_1`, `tab_2`, ...).
4. Tab assignment select options must be auto-generated from current tabs and auto-updated in Elementor editor via custom editor JS.
5. In render, generate tab keys by index (`tab_1`, `tab_2`, ...) and keep backward compatibility when old manual key data exists.

### 5.9 Contact Info Items (Phone/Email) (Mandatory)

If a widget contains contact blocks (example: phone/email list in footer/header/contact area):

1. Use a `REPEATER` for contact items to support multiple client entries.
2. Each contact item must have a `SELECT` type control with at least:
   - `phone`
   - `email`
3. Add separate fields for:
   - label text (example: `Call Us`, `Send Us Mail`)
   - value text (phone number or email)
   - optional icon/media
4. Build link dynamically by type in render:
   - phone -> `tel:{number}`
   - email -> `mailto:{email}`
5. Sanitize value before output:
   - phone link value with `preg_replace('/[^0-9+]/', '', $value)` (or equivalent safe cleanup)
   - email with `sanitize_email()`
6. Always escape display text and URLs (`esc_html`, `esc_url`, `esc_attr`).
7. Do not hardcode contact item markup for a single phone/email; always keep it repeatable and type-driven.

## 6. Style Tab Rules (Very Important)

Build Style Tab from actual `style.scss` selectors.

### 6.0 Per-Style Strictness (Mandatory)

For multi-style widgets, style controls must be split by style and gated with Elementor `condition`:

- Show only the controls for the currently selected style.
- Do not add style fields for elements that do not exist in that style markup/SCSS block.
- If a style has no description element, do not add description style controls for that style.
- If a style has no contact block, do not add contact style controls for that style.
- If a subtitle chip uses border in SCSS (for example `.section-title > span` or `.left-content > span`), include both:
  - subtitle text color control
  - subtitle border color control
- Prefer style-specific selectors like:
  - `{{WRAPPER}} .home1-...`
  - `{{WRAPPER}} .home2-...`
  - `{{WRAPPER}} .home3-...`
  - `{{WRAPPER}} .home4-...`
  instead of broad mixed selectors spanning multiple styles.

### 6.1 Section Grouping

Create separate style sections per visual component, for example:

- Section
- Subtitle
- Title
- Description
- Button
- Card/Item
- Icon
- Image/Logo
- Rating/Progress

Use `Controls_Manager::HEADING` inside style sections when needed to separate sub-parts.
For multi-element style sections, heading labels are mandatory (for example: `Subtitle`, `Title`, `Description`, `Top Button`, `Item Title`, `Tags`, `Icon`, `Contact`), so controls are grouped clearly and consistently.

### 6.2 Selector Strategy

- Always scope with `{{WRAPPER}}`.
- Use exact class chains used in SCSS.
- Keep one component class -> one clear style target when possible.
- If variants exist (`.style-2`, `.two`, `.three`), provide variant-specific style controls.

### 6.3 Style Controls to Include

At minimum (where applicable):

- Color controls
- Typography group control
- Spacing controls (margin/padding/gap)
- Border/border-radius
- Background
- Width/height/size sliders
- Hover states (text/bg/border/icon)

## 7. Render Rules

1. Get settings via `$this->get_settings_for_display()`.
2. Normalize complex fields before markup:
   - media arrays
   - repeater arrays
   - URLs
   - numeric limits (e.g., percent clamp 0-100)
3. Keep class structure stable to preserve CSS/JS behavior.
4. Escape output:
   - `esc_html` for plain text
   - `esc_attr` for attributes/classes/data attrs
   - `esc_url` for URLs/src
   - `wp_kses_post` only if HTML input is intentionally allowed
5. Skip empty blocks cleanly (no broken wrappers when possible).

## 8. JS and Data Attribute Compatibility

When widget UI depends on existing JS (`custom.js`):

1. Keep required class names and data attributes unchanged.
2. Example: progress bars require `.progress-bar` and `data-progress`.
3. Prefer existing global JS hooks over adding inline `<script>` in widget render.
4. If JS may not run in Elementor preview, provide safe fallback output (e.g., inline width style).

## 9. Assets, Light/Dark Logos, and Theme URLs

When static asset paths are needed:

- Use helper:
  - `trailingslashit(get_template_directory_uri()) . 'assets/' . ltrim($path, '/')`

For dark mode compatible logos/images:

1. Keep `light-logo` and `dark-logo` classes if theme CSS toggles them.
2. Make both dynamic via media controls.
3. Use switcher when dark asset is optional.

## 10. Registration and Project Integration

When adding a new widget file:

1. Ensure file name follows:
   - `class-{slug}-elementor-widget.php`
2. Ensure widget class is registered in the file:
   - `Plugin::instance()->widgets_manager->register(new Class_Name());`
3. Add slug to `inc/elementor/elementor.php` widgets array if not already present.
4. Keep category: `adking_widgets`.


## 11. Quick Build Workflow (Use on Every New Widget)

1. Read widget HTML and identify root classes.
2. Read matching block in `style.scss`.
3. Map all dynamic fields:
   - text
   - images
   - links
   - repeaters
   - switches
4. Create content controls.
5. Create style controls component-by-component.
6. Implement helper methods (`default`, `asset`, `link`, sanitizers).
7. Render with escaping and conditional guards.
8. Validate with `php -l`.
9. Re-check that style selectors match SCSS.
10. Deliver with concise change summary and file references.



---

If an AI agent is used for next widgets, reference this file and instruct:

- “Follow `inc/elementor/guidelines /guidelines.md` strictly.
- Keep widget dynamic, repeater/image rules mandatory, and map style tab to `style.scss` selectors.”
- “For tabbed repeaters, use Team style 3 pattern: no manual tab key, auto tab dropdown assignment synced from tabs repeater.”
- “For every button, enforce full Button Rules (text, URL, alignment, typography, normal/hover color+background, border, padding).”
