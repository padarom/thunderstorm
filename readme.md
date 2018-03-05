# Thunderstorm
Thunderstorm is a simple package update server for the WoltLab Community Framework written in PHP. It provides full compability with WCFs package system (\*).

### Roadmap
_As I no longer use WCF I cannot put any more resources into this project until there is more interest in it or my schedule clears up._

- [ ] HTML based frontend
- [ ] Authentication
- [ ] Administration interface
- [ ] Ability to edit plugins from the system

### Server Requirements
This server is based on [Laravel Lumen](https://lumen.laravel.com/), and as such shares the same requirements.
- PHP >= 5.5.9
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

__You will also need to make sure that the php ini directive `short_open_tag` is set to `Off`.__

## Installation
You can manually install this server by downloading the source code and running `composer install` to install all dependencies. After this you will need to complete the following steps:

1. Create a sqlite database file (`database/database.sqlite`)
2. Copy the example environment file (`cp .env.example .env`)
3. Run the database migrations (`php artisan migrate`)
4. Make sure your `storage` and `uploads` directory are writeable (`chmod -R 755 storage/ uploads/`)

I also provide a [pre-packaged version](https://github.com/padarom/thunderstorm/releases) (about 2MB) of all releases that already contains the dependencies. You still need to make sure the proper permissions are set for your `storage` and `uploads` directory (see step 4).

### Upgrade Process
To upgrade to a newer version, do the following:

1. Backup these files/directories:
    - `.env`
    - `database/database.sqlite`
    - `storage/packages`
2. Replace the application with the newest version (unzip the prepackaged release or download the repository)
3. Move your backed up files back into the application (overwrite any existing files)
4. Run `php artisan migrate`

### Setting up the import
The server scans the `uploads/` directory (this can be configured in the `.env` configuration file) for new packages. So if you want to add new packages to the system, drop them in there. The server will automatically analyze its `package.xml` file and move it to the right directory. This import can be run manually with `php artisan import:uploads` when in the project root directory.

Alternatively there's two ways to run the import automatically:
#### Cronjob _(recommended)_
The server checks for uploads every minute. To enable this, you must add a cronjob by running `crontab -e` (depending on your OS) and appending the following line (make sure to adjust the path):
```
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

#### On requests _(not recommended)_
The server runs the import automatically before answering the request. This runs (statistically) during 3 out of every 10 requests. Depending on the number of packages that have to be imported, this could severely slow down your application. During tests it was fast enough that it shouldn't make a noticeable difference, but it's still a good practice to run the import using cronjobs.

If you have no way of running cronjobs and are absolutely sure you want to use this method for imports, then edit your `.env` configuration file and set the `IMPORT_ONREQUESTS` variable to `true`:
```
IMPORT_ONREQUESTS=true
```

#### (\*) Incompatibilities
- Even though WCF supports `.tar.gz` archives (that is "gzipped tar archives"), it does not recommend using them. `.tar` archives are the preferred variant for WCF packages and as such, Thunderstorm does _not_ support `.tar.gz` archives.

## License
This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
