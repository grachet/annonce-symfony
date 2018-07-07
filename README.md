# Job Board - Symfony

Simple job board website in Symfony 3.4

---

### Get the code

* git clone https://github.com/grachet/annonce-symfony.git

---

### Define parameters (password...)

* Modify app/config/parameters.yml

---

3. Download vendors

* composer install

---

### Create Database

* php bin/console doctrine:database:create

* php bin/console doctrine:schema:update --dump-sql

* php bin/console doctrine:schema:update --force

* php bin/console doctrine:fixtures:load

---

### Publish assets in /web

* php bin/console assets:install web
