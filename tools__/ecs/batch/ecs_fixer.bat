:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
php vendor\bin\ecs check vendor/markocupic/contao-schuldienste-theme/src --fix --config vendor/markocupic/contao-schuldienste-theme/tools/ecs/config.php
php vendor\bin\ecs check vendor/markocupic/contao-schuldienste-theme/contao --fix --config vendor/markocupic/contao-schuldienste-theme/tools/ecs/config.php
php vendor\bin\ecs check vendor/markocupic/contao-schuldienste-theme/config --fix --config vendor/markocupic/contao-schuldienste-theme/tools/ecs/config.php
php vendor\bin\ecs check vendor/markocupic/contao-schuldienste-theme/templates --fix --config vendor/markocupic/contao-schuldienste-theme/tools/ecs/config.php
php vendor\bin\ecs check vendor/markocupic/contao-schuldienste-theme/tests --fix --config vendor/markocupic/contao-schuldienste-theme/tools/ecs/config.php
