# IVBSHS-LMS
Ignacio B. Villamor Senior High School - Library Management System

## Cloning Instructions
1. Clone repository from your local machine.
2. Using your bash/cmd/terminal, locate the project directory.
3. Open the directory with your preferred code editor
4. Look for **.env.example**.
5. Duplicate this file and rename it to **.env**.
8. Open the newly duplicated file and locate the database connection properties.
9. Follow the steps under **Database Configuration**.
10. If you are using the online credentials from your team leader **DO NOT RUN STEP 9**
11. Follow the steps under **SMTP Configuration**.
6. Run `composer update`.
7. If problems come up, run `php artisan clear:cache` then, `php artisan config:cache`
12. Using your bash/cmd/terminal, run `php artisan migrate`.
13. To install NPM scripts, run `npm install`. 
14. To compile sass and your javascripts, run `npm run dev`.

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

## SMTP Configuration
The `.env` by default has the following values:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

```

Replace the values above with the email credentials corresponding to your local or development environment. 
