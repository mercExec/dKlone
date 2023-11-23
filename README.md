# dKlone: Discord Clone | Laravel 10, Vue 3, TailwindCSS, Ably
A Discord clone with basic functionalities.

This is a personal project that is still being worked on. More features will be added in the future

## Getting Started
### Clone the repository
`git clone https://github.com/mercExec/dKlone.git`

### Install Dependencies
`npm i`

`composer install`

### Create .env File
`cp .env.example .env`

Update BROADCAST_DRIVER to "ably" and add your "ABLY_KEY" 

<pre>
BROADCAST_DRIVER=ably
ABLY_KEY=
</pre>

Don't forget to generate APP_KEY

`php artisan key:generate`

### Create Symlink for storage
`php artisan storage:link`

### Create Database and Tables
`php artisan migrate`

### Run the App
`php artisan server`

`npm run dev`
