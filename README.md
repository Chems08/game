# game

- import connexion3.sql to create database and users 

- add all the files in /var/www/html under the directory game

- run ./cron.sh in a terminal  OR  run crontab -e and add the Cronjob : * * * * * cd /var/www/html && ./cron.sh 
  (modifier les * avec le format de la date actuelle pour qu'il ne s'effectue qu'une seule fois) 
