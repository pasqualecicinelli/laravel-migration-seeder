@extends('layouts.app')

@section('main-content')
    <section class="container mt-5">

        @forelse ($trains as $train)
            <ul class="list-group my-5">


                <li class="list-group-item">
                    <h5>Numero Id: {{ $train->id }}</h5>
                </li>

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

    </section>
@endsection
