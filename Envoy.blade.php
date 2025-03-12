@setup
    require __DIR__.'/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

    try {
        $dotenv->load();
        $dotenv->required(['DEPLOY_SERVER', 'DEPLOY_PATH'])->notEmpty();
    } catch ( Exception $e )  {
        echo $e->getMessage();
        exit;
    }

    $server = $_ENV['DEPLOY_SERVER'];
    $path = $_ENV['DEPLOY_PATH'];
@endsetup

@servers(['web' => $server])

@story('deploy')
    begin
    update
    composer
    npm
    migrate
    optimize
    finish
@endstory

@task('begin')
    echo "Start: enabling maintenance mode..."

    cd {{ $path }}
    php artisan down --with-secret

    echo "End: Successfully enabled maintenance mode"
@endtask

@task('update')
    echo "Start: updating repository..."

    cd {{ $path }}

    echo "End: successfully updated the repository"
@endtask

@task('composer')
    echo "Start: running composer install..."

    cd {{ $path }}
    composer install --no-interaction --quiet --no-dev --optimize-autoloader --no-scripts --no-plugins --prefer-dist

    echo "End: successfully ran composer install"
@endtask

@task('npm')
    echo "Start: running npm install..."

    export NVM_DIR="$HOME/.nvm"
    [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
    [ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"

    cd {{ $path }}
    HUSKY=0 npm install --legacy-peer-deps --silent
    NODE_OPTIONS="--openssl-legacy-provider" npm run production --ignore-scripts --omit=dev

    echo "End: successfully ran npm install"
@endtask

@task('migrate')
    echo "Start: running migrations..."

    cd {{ $path }}
    php artisan migrate --force --env=.env

    echo "End: successfully ran migrations"
@endtask

@task('optimize')
    echo "Start: optimizing the application..."

    cd {{ $path }}
    php artisan optimize:clear
    php artisan optimize

    echo "End: successfully optimized the application"
@endtask

@task('finish')
    echo "Start: disabling maintenance mode..."

    cd {{ $path }}
    php artisan up

    echo "End: successfully disabled maintenance mode"
@endtask