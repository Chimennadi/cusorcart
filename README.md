## Laravel E-commerce Website

#### Laravel-based ecommerce application. An online store with essential features such as product catalog, shopping cart, order management, user authentication, and payment integration.

[![StyleCI](https://styleci.io/repos/44714043/shield?branch=master)](https://styleci.io/repos/44714043)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/1342-shield.svg)](https://madewithlaravel.com/p/laravel-auth/shield-link)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![Vultr](https://img.shields.io/badge/Vultr-007BFC.svg?style=flat&logo=vultr)](https://www.vultr.com/?ref=9338425-8H)
[![GitHub Stars](https://img.shields.io/github/stars/jeremykenedy/laravel-auth?style=social)](https://github.com/Chimennadi)
[![Follow on GitHub](https://img.shields.io/github/followers/jeremykenedy?style=social)](https://github.com/Chimennadi)
[![Follow on Twitter](https://img.shields.io/twitter/follow/developernator?style=social&logo=twitter)](https://twitter.com/intent/follow?screen_name=developernator)

> This project is still under development.<br>
> Please consider [supporting my work] if you use & find it useful. ❤️

### Note


#### Table of contents

-   [About](#about)
-   [Features](#features)
-   [Installation Instructions](#installation-instructions)
    -   [Optionally Build Cache](#optionally-build-cache)
-   [Routes](#routes)
-   [Socialite](#socialite)
    -   [Get Socialite Login API Keys](#get-socialite-login-api-keys)
    -   [Add More Socialite Logins](#add-more-socialite-logins)
-   [Other API keys](#other-api-keys)
-   [Environment File](#environment-file)
-   [Updates](#updates)
-   [Screenshots](#screenshots)
-   [File Tree](#file-tree)
-   [Opening an Issue](#opening-an-issue)

### About

Laravel 10 with user authentication, registration with email confirmation, social media authentication, password recovery, and captcha protection. Uses official [Bootstrap 4](https://getbootstrap.com). This also makes full use of Controllers for the routes, templates for the views, and makes use of middleware for routing. Project can be stood up in minutes.

### Features

### Installation Instructions

1. Run `git clone https://github.com/Chimennadi/cusorcart.git cusorcart`
2. Create a MySQL database for the project
    - `mysql -u root -p`, if using Vagrant: `mysql -u homestead -psecret`
    - `create database laravelAuth;`
    - `\q`
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Install composer, php-mysql, php-ext and php-dom (dependent on your distrubtion, For Debian run `apt install composer php-mysql php-ext php-dom`)
6. Run `composer update` from the projects root folder
7. From the projects root folder run:

7. From the projects root folder run `sudo chmod -R 755 ../cusorcart`
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
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

### Socialite

#### Get Socialite Login API Keys:

-   [Google Captcha API](https://www.google.com/recaptcha/admin#list)
-   [Facebook API](https://developers.facebook.com/)
-   [Twitter API](https://apps.twitter.com/)
-   [Google &plus; API](https://console.developers.google.com/)
-   [GitHub API](https://github.com/settings/applications/new)
-   [YouTube API](https://developers.google.com/youtube/v3/getting-started)
-   [Twitch TV API](https://www.twitch.tv/kraken/oauth2/clients/new)
-   [Instagram API](https://instagram.com/developer/register/)
-   [37 Signals API](https://github.com/basecamp/basecamp-classic-api)

#### Add More Socialite Logins

-   See full list of providers: [https://socialiteproviders.github.io](https://socialiteproviders.github.io/#providers)

###### **Steps**:

1. ### Other API keys

-   [Google Maps API v3 Key](https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key)

### Environment File

Example `.env` file:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_PROJECT_VERSION=7

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

EMAIL_EXCEPTION_ENABLED=false
EMAIL_EXCEPTION_FROM="${MAIL_FROM_ADDRESS}"
EMAIL_EXCEPTION_TO='email1@gmail.com, email2@gmail.com'
EMAIL_EXCEPTION_CC=''
EMAIL_EXCEPTION_BCC=''
EMAIL_EXCEPTION_SUBJECT=''

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

ACTIVATION=true
ACTIVATION_LIMIT_TIME_PERIOD=24
ACTIVATION_LIMIT_MAX_ATTEMPTS=3
NULL_IP_ADDRESS=0.0.0.0

DEBUG_BAR_ENVIRONMENT=local

USER_RESTORE_CUTOFF_DAYS=31
USER_RESTORE_ENCRYPTION_KEY=
USER_LIST_PAGINATION_SIZE=50

LARAVEL_2STEP_ENABLED=false
LARAVEL_2STEP_DATABASE_CONNECTION=mysql
LARAVEL_2STEP_DATABASE_TABLE=laravel2step
LARAVEL_2STEP_USER_MODEL=App\Models\User
LARAVEL_2STEP_EMAIL_FROM=
LARAVEL_2STEP_EMAIL_FROM_NAME="Laravel 2 Step Verification"
LARAVEL_2STEP_EMAIL_SUBJECT='Laravel 2 Step Verification'
LARAVEL_2STEP_EXCEEDED_COUNT=3
LARAVEL_2STEP_EXCEEDED_COUNTDOWN_MINUTES=1440
LARAVEL_2STEP_VERIFIED_LIFETIME_MINUTES=360
LARAVEL_2STEP_RESET_BUFFER_IN_SECONDS=300
LARAVEL_2STEP_CSS_FILE="css/laravel2step/app.css"
LARAVEL_2STEP_APP_CSS_ENABLED=false
LARAVEL_2STEP_APP_CSS="css/app.css"
LARAVEL_2STEP_BOOTSTRAP_CSS_CDN_ENABLED=true
LARAVEL_2STEP_BOOTSTRAP_CSS_CDN="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"

DEFAULT_GRAVATAR_SIZE=80
DEFAULT_GRAVATAR_FALLBACK=http://c1940652.r52.cf0.rackcdn.com/51ce28d0fb4f442061000000/Screen-Shot-2013-06-28-at-5.22.23-PM.png
DEFAULT_GRAVATAR_SECURE=false
DEFAULT_GRAVATAR_MAX_RATING=g
DEFAULT_GRAVATAR_FORCE_DEFAULT=false
DEFAULT_GRAVATAR_FORCE_EXTENSION=jpg


LARAVEL_BLOCKER_USER_MODEL=App\Models\User
LARAVEL_BLOCKER_AUTH_ENABLED=true
LARAVEL_BLOCKER_ROLES_ENABLED=true
LARAVEL_BLOCKER_FLASH_MESSAGES_ENABLED=false
LARAVEL_BLOCKER_JQUERY_CDN_ENABLED=false
LARAVEL_BLOCKER_BLADE_PLACEMENT_CSS='template_linked_css'
LARAVEL_BLOCKER_BLADE_PLACEMENT_JS='footer_scripts'
LARAVEL_BLOCKER_USE_TYPES_SEED_PUBLISHED=true
LARAVEL_BLOCKER_USE_ITEMS_SEED_PUBLISHED=true


```

#### Laravel Developement Packages Used References

-   https://laravel.com/docs/master/authentication
-   https://laravel.com/docs/master/authorization
-   https://laravel.com/docs/master/routing
-   https://laravel.com/docs/master/migrations
-   https://laravel.com/docs/master/queries
-   https://laravel.com/docs/master/views
-   https://laravel.com/docs/master/eloquent
-   https://laravel.com/docs/master/eloquent-relationships
-   https://laravel.com/docs/master/requests
-   https://laravel.com/docs/master/errors

###### Updates:

-   Update to Laravel 10 (Major Changes)
-   Update to Laravel 9
-   Update to Laravel 8
-   Update to Laravel 7 [See changes in this PR](https://github.com/jeremykenedy/laravel-auth/pull/348/files)
-   Update to Laravel 6
-   Update to Laravel 5.8
-   Added [Laravel Blocker Package](https://github.com/jeremykenedy/laravel-blocker)
-   Added [PHP Info Package](https://github.com/jeremykenedy/laravel-phpinfo)
-   Update to Bootstrap 4
-   Update to Laravel 5.7
-   Added optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)
-   Added activity logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)
-   Added Configurable Email Notification using [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)
-   Update to Laravel 5.5
-   Added User Delete with Goodbye email
-   Added User Restore Deleted Account from email with secure token
-   Added [Soft Deletes](https://laravel.com/docs/master/eloquent#soft-deleting) and Soft Deletes Management panel
-   Added User Account Settings to Profile Edit
-   Added User Change Password to Profile Edit
-   Added User Delete Account to Profile Edit
-   Added [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)
-   Added [hideShowPassword](https://github.com/cloudfour/hideShowPassword)
-   Added Admin Routing Details
-   Admin PHP Information
-   Added Robust [Laravel Logging](https://laravel.com/docs/master/errors#logging) with admin UI using MonoLog
-   Added Active Nav states using [Laravel Requests](https://laravel.com/docs/master/requests)
-   Added [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) with Service Provider to manage status in `.env` file.
-   Updated Capture IP not found IP address
-   Added User Avatar Image AJAX Upload with [Dropzone.js](http://www.dropzonejs.com/#configuration)
-   Added User Gravatar using Gravatar API
-   Added Themes Management.
-   Add user profiles with seeded list and global view
-   Major overhaul on Laravel 5.4
-   Update from Laravel 5.1 to 5.2
-   Added eloquent editable user profile
-   Added IP Capture
-   Added Google Maps API v3 for User Location lookup
-   Added Google Maps API v3 for User Location Input Geocoding
-   Added Google Maps API v3 for User Location Map with Options
-   Added CRUD(Create, Read, Update, Delete) User Management

### Screenshots

![Login](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/login.png)
![Register](https://github.com/Chimennadi/cusorcart/blob/main/screenshots/register.png)

![Admin Panel Users List](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/11laravel-auth2-users-list.jpg)
![Admin Panel Delete User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/12laravel-auth2-modal-delete.jpg)
![Admin Panel Flash Error](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/13laravel-auth2-flash-error.jpg)
![Admin Panel Show User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/14laravel-auth2-show-edit.jpg)
![Admin Panel Edit User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/15laravel-auth2-edit-user.jpg)
![Admin Panel Save Edits](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/16laravel-auth2-modal-save.jpg)
![Admin Panel Create User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/17laravel-auth-create-user.jpg)

![dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/1-dashboard.jpg)
![drilldown](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/2-drilldown.jpg)
![confirm-clear](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/3-confirm-clear.jpg)
![log-cleared-msg](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/4-log-cleared-msg.jpg)
![cleared-log](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-cleared-log.jpg)
![confirm-restore](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-confirm-restore.jpg)
![confirm-destroy](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/6-confirm-destroy.jpg)
![success-destroy](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/7-success-destroy.jpg)
![success-restored](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/8-success-restored.jpg)
![cleared-drilldown](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/9-cleared-drilldown.jpg)

![Verification Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/1-verification-page.jpeg)
![Resent Email Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/2-verification-email-resent.jpeg)
![Lock Warning Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/3-lock-warning.jpeg)
![Locked Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/4-lock-screen.jpeg)
![Verification Email](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/5-verification-email.jpeg)

![Laravel Blocker Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker0.jpg)
![Laravel Blocker Search](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker1.jpg)
![Laravel Blocker Create](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker2.jpg)
![Laravel Blocker View](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker3.jpg)
![Laravel Blocker Edit](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker4.jpg)
![Laravel Blocker Delete Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker5.jpg)
![Laravel Blocker Deleted Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker6.jpg)
![Laravel Blocker Destroy Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker7.jpg)
![Laravel Blocker Flash Message](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker8.jpg)
![Laravel Blocker Restore Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker9.jpg)
![Laravel Blocker Restore Flash Message](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker10.jpg)

![Laravel Roles GUI Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-1.png)
![Laravel Roles GUI Create New Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-2.png)
![Laravel Roles GUI Edit Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-3.png)
![Laravel Roles GUI Show Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-4.png)
![Laravel Roles GUI Delete Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-5.png)
![Laravel Roles GUI Success Deleted](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-6.png)
![Laravel Roles GUI Deleted Role Show](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-7.png)
![Laravel Roles GUI Restore Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-8.png)
![Laravel Roles GUI Delete Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-9.png)
![Laravel Roles GUI Show Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-10.png)
![Laravel Roles GUI Permissions Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-11.png)
![Laravel Roles GUI Create New Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-12.png)
![Laravel Roles GUI Roles Soft Deletes Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-13.png)
![Laravel Roles GUI Permissions Soft Deletes Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-14.png)
![Laravel Roles GUI Success Restore](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-15.png)

### File Tree

```bash
laravel-auth
├── .editorconfig
├── .env
├── .env.example
├── .env.travis
├── .gitattributes
├── .github
│   ├── FUNDING.yml
│   └── ISSUE_TEMPLATE
│       ├── bug_report.md
│       ├── feature_request.md
│       └── project-questions-and-help.md
├── .gitignore
├── .phpunit.result.cache
├── .styleci.yml
├── .travis.yml
├── CODE_OF_CONDUCT.md
├── LICENSE
├── README.md
├── _config.yml
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   └── DeleteExpiredActivations.php
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AdminDetailsController.php
│   │   │   ├── Auth
│   │   │   │   ├── ActivateController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── SocialController.php
│   │   │   ├── Controller.php
│   │   │   ├── ProfilesController.php
│   │   │   ├── RestoreUserController.php
│   │   │   ├── SoftDeletesController.php
│   │   │   ├── TermsController.php
│   │   │   ├── ThemesManagementController.php
│   │   │   ├── UserController.php
│   │   │   ├── UsersManagementController.php
│   │   │   └── WelcomeController.php
│   │   ├── Kernel.php
│   │   ├── Middleware
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckCurrentUser.php
│   │   │   ├── CheckForMaintenanceMode.php
│   │   │   ├── CheckIsUserActivated.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustProxies.php
│   │   │   └── VerifyCsrfToken.php
│   │   ├── Requests
│   │   │   ├── DeleteUserAccount.php
│   │   │   ├── UpdateUserPasswordRequest.php
│   │   │   └── UpdateUserProfile.php
│   │   └── ViewComposers
│   │       └── ThemeComposer.php
│   ├── Logic
│   │   ├── Activation
│   │   │   └── ActivationRepository.php
│   │   └── Macros
│   │       └── HtmlMacros.php
│   ├── Mail
│   │   └── ExceptionOccured.php
│   ├── Models
│   │   ├── Activation.php
│   │   ├── Profile.php
│   │   ├── Social.php
│   │   ├── Theme.php
│   │   └── User.php
│   ├── Notifications
│   │   ├── SendActivationEmail.php
│   │   └── SendGoodbyeEmail.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── ComposerServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── LocalEnvironmentServiceProvider.php
│   │   ├── MacroServiceProvider.php
│   │   └── RouteServiceProvider.php
│   └── Traits
│       ├── ActivationTrait.php
│       ├── CaptchaTrait.php
│       └── CaptureIpTrait.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── autoload.php
│   └── cache
│       ├── .gitignore
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── debugbar.php
│   ├── exceptions.php
│   ├── filesystems.php
│   ├── gravatar.php
│   ├── hashing.php
│   ├── laravel2step.php
│   ├── laravelPhpInfo.php
│   ├── laravelblocker.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── roles.php
│   ├── services.php
│   ├── session.php
│   ├── settings.php
│   ├── usersmanagement.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── ModelFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2016_01_15_105324_create_roles_table.php
│   │   ├── 2016_01_15_114412_create_role_user_table.php
│   │   ├── 2016_01_26_115212_create_permissions_table.php
│   │   ├── 2016_01_26_115523_create_permission_role_table.php
│   │   ├── 2016_02_09_132439_create_permission_user_table.php
│   │   ├── 2017_03_09_082449_create_social_logins_table.php
│   │   ├── 2017_03_09_082526_create_activations_table.php
│   │   ├── 2017_03_20_213554_create_themes_table.php
│   │   ├── 2017_03_21_042918_create_profiles_table.php
│   │   ├── 2017_12_09_070937_create_two_step_auth_table.php
│   │   ├── 2019_02_19_032636_create_laravel_blocker_types_table.php
│   │   ├── 2019_02_19_045158_create_laravel_blocker_table.php
│   │   └── 2019_08_19_000000_create_failed_jobs_table.php
│   └── seeds
│       ├── BlockedItemsTableSeeder.php
│       ├── BlockedTypeTableSeeder.php
│       ├── ConnectRelationshipsSeeder.php
│       ├── DatabaseSeeder.php
│       ├── PermissionsTableSeeder.php
│       ├── RolesTableSeeder.php
│       ├── ThemesTableSeeder.php
│       └── UsersTableSeeder.php
├── license.svg
├── package-lock.json
├── package.json
├── phpunit.xml
├── public
│   ├── .htaccess
│   ├── css
│   │   ├── app.css
│   │   └── laravel2step
│   │       ├── app.css
│   │       └── app.min.css
│   ├── favicon.ico
│   ├── fonts
│   │   ├── fontawesome-webfont.eot
│   │   ├── fontawesome-webfont.svg
│   │   ├── fontawesome-webfont.ttf
│   │   ├── fontawesome-webfont.woff
│   │   ├── fontawesome-webfont.woff2
│   │   ├── glyphicons-halflings-regular.eot
│   │   ├── glyphicons-halflings-regular.svg
│   │   ├── glyphicons-halflings-regular.ttf
│   │   ├── glyphicons-halflings-regular.woff
│   │   └── glyphicons-halflings-regular.woff2
│   ├── images
│   │   ├── wink.png
│   │   └── wink.svg
│   ├── index.php
│   ├── js
│   │   ├── app.99230f42ad184f498ce6.js
│   │   ├── app.js
│   │   └── app.js.LICENSE.txt
│   ├── mix-manifest.json
│   ├── robots.txt
│   └── web.config
├── resources
│   ├── assets
│   │   ├── js
│   │   │   ├── app.js
│   │   │   ├── bootstrap.js
│   │   │   └── components
│   │   │       ├── ExampleComponent.vue
│   │   │       └── UsersCount.vue
│   │   ├── sass
│   │   │   ├── _avatar.scss
│   │   │   ├── _badges.scss
│   │   │   ├── _bootstrap-social.scss
│   │   │   ├── _buttons.scss
│   │   │   ├── _forms.scss
│   │   │   ├── _helpers.scss
│   │   │   ├── _hideShowPassword.scss
│   │   │   ├── _lists.scss
│   │   │   ├── _logs.scss
│   │   │   ├── _margins.scss
│   │   │   ├── _mixins.scss
│   │   │   ├── _modals.scss
│   │   │   ├── _panels.scss
│   │   │   ├── _password.scss
│   │   │   ├── _socials.scss
│   │   │   ├── _typography.scss
│   │   │   ├── _user-profile.scss
│   │   │   ├── _variables.scss
│   │   │   ├── _visibility.scss
│   │   │   ├── _wells.scss
│   │   │   └── app.scss
│   │   └── scss
│   │       └── laravel2step
│   │           ├── _animations.scss
│   │           ├── _mixins.scss
│   │           ├── _modals.scss
│   │           ├── _variables.scss
│   │           ├── _verification.scss
│   │           └── app.scss
│   ├── lang
│   │   ├── en
│   │   │   ├── auth.php
│   │   │   ├── emails.php
│   │   │   ├── forms.php
│   │   │   ├── modals.php
│   │   │   ├── pagination.php
│   │   │   ├── passwords.php
│   │   │   ├── permsandroles.php
│   │   │   ├── profile.php
│   │   │   ├── socials.php
│   │   │   ├── terms.php
│   │   │   ├── themes.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   ├── fr
│   │   │   ├── auth.php
│   │   │   ├── emails.php
│   │   │   ├── forms.php
│   │   │   ├── modals.php
│   │   │   ├── pagination.php
│   │   │   ├── passwords.php
│   │   │   ├── permsandroles.php
│   │   │   ├── profile.php
│   │   │   ├── socials.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   └── pt-br
│   │       ├── auth.php
│   │       ├── emails.php
│   │       ├── forms.php
│   │       ├── modals.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       ├── permsandroles.php
│   │       ├── profile.php
│   │       ├── socials.php
│   │       ├── themes.php
│   │       ├── titles.php
│   │       ├── usersmanagement.php
│   │       └── validation.php
│   └── views
│       ├── auth
│       │   ├── activation.blade.php
│       │   ├── exceeded.blade.php
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   └── register.blade.php
│       ├── emails
│       │   └── exception.blade.php
│       ├── errors
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   ├── 500.blade.php
│       │   └── 503.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       ├── modals
│       │   ├── modal-delete.blade.php
│       │   ├── modal-form.blade.php
│       │   └── modal-save.blade.php
│       ├── pages
│       │   ├── admin
│       │   │   ├── active-users.blade.php
│       │   │   ├── home.blade.php
│       │   │   └── route-details.blade.php
│       │   ├── public
│       │   │   └── terms.blade.php
│       │   ├── status.blade.php
│       │   └── user
│       │       └── home.blade.php
│       ├── panels
│       │   └── welcome-panel.blade.php
│       ├── partials
│       │   ├── errors.blade.php
│       │   ├── form-status.blade.php
│       │   ├── nav.blade.php
│       │   ├── search-users-form.blade.php
│       │   ├── socials-icons.blade.php
│       │   ├── socials.blade.php
│       │   ├── status-panel.blade.php
│       │   └── status.blade.php
│       ├── profiles
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── scripts
│       │   ├── check-changed.blade.php
│       │   ├── datatables.blade.php
│       │   ├── delete-modal-script.blade.php
│       │   ├── form-modal-script.blade.php
│       │   ├── gmaps-address-lookup-api3.blade.php
│       │   ├── google-maps-geocode-and-map.blade.php
│       │   ├── save-modal-script.blade.php
│       │   ├── search-users.blade.php
│       │   ├── toggleStatus.blade.php
│       │   ├── tooltips.blade.php
│       │   └── user-avatar-dz.blade.php
│       ├── themesmanagement
│       │   ├── add-theme.blade.php
│       │   ├── edit-theme.blade.php
│       │   ├── show-theme.blade.php
│       │   └── show-themes.blade.php
│       ├── usersmanagement
│       │   ├── create-user.blade.php
│       │   ├── edit-user.blade.php
│       │   ├── show-deleted-user.blade.php
│       │   ├── show-deleted-users.blade.php
│       │   ├── show-user.blade.php
│       │   └── show-users.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── server.php
└── webpack.mix.js
```

-   Tree command can be installed using brew: `brew install tree`
-   File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests'`

### Opening an Issue

Before opening an issue there are a couple of considerations:

-   You are all awesome!
-   **Please Read the instructions** and make sure all steps were _followed correctly_.
-   **Please Check** that the issue is not _specific to the development environment_ setup.
-   **Please Provide** _duplication steps_.
-   **Please Attempt to look into the issue**, and if you _have a solution, make a pull request_.
-   **Please Show that you have made an attempt** to _look into the issue_.
-   **Please Check** to see if the issue you are _reporting is a duplicate_ of a previous reported issue.

### Laravel Auth License

Licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!

### Contributors

-   Thanks goes to these [wonderful people](https://github.com/jeremykenedy/laravel-auth/graphs/contributors):
-   Please feel free to contribute and make pull requests!
