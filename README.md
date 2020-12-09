# EZWorkout

Le but de l’application est de planifier, d’organiser, puis de suivre des entraînements sportifs orientés musculation.

Elle se compose de 3 parties :

  * La planification d'entraînements
  * L'historique des entraînements
  * L'analyse des performances

Les données des entraînements seront synchronisées depuis une app mobile à l'aide d'une api.

accès au site: [ezw.dev.jojoc4.ch](https://ezw.dev.jojoc4.ch)

[![Laravel Actions Status](https://github.com/HE-Arc/EZWorkout/workflows/Laravel/badge.svg)](https://github.com/HE-Arc/EZWorkout/actions)
[![Quality Gate Status](https://sonar.jojoc4.ch/api/project_badges/measure?project=ezworkout&metric=alert_status)](https://sonar.jojoc4.ch/dashboard?id=ezworkout)

## Dev Installation
1. clone repo
2. copy .env.exemple .env
3. run composer installer 
4. run npm install
5. run npm run dev
6. run php artisan key:generate
7. run php artisan migrate
8. if you want some base datas for the first user, run php artisan db:seed
9. you're ready

## production
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
