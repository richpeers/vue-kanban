#!/bin/sh

# Execute your custom scripts
/usr/local/bin/php /var/www/html/artisan migrate --force
/usr/local/bin/php /var/www/html/artisan optimize
/usr/local/bin/php /var/www/html/artisan storage:link
#/usr/local/bin/php /var/www/html/artisan db:seed --class=ProductSeeder --force

#/usr/local/bin/php /var/www/html/artisan products:images
#/usr/local/bin/php /var/www/html/artisan db:seed --class=ProductSeeder --force
#/usr/local/bin/php /var/www/html/artisan db:seed --class=AffiliateSeeder --force
#/usr/local/bin/php /var/www/html/artisan db:seed --class=ClientSystemSeeder --force
#/usr/local/bin/php /var/www/html/artisan report:orders
#/usr/local/bin/php /var/www/html/artisan report:affiliate
#/usr/local/bin/php /var/www/html/artisan report:sales
#/usr/local/bin/php /var/www/html/artisan report:allinfo

# See ./docker/production.supervisord.conf
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
