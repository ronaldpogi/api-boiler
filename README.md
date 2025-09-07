## SCAFOLDING PROCESS :
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

# IF YOU WANT AUTHENTICATION SCAFFOLDING
* composer require laravel/breeze --dev
* php artisan breeze:install api
* php artisan migrate
## OR
# JUST CLONET THIS API STARTER
* https://github.com/uguraziz/laravel-12-breeze-api-auth-starter.git

# GIT
* git init
* git add .
* git commit -m "Initial Laravel commit"
* create git repo
* git remote add origin your-repo-link
* git branch -M main
* git push -u origin main

# DRY (Don’t Repeat Yourself)
* Less maintenance → change in one place updates everywhere.
* Fewer bugs from inconsistent logic.
* Cleaner, more scalable code.

# SOLID Principles
* S – Single Responsibility Principle (SRP): A class/module should do one thing and do it well.
* O – Open/Closed Principle (OCP): Code should be open for extension but closed for modification.
* L – Liskov Substitution Principle (LSP): Subclasses should be replaceable with their base classes without breaking functionality.
* I – Interface Segregation Principle (ISP): Don’t force classes to depend on methods they don’t use.
* D – Dependency Inversion Principle (DIP): Depend on abstractions (interfaces), not concrete implementations.

# PINT
* composer require --dev laravel/pint
* ./vendor/bin/pint --parallel
