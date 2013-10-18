#!/bin/bash
sudo chmod -R 777 app/cache/
php app/console cache:clear
sudo chmod -R 777 app/cache/
sudo chmod -R 777 app/logs
