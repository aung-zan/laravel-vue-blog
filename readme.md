### Configuration
- Run ```composer install``` to install dependancies.
- Create ```.env``` file and copy the contents of ```.env.example``` and paste them to ```.env``` file.
- Run ```php artisan key:generate``` to generate app key.
- Make configuration in ```.env file``` to connect with database.
- Run ```php artisan migrate``` to migrate the database.
- Make ```jwt-auth configuration```.
- Run ```npm install``` to install js dependancies.

### jwt-auth configuration
- add these lines in app.php
    - ```Tymon\JWTAuth\Providers\LaravelServiceProvider::class,``` (providers)
    - ```'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,```
    - ```'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class``` (both aliases)
    - ```php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"```
    - ```php artisan jwt:secret```
