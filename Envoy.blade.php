@servers(['aws' => '-i D:\\my-appoinment.pem ubuntu@3.133.87.66','localhost' => '127.0.0.1'])
{{-- @servers([ 'aws' => ['ubuntu@3.18.107.107']]) --}}
{{-- envoy run git:clone --on=aws --}}
@include('vendor/autoload.php')

@setup
    $origin = 'git@github.com:patino8308/MyAppointment';
    $branch = isset($branch) ? $branch : 'master';
    $app_dir = '/var/www/html/MyAppointment';

    if ( !isset($on)) {
        throw new Exception('La variable --on no está definida');
    }
@endsetup

@macro('app:deploy', ['on' => $on])
    down
    git:pull
    migrate
    composer:install
    assets:install
    cache:clear
    up
@endmacro

@task('git:clone', ['on' => $on])
    cd {{ $app_dir }}
    echo "hemos entrado al directorio /var/www/html";
    git clone {{ $origin }};
    echo "repositorio clonado correctamente";
@endtask

@task('git:pull', ['on' => $on])
    cd {{ $app_dir }}
    echo "hemos entrado al directorio {{ $app_dir }}";
    git pull origin {{ $branch }}
    echo "código actualizado correctamente";
@endtask

@task('ls', ['on' => $on])
    cd {{ $app_dir }}
    ls -la
@endtask

@task('composer:install', ['on' => $on])
    cd {{ $app_dir }}
    composer install
@endtask

@task('key:generate', ['on' => $on])
    cd {{ $app_dir }}
    php artisan key:generate
@endtask

@task('migrate', ['on' => $on])
    cd {{ $app_dir }}
    {{-- php artisan migrate --}}
    php artisan migrate:refresh --seed
@endtask

@task('assets:install', ['on' => $on])
    cd {{ $app_dir }}
    yarn install
@endtask

@task('up', ['on' => $on])
    cd {{ $app_dir }}
    php artisan up
@endtask

@task('down', ['on' => $on])
    cd {{ $app_dir }}
    php artisan down
@endtask

@task('cache:clear', ['on' => $on])
    cd {{ $app_dir }}
    php artisan view:clear
    php artisan config:clear
    echo "caché limpiada correctamente";
@endtask
