# Composer template for the PoS project (a Drupal site)


This project template provides a starter kit for managing your PoS site
dependencies with [Composer](https://getcomposer.org/).

If you want to know how to use it as replacement for
[Drush Make](https://github.com/drush-ops/drush/blob/8.x/docs/make.md) visit
the [Documentation on drupal.org](https://www.drupal.org/node/2471553).

## Usage

First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

> Note: The instructions below refer to the [global composer installation](https://getcomposer.org/doc/00-intro.md#globally).
You might need to replace `composer` with `php composer.phar` (or similar) 
for your setup.

After that you can clone this repositori:

```
git clone .... some-dir
```

After do the clone of the repository you can use compose to install all the dependecies
```
cd some-dir
composer install
```

When the composer ends you must edit the web/sites/default/settings.php file and add this at the end (Change it acording your environment) of it:

```
if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}

$databases['default']['default'] = array (
  'database' => '<your_database>',
  'username' => '<your_username>',
  'password' => '<your_password>',
  'prefix' => '',
  'host' => '<your_db_server>',
  'port' => '<your_port>',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);

$settings['install_profile'] = 'standard';
$config_directories['sync'] = 'sites/default/files/<your_sync_folder>/sync';

global $content_directories;
$content_directories['sync'] = $app_root.'\content\sync';
$content_directories['sync'] = $app_root.'\content\split';

```

also update the value of $settings['trusted_host_patterns'], $settings['file_public_path'] and $settings['hash_salt']
```
$settings['trusted_host_patterns'] = [
  '^127.0.0.1$',
  '^localhost$',
  '^your_public_domain$',
];

$settings['file_public_path'] = 'sites/default/files/public';

//$settings['hash_salt'] = '';
$settings['hash_salt'] = 'xIe56HxiA-CzcH9PnaIcELUCV0DtulEeqV8On5QTWTMciiFues7Fv7vOVG-abghqjt-GM13VCg';
```

You must create your new database in your database server and import in it the file stored in the folder database-backup.

Clear cache
./vendor/drush/drush/drush cr

Acces with  a browser to the new web site, if there are some thmplate error (the template is not loaded correctly) pleas acces to the performance menu option (/admin/config/development/performance), uncheck both checkboxes, Aggregate CSS files and Aggregate JavaScript files, and click over the button "Save configuration".


