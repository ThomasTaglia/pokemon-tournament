#!/bin/bash

docker-compose up -d --build
sleep 10s
docker exec -i php symfony console doctrine:schema:update --force
