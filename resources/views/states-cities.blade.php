@extends('layouts.app')
@if (!is_null($country) && is_null($state))
    @section('title', 'Restaurants in '.ucwords(str_replace('-', ' ', $countryName)).' | Reviews, Ratings and Locations | Eatry Near Me')
    @section('desc', 'Explore places to eat near you in '.ucwords(str_replace('-', ' ', $countryName)).'. View the preferred neighborhood eateries and peruse the most recent reviews. Find out which restaurants provide delivery and takeaway.')
@elseif (!is_null($country) && !is_null($state) && is_null($city))
    @section('title', 'Best Local Restaurants in '.ucwords(str_replace('-', ' ', $stateName)).', '.strtoupper(str_replace('-', ' ', $country)).' | Eatry Near Me')
    @section('desc', 'Find the best places to eat in '.ucwords(str_replace('-', ' ', $stateName)).', '.ucwords(str_replace('-', ' ', $countryName)))
@elseif (!is_null($country) && !is_null($state) && !is_null($city))
    @section('title', 'Best Local Restaurants in '.ucwords(str_replace('-', ' ', $city)).', '.ucwords(str_replace('-', ' ', $stateName)).' | Eatry Near Me')
    @section('desc', 'Find the best places to eat in '.ucwords(str_replace('-', ' ', $city)).', '.ucwords(str_replace('-', ' ', $stateName)))
@endif

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    @if (!is_null($country) && is_null($state))
                        <h1 class="mb-0 font-size-18">Restaurants in {{ ucwords(str_replace('-', ' ', $countryName)) }}</h1>
                    @elseif (!is_null($country) && !is_null($state) && is_null($city))
                        <h1 class="mb-0 font-size-18">Restaurants in  {{ ucwords(str_replace('-', ' ', $stateName)) }}</h1>
                    @elseif (!is_null($country) && !is_null($state) && !is_null($city))
                        <h1 class="mb-0 font-size-18">Restaurants in  {{ ucwords(str_replace('-', ' ', $city)) }}</h1>
                    @endif



                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            @if (!is_null($country))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('country', $country) }}">{{ ucwords(str_replace('-', ' ', $countryName)) }}</a>
                                </li>
                            @endif
                            @if (!is_null($state))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state]) }}">{{ ucwords(str_replace('-', ' ', $stateName)) }}</a>
                                </li>
                            @endif

                            @if (!is_null($city))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state, 'citySlug' => $city]) }}">{{ ucwords(str_replace('-', ' ', $city)) }}</a>
                                </li>
                            @endif

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">

            @if (!is_null($city))
                @foreach ($data as $r)
                    <div class="col-sm-3">



                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state, 'citySlug' => $city, 'resSlug' => $r->slug]) }}">{{ $r->name }}
                                    </a>
                                </h4>
                                <p class="card-text text-muted font-size-13">{{ $r->address }}</p>
                                <div class="br-wrapper br-theme-css-stars">
                                    <div class="br-widget">
                                        @if ((int)$r->ratings == 1)
                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                        <a href="#" data-rating-value="2" data-rating-text="2"
                                            class=""></a>
                                        <a href="#" data-rating-value="3" data-rating-text="3" class="">
                                        </a>
                                        <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                        </a>
                                        <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                        </a>
                                        @elseif ((int)$r->ratings == 2)
                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                        <a href="#" data-rating-value="2" data-rating-text="2"
                                            class="br-selected"></a>
                                        <a href="#" data-rating-value="3" data-rating-text="3" class="">
                                        </a>
                                        <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                        </a>
                                        <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                        </a>
                                        @elseif ((int)$r->ratings == 3)
                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                        <a href="#" data-rating-value="2" data-rating-text="2"
                                            class="br-selected"></a>
                                        <a href="#" data-rating-value="3" data-rating-text="3" class="br-selected">
                                        </a>
                                        <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                        </a>
                                        <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                        </a>
                                        @elseif ((int)$r->ratings == 4)
                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                        <a href="#" data-rating-value="2" data-rating-text="2"
                                            class="br-selected"></a>
                                        <a href="#" data-rating-value="3" data-rating-text="3" class="br-selected">
                                        </a>
                                        <a href="#" data-rating-value="4" data-rating-text="4" class="br-selected">
                                        </a>
                                        <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                        </a>
                                        @elseif ((int)$r->ratings == 5)
                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                        <a href="#" data-rating-value="2" data-rating-text="2"
                                            class="br-selected"></a>
                                        <a href="#" data-rating-value="3" data-rating-text="3" class="br-selected">
                                        </a>
                                        <a href="#" data-rating-value="4" data-rating-text="4" class="br-selected">
                                        </a>
                                        <a href="#" data-rating-value="5" data-rating-text="5" class="br-selected">
                                        </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            {{-- <img class="card-img-top img-fluid" src="assets/images/small/img-7.jpg" alt="Card image cap"> --}}
                        </div>

                    </div>
                @endforeach

            @else
                @foreach ($data as $s)
                    <div class="col-sm-3">
                        @if (is_null($state))
                            <a href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => strtolower($s->abv)]) }}">
                            @else
                                <a
                                    href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state, 'citySlug' => $s->slug]) }}">
                        @endif
                        <div class="card p-2 text-center">
                            {{ $s->name }}
                        </div>
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection
