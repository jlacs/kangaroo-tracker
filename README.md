# Kangaroo Tracker

The aim of this project is to develop a very small front end for a fictitious
company to store information about their pet kangaroos. There will be a few
technical requirements that you need to hit, but otherwise you are free to use
your own solutions and approaches throughout the project.

## Installation

- Download or Clone this repository
```
git clone https://github.com/jlacs/kangaroo-tracker
```
- Create a new database ```vokke_db```
- Copy or rename file ```.env.example``` to ```.env```, and edit the file to change the attributes for database to your database configurations (host,username,password etc)
- Open up Command Prompt(CMD) or Terminal in the project directory and run these commands:
```
php artisan migrate
```
- Launch web server
```
php artisan serve
```