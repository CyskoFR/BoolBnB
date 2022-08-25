<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

TEST
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs)

If you don't feel like reading, [Laracasts](https://laracasts.com) can help.

<br/>
<br/>

# Boilerplate Progetto Finale

1. ## Inizializzazione progetto

-   Clonare la repo : git clone url repo oppure download da github
-   Installare i pacchetti _PHP_ e _JS_ :

    > `composer install & npm install`

-   Creare il proprio file .env per le variabili di ambiente locali
-   Copiare il contenuto del file .env-example nel file .env e seguire le istruzioni al suo interno. Nel file di esempio e' gia settato lo storage driver in public, quindi non servira' aggiungerlo in seguito.
-   Generare la chiave personale:
    > `php artisan key:generate`
-   Eseguire il comando per pulire la cache del config

    > `php artisan config:clear`

-   Avviare server progetto e compilatore di webpack

    > `php artisan serve & npm run watch`

    (se non funzionano assieme lanciateli in due terminali diversi)

<br>

## Lo scaffolding di Autenticazione e di separazione tra Front-End SPA e Back-end monolitico **E' GIA STATO REALIZZATO ED E' PRONTO PER ESSERE USATO**. Siete liberi di apportare le modifiche che volete a vostro rischio e pericolo. La procedura ha seguito perfettamente quella vista a lezione, quindi se avete problemi sapete dove recuperare lezioni e slide.

<br>

2. ## Collegamento al database

-   Avviare il server mysql/apache da xampp/mampp per avere acccesso al database e a phpMyAdmin
-   Parametri di connessione al database:
    inserire la porta del DB, il nome del DB, utente/password [se esiste]
-   Eseguire le migrazioni:
    > `php artisan migrate`
-   [opzionale] Eseguire il seed del DB:

    > `php artisan db:seed`

<br>

3. ## Laravel Storage per asset Media

-   Impostiamo il Driver di default in public, il parametro e' gia stato inserito nell'ultima rida di .env-example, quindi una volta eseguita la copia in env dovrebbe risultare gia' settato:
    > `FILESYSTEM_DRIVER=public`
-   Creiamo il symlink "storage" nella cartella public che punta alla cartella _storage/app/public_:

    > `php artisan storage:link`

<br>

4. ## Laravel Mail

-   Per drivers API based come mailgun utilizziamo la libreria guzzle (gia' inclusa con composer install eseguito precedentemente):

    > `composer require guzzlehttp/guzzle`

-   Per testare l’invio delle Mail useremo [Mailtrap](https://Mailtrap.io) iscrivetevi e inserite i dati configurazione sul file **.env**:
    <br>
    > `MAIL_MAILER=smtp` <br> `MAIL_HOST=smtp.mailtrap.io` <br> `MAIL_USERNAME=null`<br> `MAIL_PASSWORD=null` <br> `MAIL_ENCRYPTION=null` <br> `MAIL_FROM_ADDRESS=null` <br> `MAIL_FROM_NAME="${APP_NAME}"`

<br>
<br>

# Elenco Comandi Fondamentali

## Comandi Controller

-   Creazione controller:
    > `php artisan make:controller NomeController` **NOME AL SINGOLARE**
-   Creazione controller (CON FUNZIONI BASE CRUD) e {CREAZIONE AUTOMATICA DEL MODEL}:

    > `php artisan make:controller NomeController (-r) {-m} `<br/>

-   **Extra** Lista routes dopo crazione Controller:
    > `php artisan route:list`

<br/>

## Comandi Model

-   Crea il model :
    > `php artisan make:model NomeModel` **NOME AL SINGOLARE**

<br>

## Comandi Migrations

-   Crea una nuova tabella di nome {table-name} **NOME PLURALE**:
    > `php artisan make:migration create_{table-name}_table`
-   Aggiunge colonna (colum-name) nella table {table-name}:
    > `php artisan make:migration add_(column-name)_to_{table-name}_table --table={table-name}`
-   Esegue tutte le migrazioni non eseguite:
    > `php artisan migrate`
-   Annullamento dell'ultima batch di migrazioni:
    > `php artisan migrate:rollback`
-   Refresh del database: roolback di tutte le migrazioni e successiva migrazione di esse **ELIMINA TUTTI I DATI NEL DATABASE**:
    > `php artisan migrate:fresh`

<br>

## Comandi DataBase Seed

-   Creazione seeder:
    > `php artisan make:seeder (Table-name)TableSeeder`
-   Esegue seed specifico per la classe passata come parametro --class:
    > `php artisan db:seed --class:(Table-name)TableSeeder`
-   Seed globale del database (va settato a mano):
    > `php artisan db:seed`
