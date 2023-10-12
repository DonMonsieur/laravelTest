#JC Monsieur Edmund Tubiera

## Installation

To install the project, follow the steps below:

    1. Clone the project repository by executing the following command in your terminal or command prompt:

    	git clone https://github.com/DonMonsieur/laravelTest.git

### Backend

    1.	Update the PHP dependencies using Composer by running the following command:

    	composer update

    2.	Rename the .env.example file to .env. Change the DB_DATABASE on your database name

    	DB_DATABASE='YOUR DATABASE NAME'

    3.	Run the database migrations and seed the initial data by executing the following command:

    	php artisan migrate:fresh --seed

    4.	Start the PHP development server by running the following command:

    	php artisan serve

### NOTE: This project does not have a frontend. Its purpose is to test API routes to confirm the implementation of one-to-many and many-to-many relationships in Eloquent.