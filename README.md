<<<<<<< HEAD
<!-- #============= ORI CODE ============== -->
<!--
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
-->
<!-- #================================ -->

# MESH: Ministry of Education Staff Hub

MESH is the Ministry of Education's staff portal. It covers Home, PDMS, My SSM, Cuti, Memangku, Bersara, MNS, Q&A, MEA, MAS, DRF, DSS, MOE Enquiries, banners, announcements, news, inventory (IMS) and room booking. It also has a built-in help assistant, the MESH Smart Bot (ELIA).

This guide explains how to set up and run this folder on a new machine. Your `.env` file, database and server will be different from the original developer's, so read **Section 4** carefully.

---

## 1. What it's built with

| Part | Version / notes |
|---|---|
| Framework | Laravel 8 (`laravel/framework ^8.12`) |
| Language | PHP 7.3 – 8.3 (currently run on **PHP 8.3**) |
| Database | **Microsoft SQL Server** (`DB_CONNECTION=sqlsrv`) |
| UI | Blade templates, Livewire 2, AdminLTE 3, Bootstrap, Tailwind 3, jQuery |
| API login | Laravel Passport |
| Other packages | DomPDF (PDF), Maatwebsite Excel, Simple QR Code, Yajra DataTables, Laravel SOAP, Spatie Backup, Log Viewer |
| Asset build | Laravel Mix (webpack). Only needed if you change `resources/js` or `resources/sass` |

---

## 2. What you need to install first

