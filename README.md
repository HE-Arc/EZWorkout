# EZWorkout

Le but de l’application est de planifier, d’organiser, puis de suivre des entraînements sportif orientés musculation.

Elle se décompose en 3 parties :

  * la planification d'entraînements
  * historique des entraînements
  * Analyses des performances

Les données des entraînements seront synchronisées depuis une app mobile à l'aide d'une api.

team postman : https://app.getpostman.com/join-team?invite_code=2e1d81a068f69a2e53b212df80a99e4a&ws=606b7570-acdb-4876-bb66-f9e216d411ba
accès au site: [ezw.dev.jojoc4.ch](https://ezw.dev.jojoc4.ch)

[![Laravel Actions Status](https://github.com/HE-Arc/EZWorkout/workflows/Laravel/badge.svg)](https://github.com/HE-Arc/EZWorkout/actions)
[![Quality Gate Status](https://sonar.jojoc4.ch/api/project_badges/measure?project=ezworkout&metric=alert_status)](https://sonar.jojoc4.ch/dashboard?id=ezworkout)

## Dev Installation
1. clone repo
2. copy .env.exemple .env
3. run composer installer 
4. run php artisan key:generate
5. run php artisan migrate
6. you're ready

## Dev deployment
You can deploy our application using docker,
simply run this command:

```bash
docker run -e DB_HOST=<your db ip> \
 -e DB_DATABASE=<your database name> \
 -e DB_USERNAME=<your db username> \
 -e DB_PASSWORD=<your db password> \
 -p 8000:8000 \
 registry.jojoc4.ch/ezworkout:latest
```
