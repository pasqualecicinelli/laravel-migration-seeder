<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Init project

1. Installa le dipendenze di frontend

```
npm install
```

2. Fai partire il compilatore per i file di frontend

```
npm run dev
```

3. Installa le dipendenze di backend in un nuovo terminale

```
composer install
```

4. Fai partire il server di sviluppo backend

```
php artisan serve
```

5. Copia il file `.env.example` e chiamalo `.env`. Poi esegui il comando per generare la chiave

```
php artisan key:generate
```

## Connessione al DB

1. Avvio MAMP

2. Apro [PHPMyAdmin](http://localhost/phpMyAdmin/?lang=en)

3. Creo un nuovo DB (es. `103_rent`)

4. nel file `.env` aggiungo i parametri di connessione presenti sulla [pagina iniziale di MAMP](http://localhost/MAMP/)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db-trains
DB_USERNAME=root
DB_PASSWORD=root
```

## Creazione di una Migration

Per creare una tabella lanciare il comando

```
php artisan make:migration create_trains_table
```

Aggiungi poi tutte le colonne che rappresentano la tabella nella funzione `up()`. I tipi di dato disponibili sono [qui](https://laravel.com/docs/9.x/migrations#available-column-types)

```php
// create_trains_table

public function up()
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 50);
            $table->string('departure_station', 30);
            $table->string('arrival_station', 30);
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('train_code');
            $table->tinyInteger('number_of_carriages');
            $table->boolean('in_time');
            $table->boolean('deleted');
            $table->timestamps();
        });
    }
```

Eseguo la migrazione appena creata con il comando

```
php artisan migrate
```

## Aggiunta di dati

Aggiungo un paio di righe da [PHPMyAdmin](http://localhost/phpMyAdmin/?lang=en) per visualizzare dati di esempio

## Creazione di un Model

Creo un Model che rappresenti la tabella appena realizzata con il comando

```
php artisan make:model Train
```

## Creazione di un Controller per la risorsa

Creo un Controller per la risorsa `Train` con il comando

```
php artisan make:controller TrainController
```

Importo il controller nel file `routes/web.php` per assegnargli delle rotte

```php
// web.php

use App\Http\Controllers\TrainController;

// ...

// # Rotte risorsa train
Route::get('/train', [TrainController::class, 'index'])->name('train.index');
```

Realizzo una funzione contenente la logica del metodo legato in `routes/web.php` dentro il controller `TrainController.php`. Dovremo

1. importare il modello `Train`
2. nel metodo `index()` recuperare tutte gli elementi della tabella e passarli ad una vista

```php
// TrainController.php

use App\Models\Train;

// ...

class TrainController extends Controller
{
  public function index()
  {
    $trains = Train::all();
    return view('train.index', compact('trains'));
  }
}
```

## Creazione di una vista per visualizzare i dati

creo un file `resources\views\train\index.blade.php` e estendo il layout `app.blade.php`.
In un forelse stamperò tutti i dati ricevuti

```php
@extends('layouts.app')

@section('main-content')
  <section class="container mt-5">

   @forelse ($trains as $train)
            <ul class="list-group my-5">

                <li class="list-group-item">
                    <h5>Compagnia: </h5>{{ $train->company_name }}
                </li>

                <li class="list-group-item">
                    <h5>Orario di Partenza: </h5>{{ $train->departure_time }}
                </li>

                <li class="list-group-item">
                    <h5>Orario di Arrivo: </h5>{{ $train->arrival_time }}
                </li>

                <li class="list-group-item">
                    <h5>Luogo di Partenza: </h5>{{ $train->departure_station }}
                </li>

                <li class="list-group-item">
                    <h5>Luogo di Arrivo: </h5>{{ $train->arrival_station }}
                </li>

                <li class="list-group-item">
                    <h5>Numero treno: </h5> {{ $train->train_code }}
                </li>

            </ul>
        @empty
            <h4>Non ci sono treni</h4>
        @endforelse
@endsection

```

## Creazione di una query per visualizzare i treni nella data odierna

Vado in TrainController e faccio la query con whereDate che prende solo Y-M-D per visualizzare solo i treni della data odienrna

```php

public function index()
    {
        $trains = Train::
            whereDate('departure_time', '=', '2023-10-16')->get();

        return view('train.index', compact('trains'));
    }

```