1. **PHP 8.x** (8.3 recommended) on your `PATH`. In `php.ini`, turn on these extensions:
   - `pdo_sqlsrv` and `sqlsrv` (Microsoft's SQL Server drivers for PHP; download the DLLs that match your PHP version and thread-safety: TS or NTS, x64)
   - `openssl`, `mbstring`, `fileinfo`, `curl`, `zip`, `gd`, `soap`, `bcmath`
2. **Microsoft ODBC Driver 17 or 18 for SQL Server.** The PHP `sqlsrv` drivers need it.
3. **Composer 2**: https://getcomposer.org
4. **Git**, to clone the repo and its submodule.
5. **Node.js 16+ and npm.** These are optional and only needed to rebuild compiled assets (see Section 7).
6. Access to a **SQL Server** database: a local SQL Server / SQL Server Express instance, or the shared test server (ask the team lead for details).

Check your setup:

```powershell
php -v
php -m        # the list must include pdo_sqlsrv, sqlsrv, gd, zip, soap
composer --version
```

---

## 3. Get the code

```powershell
git clone --recurse-submodules <repo-url> Mesh110626
cd Mesh110626
```

The repo has one git submodule, `MESH2026` (`https://github.com/IDMSJPPP/MESH2026.git`). If you cloned without `--recurse-submodules`, or the `MESH2026` folder is empty, run:

```powershell
git submodule update --init --recursive
```

---

## 4. First-time setup

Run these from the project root, in this order.

### 4.1 Install PHP packages

```powershell
composer install
```

This creates the `vendor/` folder. `vendor/` and `node_modules/` are not in git.

### 4.2 Create your `.env` file

`.env` is **not in git** because it holds passwords. Get a copy from the team, or create one from this template:

```ini
APP_NAME=MESH
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlsrv
DB_HOST=localhost
DB_PORT=1433
DB_DATABASE=mesh_local_dev
DB_USERNAME=your_sql_user
DB_PASSWORD=your_sql_password
DB_TRUST_SERVER_CERT=true

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="Ministry Of Education - MESH"

# Optional: MESH Smart Bot (defaults shown)
MESHBOT_ENABLED=true
MESHBOT_NAME=ELIA
MESHBOT_DEFAULT_LANG=en

# Optional: browser push notifications (inventory). Leave empty to disable.
VAPID_SUBJECT=
VAPID_PUBLIC_KEY=
VAPID_PRIVATE_KEY=
```

What to change for your machine:

| Key | What to put |
|---|---|
| `APP_URL` | The address you open MESH at, e.g. `http://127.0.0.1:8000` locally or the real server URL. File and image links depend on it. |
| `APP_ENV` / `APP_DEBUG` | `local` / `true` on your PC. **`production` / `false` on a live server.** |
<!-- #============= ORI CODE ============== -->
<!-- | `DB_HOST`, `DB_PORT` | Your SQL Server, e.g. `localhost` / `1433`, or `localhost\SQLEXPRESS` for a named instance. | -->
<!-- | `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Your database and SQL login. | -->
<!-- #================================ -->
| `DB_HOST`, `DB_PORT` | Your SQL Server. See the examples in **Section 4.2b** below. For a named instance such as `localhost\SQLEXPRESS`, leave `DB_PORT` **empty**. |
| `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Your database and SQL login. To use Windows Authentication instead, leave `DB_USERNAME` and `DB_PASSWORD` empty. |
<!-- #================================ -->
| `DB_TRUST_SERVER_CERT` | Keep `true` unless your SQL Server has a trusted SSL certificate. |
| `MAIL_*` | An SMTP server. A Mailtrap sandbox works for testing. Without mail settings, pages that send email will show an error. |

> ⚠️ **Shared database warning.** The team's shared test database is a copy of production data that other people use too. Reading and writing data there is fine. **Never run `php artisan migrate`, `migrate:fresh`, or `db:seed` against it.** Do schema work on your own private database (e.g. `mesh_local_dev`).

> 🔒 Never commit `.env` and never paste real passwords into this README, issues or chat.

<!-- #========== NEWLY ADDED ============ -->
### 4.2b Your database: pick one setup

Everyone's database is different, so pick the setup that fits you.

> ⚠️ **An empty database plus `php artisan migrate` is NOT enough.** The migrations in `database/migrations` create only about 55 tables (users, roles, inventory, news, banners…). The app uses about 250 tables (SSM, Cuti, PDMS, bookings, competency, eminit, etc.). Most of those were created directly in SQL Server and have no migration. With a migrate-only database, most pages fail with `Invalid object name '...'`.

**Option A: Use the shared test database (easiest)**

Use this if you only need to run MESH and change pages, with no table changes.

1. Ask the team lead for the server name, database name and a SQL login. Your PC must be on the MOE network or VPN.
2. Put them in `.env`:
   ```ini
   DB_CONNECTION=sqlsrv
   DB_HOST=<server-name-or-ip>
   DB_PORT=1433
   DB_DATABASE=<shared-db-name>
   DB_USERNAME=<your-login>
   DB_PASSWORD=<your-password>
   DB_TRUST_SERVER_CERT=true
   ```
3. Skip Section 4.5. **Don't run migrate or seed here.** Other people share this database.

**Option B: Your own local copy (best for table/schema changes)**

1. Install **SQL Server Developer or Express** (free) and **SQL Server Management Studio (SSMS)**.
2. Get a **backup file (`.bak`)** of the test database from the team lead. If you have access to the shared database, you can make one yourself in SSMS: right-click the database → *Tasks* → *Back Up…*
3. In SSMS on your PC: right-click **Databases** → *Restore Database…* → *Device* → pick the `.bak`. Name the database `mesh_local_dev`.
   - Restore the whole database, not just some tables. Some tables live in non-`dbo` schemas (e.g. `mesh.inventory`), and a full restore keeps them.
4. Turn on TCP/IP: open *SQL Server Configuration Manager* → *SQL Server Network Configuration* → *Protocols for <instance>* → enable **TCP/IP**. Then restart the SQL Server service.
5. Choose how to log in:
   - **SQL login:** in SSMS, go to *Security* → *Logins* → *New Login*. Choose *SQL Server authentication* and map the login to `mesh_local_dev` as `db_owner`. If SQL logins fail, right-click the server → *Properties* → *Security*, select *SQL Server and Windows Authentication mode*, then restart the service.
   - **Windows login:** leave `DB_USERNAME` and `DB_PASSWORD` empty.
6. Put the values that match your install in `.env`:

   | Your install | `DB_HOST` | `DB_PORT` |
   |---|---|---|
   | Default instance (Developer / full SQL Server) | `localhost` or `127.0.0.1` | `1433` |
   | SQL Express (named instance) | `localhost\SQLEXPRESS` | *(leave empty)* |
   | Another named instance | `localhost\<INSTANCE>` | *(leave empty)* |
   | SQL Server on another PC | `<pc-name-or-ip>` | `1433` |

   ```ini
   DB_CONNECTION=sqlsrv
   DB_HOST=localhost\SQLEXPRESS
   DB_PORT=
   DB_DATABASE=mesh_local_dev
   DB_USERNAME=mesh_local
   DB_PASSWORD=<the-password-you-set>
   DB_TRUST_SERVER_CERT=true
   ```
7. Now you can safely run `php artisan migrate` on this copy for new migrations.

**Checking the connection**

After editing `.env`, run:

```powershell
php artisan config:clear
php artisan tinker --execute="dump(DB::select('select db_name() as db, @@servername as server'));"
```

You should see your database and server names. If you get an error, see Section 11.

**Keeping more than one `.env`**

To switch between the shared database and your local copy, keep files such as `.env.shared` and `.env.local`. **Add them to `.gitignore` first.** Only `.env` and `.env.backup` are ignored right now, so these files would otherwise be committed along with their passwords. Copy the one you want over `.env`, then run `php artisan config:clear`:

```powershell
Copy-Item .env.local .env -Force; php artisan config:clear
```

> Note: `config/database.php` has a connection named `mysql`, but it actually uses the SQL Server driver too. Keep `DB_CONNECTION=sqlsrv`.
<!-- #================================ -->

### 4.3 Generate keys

```powershell
php artisan key:generate      # fills APP_KEY in .env
php artisan passport:keys     # creates storage/oauth-private.key and oauth-public.key (needed for API login)
```

### 4.4 Link the storage folder

Uploaded files (banners, announcements, attachments) are saved in `storage/app/public` and served from `public/storage`.

```powershell
php artisan storage:link
```

If it says *"The [public/storage] link already exists"* but uploads don't show, `public/storage` is probably a plain folder instead of a link. Check that it's empty, delete it, then run the command again. On Windows, run the terminal **as Administrator** if creating the link fails.

<!-- #============= ORI CODE ============== -->
<!-- ### 4.5 Set up the database (your own database only) -->
<!-- For a new, empty private database: -->
<!-- php artisan migrate -->
<!-- php artisan db:seed           # roles, departments, divisions, stores, asset codes, sample users -->
<!-- If you're connecting to the shared test database, **skip this step**. The tables already exist. -->
<!-- #================================ -->
### 4.5 Database migrations

- **Option A (shared test database):** skip this step. The tables already exist, and other people use this database.
- **Option B (your restored local copy):** run `php artisan migrate` to add any migrations newer than your backup. Don't run `migrate:fresh` or `db:seed`: `migrate:fresh` drops every table, including the ones that have no migration, and `db:seed` can add duplicate rows to restored tables.
<!-- #================================ -->

### 4.6 Clear caches after any `.env` change

```powershell
php artisan optimize:clear
```

---

## 5. Run it

```powershell
php artisan serve
```

Open **http://127.0.0.1:8000**.

**Scheduled tasks.** The room-booking reminder (`booking:reminder`) runs every minute through the Laravel scheduler. To run it locally, open a second terminal:

```powershell
php artisan schedule:work
```

On a server, set up Windows Task Scheduler (or cron on Linux) to run `php artisan schedule:run` every minute from the project folder.

Other artisan commands in `app/Console/Commands`: `ArchiveOldSsmRecords`, `BookingReminder`, `ImportNewSchools`. Run `php artisan list` to see their names.

---

## 6. Folder map

| Folder / file | What's in it |
|---|---|
| `app/Http/Controllers` | Page logic for each service (Admin and Auth sub-folders) |
| `app/Http/Livewire` | Livewire pages: inventory, ledger, SIV, bincard, vendors, statistics, etc. |
| `app/Models` | Database models (`IMS/` = inventory) |
| `app/Services/SmartBot` | MESH Smart Bot logic |
| `app/Console/Commands` | Artisan commands (see Section 5) |
| `routes/web.php` | Main page routes. `dicthr.php` and `tpawse.php` hold extra route groups |
| `resources/views` | Blade pages, one folder per service. `layouts/` holds the page shells. `inc/` holds shared parts (header, theme switch, greeting) |
| `resources/meshbot` | Smart Bot knowledge and phrases. Edit these to teach the bot, then run `php artisan cache:clear` |
| `public/css`, `public/js` | `mesh-v4.css/js`, `mesh-dark.css`, `mesh-lang.js` are **edited by hand** (not built by Mix). `app.css` / `app.js` are built by Mix |
| `public/assets`, `public/img`, `public/banner`, `public/announcement` | Static images and admin theme files |
| `config/` | Laravel settings. `meshbot.php` is the Smart Bot, `adminlte.php` is the admin menu and theme |
| `database/migrations`, `database/seeders` | Table definitions and starter data |
| `data/` | Excel reference files used for imports |
| `archive/` | Old copies of changed files, kept for reference. Not used by the app |
| `MESH2026/` | Git submodule (see Section 3) |
| `storage/logs/laravel.log` | Error log. Check here first when a page shows "500 Server Error" |
| `web.config` / `public/.htaccess` | Web server settings for IIS / Apache |

---

## 7. Front-end assets (only if you change `resources/js` or `resources/sass`)

```powershell
npm install
npm run dev        # build once (development)
npm run watch      # rebuild automatically while you edit
npm run prod       # minified build before deploying
```

Mix only writes `public/js/app.js` and `public/css/app.css`. Edit the hand-written files (`mesh-v4.css`, `mesh-dark.css`, `mesh-v4.js`, `mesh-lang.js`) directly. They take effect without a build, though you may need a hard refresh (Ctrl+F5).

---

## 8. Putting it on a server

1. Copy the project, **excluding** `.env`, `node_modules/` and `storage/logs/*`.
2. On the server, run `composer install --no-dev --optimize-autoloader`.
3. Create the server's own `.env` with `APP_ENV=production`, `APP_DEBUG=false` and the correct `APP_URL` and database.
4. Run `php artisan key:generate` (first deploy only), `php artisan passport:keys` (first deploy only), and `php artisan storage:link`.
5. Point the web site's root at the **`public/`** folder, not the project root.
   - **IIS:** install the *URL Rewrite* module so Laravel routes work. PHP must run through FastCGI with the `sqlsrv` extensions enabled.
   - **Apache:** `public/.htaccess` is already set up. Turn on `mod_rewrite`.
6. Give the web server user write access to `storage/` and `bootstrap/cache/`.
7. Run `php artisan config:cache`, `php artisan route:cache` and `php artisan view:cache`.
8. Set up the scheduler (Section 5).

When you only upload changed files, also upload any shared files listed in the change notes (e.g. `public/css/mesh-dark.css`, `public/js/mesh-lang.js`). Then run `php artisan view:clear`.

---

## 9. House rules for editing code

- **Mark every change.** Wrap new code in `#========== NEWLY ADDED ============` … `#================================`. When you replace code, keep the old code commented out inside `#============= ORI CODE ==============` … `#================================`, followed by the new code. Write the markers in the file's own comment style:
  - Blade: `{{-- ... --}}`, one line at a time, because Blade comments can't be nested
  - PHP / JS: `//`
  - CSS: `/* */`
  - HTML: `<!-- -->`
- **Don't delete original code.** Comment it out.
- Before a big change, keep a dated copy of the old version in `archive/` (e.g. `archive/oldver-29sept2026`).
- Record what changed and which files to upload in a notes file, like the examples in Section 10.

---

## 10. Other notes in this folder

| File | About |
|---|---|
| `DARK-MODE-NOTES.md` | How the light/dark switch works, its files and colours, and what isn't covered yet |
| `DARK-THEME-SUPERADMIN-FILES.md` | Super Admin pages that got the dark theme and the English/Malay switch (15 Oct 2026) |
| `COPYRIGHTS CLAIM!.txt` | Copyright notice. Read before reusing code |

---

## 11. Common problems

| Problem | Fix |
|---|---|
| `could not find driver` | `pdo_sqlsrv` / `sqlsrv` aren't loaded. Check `php -m`, the `extension=` lines in `php.ini`, and that the DLLs match your PHP version (TS/NTS, x64). Make sure the `php.ini` you edited belongs to the `php` you're running (`php --ini`). |
| `SSL Provider: The certificate chain was issued by an authority that is not trusted` | Set `DB_TRUST_SERVER_CERT=true`, then `php artisan config:clear`. |
| `Login timeout expired` / can't reach the server | Check `DB_HOST` / `DB_PORT`. Make sure TCP/IP is enabled in SQL Server Configuration Manager and the firewall allows port 1433. |
| `No application encryption key has been specified` | `php artisan key:generate` |
<!-- #========== NEWLY ADDED ============ -->
| `Invalid object name '<table>'` | Your database is missing that table. It was probably built from migrations only. Restore a full `.bak` instead (Section 4.2b, Option B). |
| `Login failed for user '...'` | Check the username and password. Make sure SQL Server is set to *SQL Server and Windows Authentication mode* and the login is mapped to your database. |
| Works on one PC but not another | Compare the `DB_HOST` / `DB_PORT` formats (named instance = empty port), then run `php artisan config:clear`. A cached config from another machine will point at the wrong server. |
<!-- #================================ -->
| API / token errors about `oauth-private.key` | `php artisan passport:keys` |
| `.env` changes don't take effect | `php artisan optimize:clear` (on a server, re-run `config:cache` afterwards) |
| Page edits don't show | `php artisan view:clear` and hard-refresh the browser (Ctrl+F5) |
| `Class ... not found` after adding a file | `composer dump-autoload` |
| Uploaded images give 404 | Re-do Section 4.4 and check `APP_URL` |
| "500 Server Error" with no details | Read `storage/logs/laravel.log`, or set `APP_DEBUG=true` (only on your own PC) |
| Emails not sending | Check the `MAIL_*` values. For testing, use a Mailtrap sandbox |
| Smart Bot doesn't answer new topics | Edit `resources/meshbot/knowledge.php`, then `php artisan cache:clear` |
=======
# PerumahanMeshCombined
>>>>>>> a6c76ff1c5219c44a74053d46d5a767c3fbb62c4
