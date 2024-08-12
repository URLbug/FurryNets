#!/bin/bash

sudo docker-compose up -d

sudo docker-compose run composer install

sudo chown -R 777 ./src

echo "chown GOAL"

sudo make copy-env

echo ".env GOAL"

sudo docker-compose run npm install
sudo docker-compose run npm run build

sudo docker-compose run artisan migrate

sudo docker-compose run artisan key:generate

echo ""
echo ""
echo ""
echo "local host: http://localhost:8000/"
