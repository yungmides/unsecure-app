# Unsecure Project

## Correctif par le groupe 11

- Alexandre TROUVE
- Oliwier MAZIARZ
- Fantin RAIMBAULT
- Mehdi SABER

Toutes les corrections ne sont pas présentes mais on a essayé d'en implémenter le plus possible.
## Pour lancer le projet


1. Clonez le repo
2. Buildez le docker : ```docker-compose build```
3. Lancez le docker : ```docker-compose up```
4. Copiez le .env.example et renommez le .env
5. Lancez ```composer install```
4. Lancez la commande ```docker-compose exec php php artisan key:generate```
5. Lancez la commande ```docker-compose exec php php artisan storage:link```
6. Lancez la commande pour créer les tables : ```docker-compose exec php php artisan migrate```
7. Lancez la commande pour ajouter des données de test : ```docker-compose exec php php artisan db:seed```
8. Le site est accessible sur ```localhost```

**Pour lancer des commmandes laravel vous pouvez faire ```docker-compose exec php php artisan votre:commande```

Vous pouvez accéder à adminer sur ```localhost:8080```

