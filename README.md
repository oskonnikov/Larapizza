# Larapizza
Larapizza is a fictional project created by Oleg Skonnikov as result of executing The Pizza Task.
Working demo available here https://larapizza.site

Installing:
0. git clone https://github.com/oskonnikov/Larapizza
1. set virtual host root folder to Larapizza/public
2. create mysql database and import larapizza.sql from Database folder
3. rename .env.example to .env and set parameters for db
4. composer update
5. php artisan key:generate
6. first user can be admin if you set permissions column to admin of user with id 1
7. admin panel can be opened by /admin or press button on /home page

Test user with admin privileges: 
Email: info@xdevops.ru
Password: larapizzatesting

App is ready