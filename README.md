# IVBSHS-LMS
Ignacio B. Villamor Senior High School - Library Management System

## Cloning Instructions
1. Clone repository from your local machine.
2. Using your bash/cmd/terminal, locate the project directory.
3. Run `composer update`.
4. Head to your preferred code editor and look for **.env.example**.
5. Duplicate this file and rename it to **.env**.
6. Open the newly duplicated file and locate the database connection properties.
7. Follow the steps under **Database Configuration**.
8. If you are using the online credentials from your team leader **DO NOT RUN STEP 9**
9. Using your bash/cmd/terminal, run `php artisan migrate`.
10. To install NPM scripts, run `npm install`. 

## Database Configuration
The `.env` by default has the following values:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

```

Replace the values above with the database credentials corresponding to your local or development environment. 
