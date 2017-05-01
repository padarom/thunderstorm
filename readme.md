# Thunderstorm
Thunderstorm is a simple package update server for the WoltLab Community Framework written in PHP. It provides full compability with WCFs package system and an easy to use frontend to administrate and even edit packages. A production demo can be found at http://thunderstorm.padarom.io.

### Server Requirements
This server is based on [Laravel Lumen](https://lumen.laravel.com/), and as such shares the same requirements.
- PHP >= 5.5.9
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

## Installation
You can manually install this server by downloading the source code and running `composer install` to install all dependencies. After this you will need to complete the following steps:

1. Create a sqlite database file (`database/database.sqlite`)
2. Copy the example environment file (`cp .env.example .env`)
3. Run the database migrations (`php artisan migrate`)
4. Make sure your `storage` and `uploads` directory are writeable (`chmod -R 755 storage/ uploads/`)

For releases I also provide a pre-packaged version (about 2MB in size) that already contains all dependencies, whicht you can just drop in and use, without doing some of the steps above. You still need to make sure the proper permissions are set for the `storage` and `uploads` directory though (see step 4).

__You will also need to make sure that the php ini directive `short_open_tag` is set to `Off`.__
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

## Incompatibilities
- Even though WCF supports `.tar.gz` archives (that is "gzipped tar archives"), it does not recommend using them. `.tar` archives are the preferred variant for WCF packages. Thunderstorm does currently _not_ support these gzipped archives, it only supports WCFs recommendation. This might change in the future.

## License
This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
