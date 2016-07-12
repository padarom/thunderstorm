## Padaroms Update Server
This is a simple package update server for WoltLab Community Framework packages written in PHP.

### Server Requirements
This server is based on [Laravel Lumen](https://lumen.laravel.com/), and as such shares the same requirements.
- PHP >= 5.5.9
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

## Installation
You can manually install this server by downloading the source code and running `composer install` to install all dependencies.

For releases I also provide a pre-packaged version that already contains all dependencies (about 10MB in size), that you can just drop in and run without any further configuration.

### Setting up a cronjob
This server checks for uploads every minute. To enable this, you must add a cronjob by running `crontab -e` (depending on your OS) and adding the following:
```
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

## License
This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
