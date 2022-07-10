# Pokemon tournament #

## Project setup

```
/bin/bash startserver.sh
```

Command that builds Docker instances for php, database, nginx and frontend. After sleeping 10 seconds it creates or
updates the database schema from doctrine.

## Problem solving commands

If the `/app/vendor/` folder isn't created by the startserver.sh command, you can fix this problem by executing this
command from the project root:

```
docker exec -i php composer install
```

If the `/frontend/node_modules/` folder isn't created by the startserver.sh command, you can fix this problem by
executing this command from `/frontend`:

```
npm install
```

## List of the Docker instances addresses:

    - frontend: http://localhost:3000
    - backend (Nginx): http://localhost:8080
    - PHP: http://localhost:9000 
    - MySQL: http://localhost:4306 

## Update database schema without rebuild Docker instances

```
docker exec -i php symfony console doctrine:schema:update --force
```

## Client endpoints ##

```
- http://localhost:3000/team/create
- http://localhost:3000/team/list
- http://localhost:3000/team/{team-id}/edit
```