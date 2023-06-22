# Installation #

Insttalation steps of the owlsms web app.

## 1. Clone GitHub repo using the repository url. ##

Find a directory (folder)on your computer where you want to store the project. I make use of Laragon, so all my projects are inside a folder called `www/`, that is where I run the following command, which will pull the project from github and create a copy of it on my local computer at the “www” directory.

```
git clone https://github.com/Kenura-R-Gunarathna/Owlsms-website.git
```

To get the link to the repo, just visit the github page and click on the green “clone or download” button on the right hand side. This will reveal a url that you will replace in the `Repository_url` part of the snippet above.

## 2. cd into your project ##

To execute the rest of the commands, you will need to be inside that project . Type `cd projectName` to move to the working location of the project file we just created.

```
cd REPOSITORY_URL
```

## 3. Install Composer Dependencies ##

Running composer, checks the `composer.json` file which is submitted to the github repo and lists all of the composer (PHP) packages that your repo requires.

```
composer install
```

## 4. Create a copy of your .env file ##

`.env` files are not committed to source control for security reasons. But there is a `.env.example` which is a template of the `.env` file that the project have. So we will make a copy of the `.env.example` file and create a `.env` file from it.

```
cp .env.example .env
```

## 5. Generate an app encryption key ##

Every laravel project requires an app encryption key which is generally randomly generated and stored in your `.env` file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.

```
php artisan key:generate
```

## 6. Create an empty database for our application ##

Create an empty database for your project, your database name should correspond with your project name.

## 7. Add database information to allow web app to connect to the database. ##

In the .env file fill in the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` options to match the details of the database you just created. This will allow us to run migrations and seed the database if there is any table to seed.

## 8. Add mail server information to allow web app to send emails. ##

In the .env file fill in the `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `DB_USERNAME`, and `MAIL_PASSWORD` options to match the details of the database you just created. This will allow the web app to connect to the mail sever and send messages.

For further details follow the blog : https://joy-joel.medium.com/how-to-set-up-a-laravel-project-cloned-from-github-e5cf3211ff53

## 9. Turn the website from DEVELOPMENT => PROJECT ##

To complete configuration of caches in the site you can open th url : https://krag.lk/optimize. By this all site data like view, cache are cleared and route, config cache are re-created. Or else you can follow the below method.

## 10. Autoloader Optimization ##

When deploying to production, make sure that you are optimizing Composer's class autoloader map so Composer can quickly find the proper file to load for a given class:

```
composer install --optimize-autoloader --no-dev
```

## 11. Creating the tables ( and the database ) ##

Inorder to create the tables inside the databse, run the below command.

```
php artisan migrate
```

## 12. Insert the default data into the tables ##

Inorder to inser the default data in to the tables of the databse, run the below command.

```
php artisan app:install
```

## 13. Create administrator accounts ##

Inorder to create a administrator account, run the below command.

```
php artisan app:create-admin-account
```

## 14. Create user accounts ##

Inorder to create a user account, run the below command.

```
php artisan app:create-user-account
```

> Author : Kenura R. Gunarathna

> Tele : +94-777-190-590, +94-715-240-840

> Email : kenuragunarathna@gmail.com
