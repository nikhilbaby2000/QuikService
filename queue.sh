#!/bin/bash
cd /home/lvabibv4r3ho/www/QuikService/
nohup /usr/local/bin/php artisan queue:work --queue=priority --sleep=1 --tries=1 --daemon &