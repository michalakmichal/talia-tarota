<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
 -->
<div width="100%"> <p align="center"> Live <a href src="https://www.taliatarota.pl"> website</a> preview </p> </div>

## About Talia tarota 🔮

Talia tarota is a Single Page Application with extended realtime tarot system. Powered with Laravel and Vue js.
Talia tarota let you conduct online tarot sessions with your clients.
This repository contains: 
- both frontend and backend projects,
- all development assets ( + Adobe Photoshop/XD/Illustrator files),
- database migrations, and sample data for testing provided within factories and seeders,
![themes](/mockup/themes.png)
![preview](/mockup/preview.png)
![chat](/mockup/chat.png)

You can find detailed info about project architecture: [here](#project-architecture).

## Key features
- Tarot session system for custom services :crystal_ball: ,
- Private and public chatrooms :lock: :speech_balloon:,
- Session states (accepted by admin, cancelled, active etc.) ,
- Email alerts and realtime notifications :envelope: :bell: ,
- Newsletter :loudspeaker: ,
- User events (whisper handling) :ear: ,
- Authentication + Authorization - users roles with privileges :key: ,
- Simple CMS for administrator,
- Laravel websockets and Pusher support :white_check_mark: ,
- Responsivness :computer: :iphone: , 
- REST Api,
- Emoji support :star:,
- Darkmode and custom chat themes :art: ,
- Gsap, css animations, page transitions :dizzy: ,
- Scrapper for admin. :japanese_goblin:

## Table of content

- [Server requirements](#server-requirements)
- [Installation](#installation)
- [Technologies](#technologies)
- [Configuration](#configuration)

## Server requirements :gear:
1. Linux + Apache / Nginx / laravel development server + Php,
2. Composer,
3. Mysql database,
4. Pusher / laravel-websockets,
5. Queue background worker.

## Installation :arrow_right:

1. Clone this repository with: `git clone https://github.com/michalakmichal/talia-tarota`,
2. Run `composer install`,
2. Install required javascript dependencies with `npm install`,
   * Node.js is required
3. Setup your server [configuration](#configuration),
4. Run your php server,
5. Run websockets server with `php artisan websockets:serve`,
6. Run queue worker with `php artisan queue:work`,
7. Voila! :alien:

## Technologies
- Laravel 8,
- Laravel Sanctum,
- Laravel websockets,
- Vue js,
- Vue router,
- Vuex,
- axios,
- gsap.


## Configuration
1. Application,
2. Database,
3. Websockets.

## Project architecture


After any change in resources folder You need to ...

### ...
<p> Database connections are handled in Repository with Laravel ORM.</p>
<p> Vue components manage asynchronous API calls. </p>
<p> ViewControlller is responsible for rendering proper view and its transitions. </p>
<p> Reusable components are stored in '/components/partials'.</p>
<p> Code and project patterns are explained on my <a href="https://www.google.com"> blog </a>. </p>


## Mockup
