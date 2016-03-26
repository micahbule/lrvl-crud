# Summer Workshop 2016

## Installation
- Clone this repo
- Execute the `composer install` command in the project's root directory
- Rename `.env.example` file to `.env` and set your environment variables (such as DB host, username and password)
- Run the migrations by executing the `php artisan migrate` command **(NOTE: MAKE SURE YOU ALREADY CONFIGURED YOUR DB PROPERLY)**
- Make sure you have Bower installed. If not, you can install this via NPM (NPM is Node Package Manager, you need to install NodeJS to use NPM), then execute `bower install` to install our front end asset dependencies such as Bootstrap, jQuery, and KnockoutJS
	* If you need to install NodeJS, you can go [here](https://nodejs.org/en/) or go hardcore with [Node Version Manager](https://github.com/creationix/nvm) NOTE: NVM does not work on Windows
	* If you already have NPM installed, just execute `npm install bower -g`
- Execute `php artisan serve` command and browse the app via http://localhost:8000
- **OPTIONAL** Execute `php artisan db:seed` for the seeds