@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    @if (!is_null($country) && is_null($state))
                        <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $country)) }}</h4>
                    @elseif (!is_null($country) && !is_null($state))
                        <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $state)) }}</h4>
                    @endif



                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            @if (!is_null($country))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('country', $country) }}">{{ ucwords(str_replace('-', ' ', $country)) }}</a>
                                </li>
                            @endif
                            @if (!is_null($state))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state]) }}">{{ ucwords(str_replace('-', ' ', $state)) }}</a>
                                </li>
                            @endif

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">


            @foreach ($data as $s)
                <div class="col-sm-3">
                    <a href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $s->slug]) }}">
                        <div class="card p-2 text-center">
                            {{ $s->name }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
