# Pengurusan Perumahan — working notes for Claude Code

## What this is

A Laravel implementation of a records-management system for government housing:
applicants, rental-house (RS) owners and occupants, government quarters (IQ) and
a waiting list. Generated from an HTML design; the design lives in `design/`.

## Run it

    laravel new perumahan && cd perumahan
    # copy this package's folders over the app root, merging routes/web.php
    php artisan migrate --seed
    php artisan serve

## Architecture — read this before changing anything

**`config/perumahan.php` is the source of truth.** Every register (`pemohon`,
`pemilik-rs`, `penghuni-rs`, `iq`, `penghuni-iq`, `menunggu`) declares its list
columns and its form sections/fields there. Add, rename or reorder fields in that
file — the list table, the form and the detail view all read from it. No migration
needed for a field change.

**One table, one controller.** `rekods` carries `jenis` (register key) and a JSON
`data` column, so all six registers share `RekodController` and one `form.blade.php`.
Field input names are `Str::slug($label, '_')`, computed in the views and in the
controller's `payload()`.

If you prefer six typed tables, keep the config file as the label/ordering source
and generate migrations from it — don't hand-duplicate the field lists.

## Layout

    app/Http/Controllers/RekodController.php   all screens
    app/Models/Rekod.php                       field(), tajuk(), scopeJenis, scopeCari
    config/perumahan.php                       registers, columns, form schema
    database/migrations/                        rekods table
    database/seeders/RekodSeeder.php           5 demo rows per register
    routes/web.php
    resources/views/layouts/app.blade.php      shell, header, success modal
    resources/views/partials/sidebar.blade.php nav, counts per register
    resources/views/rekod/                     index, list, show, form, choose
    public/css/perumahan.css                   whole visual system, no build step
    design/                                    the original HTML design

## Visual system — MESH palette

Sampled from the ministry's MESH portal. All tokens are at the top of
`public/css/perumahan.css`; use the variables, never raw hexes.

    indigo  #241e6a   deep navy #140f36   plum #462957
    gold    #f2c245   ground    #f5f5fa   ink  #191631

Header is the indigo→navy→plum gradient under a 3px gold rule; sidebar is
`--accent-900` with a gold active marker. Type is Barlow Condensed headings over
Barlow body, from Google Fonts in the layout. Square corners, hairline borders,
no rounded cards.

## Known gaps — good first tasks

1. **File fields are plain text inputs.** Fields with `'type' => 'file'` in the
   config render as text boxes with a dead "Pilih Fail" button. Wire real uploads
   through `Storage`, add a `dokumens` table or a JSON attachment list, and
   validate mime/size.
2. **Validation is thin.** `RekodController::payload()` requires only each
   register's first field and allows `string|max:255` on everything else. Add
   per-field rules to the config (`'rules' => ['required','date']`) and read them
   in `payload()`.
3. **Search is a `LIKE` over the JSON blob.** Fine for demo volumes. For real
   data, add generated columns on the hot fields (name, KPP, daerah) and index them.
4. **No auth.** Add Breeze, then gate the registers by role — clerks read, officers
   write, and the waiting list probably needs its own permission.
5. **No audit trail.** These are tenancy records; add `created_by`/`updated_by` and
   a revision log before anyone relies on the data.

## Conventions to keep

- Interface language is Malay. Labels come from the config verbatim — don't
  translate or reword them; they match the ministry's paper forms.
- Route names are `perumahan.*`; the register key is always the first route param.
- Success redirects flash `berjaya`, which the layout renders as the
  "Rekod Berjaya Disimpan" modal.
