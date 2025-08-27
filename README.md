# SCAFOLDING PROCESS :
* create laravel app: laravel new myapp
* create BaseRepository.php: php artisan make:class Repositories/BaseRepository
* create UserRepository.php: php artisan make:class Repositories/UserRepository
* create UserService.php: php artisan make:class Services/UserService
* create Response:macro in AppServiceProvider.php boot(); for API response

## ACCESS MODIFIERS
* public = house door is always open.
* protected = only family (child classes) can enter.
* private = only you can access your bedroom.

## CREATING WHOLE EVENTS, LISTENERS, MAIL
* php artisan make:event UserRegistered
* php artisan make:listener SendWelcomeEmail --event=UserRegistered
* php artisan make:listener NotifyAdmin --event=UserRegistered
* php artisan make:mail WelcomeMail --markdown=emails.welcome

## CREATING OBSERVER
* php artisan make:observer UserObserver --model=User
* add User::observe(UserObserver::class) in AppServiceProvider.php boot();

## NOTES
* make:resource
* make:request
* php artisan install:api



