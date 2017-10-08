###################
Config files
###################

 - `application/config/database.php` -> you need to configure database connection parameters
 - `application/config/autoload.php` -> normally you should not modify this file unless you want to modify the php code of the models or drivers for example
 - `application/config/config.php` -> Parameter files

you need special attention on these parameters

 - $config['local_server']
 - $config['default_geolocation']
 - $config['min_distance']
 - $config['max_distance']
 - $config['google_maps_api_key'] -> used to test map in index.php/welcome/map url

###################
Author
###################

Hansel Ramos Osorio <hansell.ramos@gmail.com>

Based in Codeigniter