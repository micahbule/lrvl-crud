# Summer Workshop 2016

## Installation
	- Clone this repo
	- Execute the `composer install` command in the project's root directory
	- Rename `.env.example` file to `.env` and set your environment variables (such as DB host, username and password)
	- Run the migrations by executing the `php artisan migrate` command **(NOTE: MAKE SURE YOU ALREADY CONFIGURED YOUR DB PROPERLY)**
	- Execute `php artisan serve` command and browse the app via http://localhost:8000
	- **OPTIONAL** Execute `php artisan db:seed` for the seeds