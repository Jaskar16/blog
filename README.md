# Blog

A simple blog built with **Laravel 13**, **Tailwind CSS 4** and **daisyUI**, using **SQLite** as the database and **Bun** for frontend packages.

This guide takes you from a fresh Windows computer to a running project. Commands are written for **PowerShell** unless noted otherwise.

---

## 1. Install the required programs

| Program | Why it is needed |
|---|---|
| VS Code | Code editor |
| Git | Cloning the project and version control |
| PHP 8.3 or newer | Runs Laravel |
| Composer | Installs PHP packages |
| Bun | Installs frontend packages and runs Vite |

### VS Code, Git, PHP and Bun

```powershell
winget install Microsoft.VisualStudioCode
winget install Git.Git
winget install PHP.PHP.8.4
winget install Oven-sh.Bun
```

> **Important:** after installing, **close every terminal window and open a new one**. New programs are added to `PATH`, and terminals that were already open will not see them.
>
> To refresh `PATH` in the current PowerShell window instead:
>
> ```powershell
> $env:Path = [Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [Environment]::GetEnvironmentVariable("Path","User")
> ```

Check that they work:

```powershell
git --version
php -v
bun -v
```

### Composer

Composer is **not** available through winget. Install it with the official installer.

**Option A – graphical installer:** download and run `Composer-Setup.exe` from <https://getcomposer.org/download/>. When it asks for PHP, choose the `php.exe` installed above.

**Option B – command line** (installs Composer into `C:\Users\<you>\composer`):

```powershell
$composerDir = "$HOME\composer"
New-Item -ItemType Directory -Force $composerDir | Out-Null
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir="$composerDir" --filename=composer.phar
Remove-Item composer-setup.php
Set-Content "$composerDir\composer.bat" '@php "%~dp0composer.phar" %*'
[Environment]::SetEnvironmentVariable("Path", [Environment]::GetEnvironmentVariable("Path","User") + ";$composerDir", "User")
```

Open a new terminal and check:

```powershell
composer -V
```

> Composer needs the `openssl` and `zip` PHP extensions. If the installer complains about them, do **step 2** first and then come back here.

---

## 2. Enable the required PHP extensions (php.ini)

PHP installed with winget does **not** come with a `php.ini` file, so Laravel's extensions are disabled. Find out where PHP is installed:

```powershell
php --ini
```

If `Loaded Configuration File` says `(none)`, there is no `php.ini` yet.

### Required extensions

| Extension | Used for |
|---|---|
| `curl` | HTTP requests |
| `fileinfo` | Detecting file types |
| `intl` | Internationalization |
| `mbstring` | Multibyte (UTF-8) strings |
| `openssl` | HTTPS and encryption (Composer needs it) |
| `pdo_sqlite` | Laravel's SQLite database driver |
| `sqlite3` | SQLite support |
| `zip` | Unpacking Composer packages |

### Option A – automatic (PowerShell)

This creates `php.ini` from PHP's development template and enables everything listed above:

```powershell
$phpDir = Split-Path (php -r "echo PHP_BINARY;")
Copy-Item "$phpDir\php.ini-development" "$phpDir\php.ini"
(Get-Content "$phpDir\php.ini") `
  -replace '^;extension_dir = "ext"', "extension_dir = `"$phpDir\ext`"" `
  -replace '^;extension=(curl|fileinfo|intl|mbstring|openssl|pdo_sqlite|sqlite3|zip)\s*$', 'extension=$1' |
  Set-Content "$phpDir\php.ini"
