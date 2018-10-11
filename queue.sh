#!/bin/bash
cd /home/lvabibv4r3ho/www/QuikService/
/usr/local/bin/php artisan queue:work --queue=priority --sleep=1 --tries=1 --daemon --timeout=900 > /dev/null &