#!/bin/bash

docker-compose up -d --build
docker exec -i php symfony console doctrine:schema:update --force