```

### Option B – by hand

1. Open the PHP folder. To see where it is, run `php -r "echo PHP_BINARY;"` (on a winget install it is in `%LOCALAPPDATA%\Microsoft\WinGet\Packages\PHP.PHP.8.4_...`).
2. Copy `php.ini-development` and rename the copy to `php.ini`.
3. Open `php.ini` in a text editor and remove the `;` at the start of these lines:

   ```ini
   extension_dir = "ext"
   extension=curl
   extension=fileinfo
   extension=intl
   extension=mbstring
   extension=openssl
   extension=pdo_sqlite
   extension=sqlite3
   extension=zip
   ```

   For `extension_dir`, it is safest to use the **full path**, for example `extension_dir = "C:\path\to\php\ext"`.
4. Save the file and open a new terminal.

### Check

```powershell
php --ini
php -m
```

`Loaded Configuration File` should now show your `php.ini`, and `php -m` should list all eight extensions.

---

## 3. Clone the project

```bash
git clone https://github.com/Jaskar16/blog.git
cd blog
```

Open it in VS Code:

```bash
code .
```

If VS Code shows **Restricted Mode**, click **Manage → Trust** so that the editor and terminal work fully. Open the built-in terminal from **Terminal → New Terminal**.

---

## 4. Install dependencies

PHP packages (creates the `vendor` folder):

```bash
composer install
```

Frontend packages (creates the `node_modules` folder):

```bash
bun install
```

---

## 5. Create the `.env` file and application key

Laravel reads its settings from `.env`. Create it from the example file:

PowerShell:

```powershell
Copy-Item .env.example .env
```

Git Bash / macOS / Linux:

```bash
cp .env.example .env
```

Generate the application key (it is written into `.env` as `APP_KEY`):

```bash
php artisan key:generate
```

---

## 6. Create the database

The project uses SQLite, so no separate database server is needed. Run the migrations:

```bash
php artisan migrate
```

When asked **"Would you like to create it? (yes/no)"**, answer **yes**. This creates `database/database.sqlite` and the tables.

Optional: fill the database with 1000 example posts so the home page is not empty:

```bash
php artisan db:seed
```

Create the public storage link, so that uploaded post images can be shown on the site:

```bash
php artisan storage:link
```

---

## 7. Start the project

```bash
composer run dev
```

This starts three things at once:

- **server**: the Laravel app at <http://127.0.0.1:8000>
- **queue**: the background job worker
- **vite**: the frontend dev server, which rebuilds CSS and JS when you save a file

Open the site in your browser: **<http://localhost:8000>**

| Page | Address |
|---|---|
| Home (posts) | <http://localhost:8000> |
| Buttons | <http://localhost:8000/buttons> |

Vite also prints `http://localhost:5173`. That address is only for asset hot-reloading. **Do not open it.** Always use port **8000**.

To stop the project, press **Ctrl+C** in the terminal. If Windows asks `Terminate batch job (Y/N)?`, answer **Y**.

### Running it again later

```bash
cd blog
git pull
composer run dev
```

---

## Troubleshooting

**`'php'`, `'composer'` or `'bun'` is not recognized / command not found**
The program was installed after the terminal was opened. Close **all** terminal windows (in Windows Terminal, close the whole window, not just the tab) and open a new one, or refresh `PATH` as shown in step 1.

**`'bunx' is not recognized` when running `composer run dev`**
Some Bun installations only add `bun`, not `bunx`. Create a small `bunx` wrapper:

PowerShell (if Composer was installed with Option B):

```powershell
Set-Content "$HOME\composer\bunx.cmd" '@bun x %*'
```

Git Bash (if Bun was installed with the official script):

```bash
echo '@bun x %*' > ~/.bun/bin/bunx.cmd
```

Then run `composer run dev` again.

**`Failed opening required '.../vendor/autoload.php'`**
`composer install` did not finish. Regenerate the autoloader:

```bash
composer dump-autoload
```

**`Could not open input file: artisan`**
You are not in the project folder. Run `cd blog` (or the folder you cloned into) first.

**Composer error about a missing PHP extension (`ext-...`)**
That extension is not enabled in `php.ini`. Repeat step 2 and check with `php -m`.

**`Vite manifest not found`**
Vite is not running. Start the project with `composer run dev`, or build the assets once with:

```bash
bun run build
```

**Warning about the optional `fontaine` package**
This is only a notice about font fallback optimization. The site works normally and it can be ignored.

**Git Bash shows `fork: Resource temporarily unavailable` / `0xC0000142` errors**
Windows Exploit Protection is forcing *Mandatory ASLR* on all programs, which breaks Git Bash. Use PowerShell instead, or add an exception for Git Bash in an **administrator** PowerShell:

```powershell
Set-ProcessMitigation -Name bash.exe -Disable ForceRelocateImages
Set-ProcessMitigation -Name sh.exe -Disable ForceRelocateImages
Set-ProcessMitigation -Name git.exe -Disable ForceRelocateImages
```

---

## Quick reference

Once everything from steps 1–2 is installed:

```bash
git clone https://github.com/Jaskar16/blog.git
cd blog
composer install
bun install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
composer run dev
```

Then open <http://localhost:8000>.
