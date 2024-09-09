Cardoc
===========

This monorepo includes all the code for the Cardoc project.

## Local Development
To start the project, you will need to have docker installed and running on your machine.
While all the parts of the development environment can be installed and launched locally, we highly suggest you use the provided docker-compose file.

1. Clone this repo
2. Copy the .env.exemple at the root of the project to a separate .env file.
3. Run the following
```
docker compose -f compose-dev.yaml -p cardoc-dev up -d
```

4. Go to the cardoc docker container and run the following commands
```
php artisan key:generate
php artisan migrate fresh --seed
```
5. Go to this url to access the project
```
http://localhost/admin
```

## Resources

