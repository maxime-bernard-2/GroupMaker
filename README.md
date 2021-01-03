# GroupMaker

GroupMaker est une application web conçue en PHP qui a pour but de faire des groupes de personnes aléatoirement.

## Installation

J'ai mis en place des images Docker pour faciliter l'installation sur de nouvelles machines sans plus de configurations.
Cela inclut une base de données MYSQL avec PhpMyAdmin et un serveur composé de PHP 8.0 et Apache.

### Docker

Installer Docker Desktop (https://www.docker.com/products/docker-desktop) et ne pas oublier de le lancer une fois l'installation terminée.

> Si vous n'êtes pas familier avec Docker, je vous conseille ces vidéos:
>1. Bases de Docker: https://www.youtube.com/watch?v=SXB6KJ4u5vg
>2. Créer une image Docker: https://www.youtube.com/watch?v=cWkmqZPWwiw
>3. Utiliser Docker compose: https://www.youtube.com/watch?v=dWcoIxRfs8Y

### Lancer l'application

Pour lancer l'application, il vous faudra taper ces commandes dans le répertoire où se trouve 'docker-compose.yml':
```
docker-compose build
```
```
docker-compose up
```
