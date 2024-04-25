#!/bin/bash

cp /home/site/wwwroot/.env-prod /home/site/wwwroot/.env
cp /home/site/wwwroot/deploy/default /etc/nginx/sites-enabled/default
service nginx reload
