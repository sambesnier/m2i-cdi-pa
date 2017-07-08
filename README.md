m2i-cdi-pa
==========

Projet Symfony créé dans le cadre d'un TP

## Installation

```
$ git clone https://github.com/sambesnier/m2i-cdi-pa.git
$ cd m2i-cdi-pa/
$ bower install
$ composer install
```
### Avec une configuration par défaut de MySql
- database_host: 127.0.0.1
- database_port: 3306
- database_name: tp_m2i_symfony
- database_user: root
- database_password: 1234  
- Ne rien mettre pour "mailer"  
  
```
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:fixtures:load
$ php bin/console server:run
```

## Utilisation

Aller sur http://localhost:8000

## Version

Symfony 3.3.2

## Auteur

**Samuel Besnier** - [SamBesnier](https://github.com/sambesnier)
 
 ## License
 
Ce projet est sous license MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails  
