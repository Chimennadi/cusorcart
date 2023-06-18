## Laravel E-commerce Website

#### Laravel-based e-commerce application. An online store with essential features such as product catalog, shopping cart, order management, user authentication, and payment integration.

[![StyleCI](https://styleci.io/repos/44714043/shield?branch=master)](https://styleci.io/repos/44714043)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/1342-shield.svg)](https://madewithlaravel.com/p/cusorcart/shield-link)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![GitHub Stars](https://img.shields.io/github/stars/Chimennadi/cusorcart?style=social)](https://github.com/Chimennadi)
[![Follow on GitHub](https://img.shields.io/github/followers/Chimennadi?style=social)](https://github.com/Chimennadi)
[![Follow on Twitter](https://img.shields.io/twitter/follow/beekyhe?style=social&logo=twitter)](https://twitter.com/intent/follow?screen_name=beekyhe)

> This project is still under development.<br>
> Please consider [supporting my work] if you use & find it useful. ❤️

### Note


#### Table of contents

-   [About](#about)
-   [Installation Instructions](#installation-instructions)
    -   [Optionally Build Cache](#optionally-build-cache)
-   [Socialite](#socialite)
    -   [Get Socialite Login API Keys](#get-socialite-login-api-keys)
    -   [Add More Socialite Logins](#add-more-socialite-logins)
-   [Other API keys](#other-api-keys)
-   [Screenshots](#screenshots)
-   [Opening an Issue](#opening-an-issue)

### About

Laravel-based e-commerce application, a B2B(Business-to-business) online store with essential features such as product catalog, shopping cart, order management, user authentication, and payment integration. It also contains both logistics and delivery system.



### Installation Instructions

1. Run `git clone https://github.com/Chimennadi/cusorcart.git cusorcart`
2. Create a MySQL database for the project
    - `mysql -u root -p`, if using Vagrant: `mysql -u homestead -psecret`
    - `create database cusorcart;`
    - `\q`
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Install composer, php-mysql, php-ext and php-dom (dependent on your distribution, For Debian run `apt install composer php-mysql php-ext php-dom`)
6. Run `composer update` from the projects root folder
7. From the projects root folder run:

7. From the projects root folder run `sudo chmod -R 755 ../cusorcart`
8. From the projects root folder run `php artisan key:generate`
10. From the projects root folder run `composer dump-autoload`
12. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix

##### Using Yarn:

1. Install yarn (dependent on your distribution)
2. From the projects root folder run `yarn install`
3. From the projects root folder run `yarn run dev` or `yarn run production`

-   You can watch assets with `yarn run watch`

##### Using NPM:

1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`

-   You can watch assets with `npm run watch`

#### Optionally Build Cache

1. From the projects root folder run `php artisan config:cache`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/master/homestead)


#### Get Socialite Login API Keys:

-   [Google Captcha API](https://www.google.com/recaptcha/admin#list)
-   [Facebook API](https://developers.facebook.com/)
-   [Twitter API](https://apps.twitter.com/)



### Screenshots

-- You can create your own database with name cusorcart
-- Admin Email -- admin@admin.com
-- Admin Password -- 123456(This is used for all the passwords)


![Login](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/login.png)
![Register](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/register.png)
![FrontPage](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/frontpage.png)

`Admin Panel`

![Admin Panel](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/admin.png)

`Seller Panel`

![Seller Panel](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/seller.png)

`Staff Panel`

![Staff Panel](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/staff.png)

`Customer Panel`

![Customer Panel](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/customer.png)

`Delivery Panel`

![Delivery Boy Panel](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/delivery_boy.png)

`Email Verification`

![Email Verification](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/email_register.png)

`MYSQL Database`

![Database](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/database.png)





### Opening an Issue

Before opening an issue there are a couple of considerations:

-   You are all awesome!
-   **Please Read the instructions** and make sure all steps were _followed correctly_.
-   **Please Check** that the issue is not _specific to the development environment_ setup.
-   **Please Provide** _duplication steps_.
-   **Please Attempt to look into the issue**, and if you _have a solution, make a pull request_.
-   **Please Show that you have made an attempt** to _look into the issue_.
-   **Please Check** to see if the issue you are _reporting is a duplicate_ of a previous reported issue.

### Cusorcart License

Licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!

### Contributors

-   Please feel free to contribute and make pull requests!
