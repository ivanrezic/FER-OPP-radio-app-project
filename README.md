# Kada skinete projekt:

### 1. iz radio direkotrija pozovite composer update 
### 2. u phpmyadmin otidite u radiodb i oznacite sve tablice pa kliknite drop
### 3. kopirajte sql kod koji je renic uploadao na slack ili skinite .sql file i importajte u radiodb
### 4. u public/playerstuff napravite folder songs i unutra stavite pjesme (koje je isto renic uploadao na slack)
### 5. dodajte .env file koji izgleda kao .env.example  (APP_KEY generirajte pozivom  *php artisan key:generate*)
### 6. php artisan serve
