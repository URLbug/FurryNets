#!/bin/bash

sudo docker-compose up -d

sudo docker-compose run composer install

sudo chown -R $(whoami) ./src

echo "chown GOAL"

sudo chmod -R gu+w ./src/storage

sudo chmod -R guo+w ./src/storage

echo "chmod GOAL"

sudo cat ./src/.env.example > ./src/.env

echo ".env GOAL"

sudo docker-compose run npm install
sudo docker-compose run npm run build

sudo docker-compose run artisan migrate

sudo docker-compose run artisan key:generate

echo ""
echo ""
echo ""
echo "local host: http://localhost:8000/"
