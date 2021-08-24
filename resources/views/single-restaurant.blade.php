@extends('layouts.app')
@section('title', $getRes->name .', '.ucwords($city). '| Menu, Reviews and Photos | Eatry Near Me')
@section('desc', 'Latest reviews, photos and 👍🏾ratings for '.ucwords($getRes->name).' - at '.ucwords($getRes->address).' in '.ucwords($city).' - view the ✅menu, ⏰hours, ☎️phone number, ☝address and map.')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    {{-- @if (!is_null($country) && is_null($state)) --}}
                    {{-- <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $countryName)) }}</h4> --}}
                    {{-- @elseif (!is_null($country) && !is_null($state) && is_null($city)) --}}
                    {{-- <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $stateName)) }}</h4> --}}
                    {{-- @elseif (!is_null($country) && !is_null($state) && !is_null($city)) --}}
                    {{-- <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $city)) }}</h4> --}}
                    {{-- @elseif (!is_null($country) && !is_null($state) && !is_null($city) && !is_null($getRes)) --}}
                    {{-- <h4 class="mb-0 font-size-18">{{ ucwords(str_replace('-', ' ', $getRes->name)) }}</h4> --}}

                    {{-- @endif --}}


                    <div class="page-title-right ms-auto">
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
                            @if (!is_null($getRes))
                                <li class="breadcrumb-item"><a
                                        href="">{{ ucwords(str_replace('-', ' ', $getRes->name)) }}</a>
                                </li>
                            @endif
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-sm-8 card p-4">

                <h1>{{ $getRes->name }}</h1>

                <div class="row">
                    <div class="col-2 pe-0">
                        <div class="br-wrapper br-theme-css-stars">
                            <div class="br-widget">
                                @if ((int) $getRes->ratings == 1)
                                    <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                    <a href="#" data-rating-value="2" data-rating-text="2" class=""></a>
                                    <a href="#" data-rating-value="3" data-rating-text="3" class="">
                                    </a>
                                    <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                    </a>
                                    <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                    </a>
                                @elseif ((int) $getRes->ratings == 2)
                                    <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                    <a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a>
                                    <a href="#" data-rating-value="3" data-rating-text="3" class="">
                                    </a>
                                    <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                    </a>
                                    <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                    </a>
                                @elseif ((int) $getRes->ratings == 3)
                                    <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                    <a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a>
                                    <a href="#" data-rating-value="3" data-rating-text="3" class="br-selected">
                                    </a>
                                    <a href="#" data-rating-value="4" data-rating-text="4" class="">
                                    </a>
                                    <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                    </a>
                                @elseif ((int) $getRes->ratings == 4)
                                    <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                    <a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a>
                                    <a href="#" data-rating-value="3" data-rating-text="3" class="br-selected">
                                    </a>
                                    <a href="#" data-rating-value="4" data-rating-text="4" class="br-selected">
                                    </a>
                                    <a href="#" data-rating-value="5" data-rating-text="5" class="">
                                    </a>
                                @elseif ((int) $getRes->ratings == 5)
                                    <a href="#" data-rating-value="1" data-rating-text="1"
                                        class="br-selected"></a>
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
                    <div class="col-2 mb-0 ps-0" style="display: flex; justify-content: initial; align-items: center;">
                        <small><b>{{ $getRes->ratings }} - {{ $getRes->num_reviews }} Reviews</b></small>
                    </div>
                </div>
                <i>{{ $getRes->address }}</i>
                @if( $getRes->phone)
                    <i><a href = "tel:{{ $getRes->phone }}" rel="nofollow">{{ $getRes->phone }}</a></i>
                @endif
                @if( $getRes->website)
                    <i><a href = "{{ $getRes->website }}" target="_blank" rel="nofollow">Visit Website</a></i>
                @endif
                <div class="row">
                    @if (!is_null($getRes->image))


                    <div class="col-sm-12  text-center mt-5">
                        <img loading="lazy" src="{{ asset($getRes->image) }}" class="img-fluid" alt="">
                    </div>
                    @endif
                    <div class="col-sm-12 text-center mt-5" style="display: flex;
                    justify-content: center;">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe width="600" height="500" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q={{ str_replace(' ', '%20', $getRes->address) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <a href="https://www.online-timer.net"></a><br>
                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        height: 500px;
                                        width: 600px;
                                    }
                                </style>
                                <a href="https://www.embedgooglemap.net">google map code embed</a>
                                <style>
                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        height: 500px;
                                        width: 600px;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @if(isset($getRes->hours))
                    <h2>{{ ucwords($getRes->name) }} Opening Hours</h2>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" style="margin-bottom: 5%">
                                    Timezone: {{ $getRes->hours->timezone }}
                                </h3>
                                @php
                                    $weekdays = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]
                                @endphp
                                @foreach($getRes->hours->week_ranges as $key => $range)
                                    @if(count($range)>0)
                                        @foreach($range as $key2 => $r)
                                            @if($key2==0)
                                                <p class="card-text font-size-15" style="line-height: 0.8em !important;">{{$weekdays[$key]}}:
                                            @else
                                                <p class="card-text font-size-15" style="line-height: 0.8em !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                            @endif
                                            @if(isset($r->open_time))
                                                {{ date('h:i a', mktime(0,$r->open_time)) }}
                                            @endif
                                            @if(isset($r->close_time))
                                                - {{ date('h:i a', mktime(0,$r->close_time)) }}
                                            @endif
                                                </p>
                                        @endforeach

                                    @else
                                        <p class="card-text font-size-15" style="line-height: 0.8em !important;">{{$weekdays[$key]}}: Closed</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <h3>More Restaurants in {{ ucwords($city) }}</h3>
                @if ($related->count() > 0)
                    @foreach ($related as $r)
                        <div class="col-sm-12">



                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a
                                            href="{{ route('country', ['countrySlug' => $country, 'stateSlug' => $state, 'citySlug' => $city, 'resSlug' => $r->slug]) }}">{{ $r->name }}
                                        </a>
                                    </h4>
                                    <p class="card-text text-muted font-size-13">{{ $r->address }}</p>
                                    <div class="br-wrapper br-theme-css-stars">
                                        <div class="br-widget">
                                            @if ((int) $r->ratings == 1)
                                                <a href="#" data-rating-value="1" data-rating-text="1"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="2" data-rating-text="2"
                                                    class=""></a>
                                                <a href="#" data-rating-value="3" data-rating-text="3"
                                                    class="">
                                                </a>
                                                <a href="#" data-rating-value="4" data-rating-text="4"
                                                    class="">
                                                </a>
                                                <a href="#" data-rating-value="5" data-rating-text="5"
                                                    class="">
                                                </a>
                                            @elseif ((int) $r->ratings == 2)
                                                <a href="#" data-rating-value="1" data-rating-text="1"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="2" data-rating-text="2"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="3" data-rating-text="3"
                                                    class="">
                                                </a>
                                                <a href="#" data-rating-value="4" data-rating-text="4"
                                                    class="">
                                                </a>
                                                <a href="#" data-rating-value="5" data-rating-text="5"
                                                    class="">
                                                </a>
                                            @elseif ((int) $r->ratings == 3)
                                                <a href="#" data-rating-value="1" data-rating-text="1"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="2" data-rating-text="2"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="3" data-rating-text="3"
                                                    class="br-selected">
                                                </a>
                                                <a href="#" data-rating-value="4" data-rating-text="4"
                                                    class="">
                                                </a>
                                                <a href="#" data-rating-value="5" data-rating-text="5"
                                                    class="">
                                                </a>
                                            @elseif ((int) $r->ratings == 4)
                                                <a href="#" data-rating-value="1" data-rating-text="1"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="2" data-rating-text="2"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="3" data-rating-text="3"
                                                    class="br-selected">
                                                </a>
                                                <a href="#" data-rating-value="4" data-rating-text="4"
                                                    class="br-selected">
                                                </a>
                                                <a href="#" data-rating-value="5" data-rating-text="5"
                                                    class="">
                                                </a>
                                            @elseif ((int) $r->ratings == 5)
                                                <a href="#" data-rating-value="1" data-rating-text="1"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="2" data-rating-text="2"
                                                    class="br-selected"></a>
                                                <a href="#" data-rating-value="3" data-rating-text="3"
                                                    class="br-selected">
                                                </a>
                                                <a href="#" data-rating-value="4" data-rating-text="4"
                                                    class="br-selected">
                                                </a>
                                                <a href="#" data-rating-value="5" data-rating-text="5"
                                                    class="br-selected">
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                {{-- <img class="card-img-top img-fluid" src="assets/images/small/img-7.jpg" alt="Card image cap"> --}}
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
            @if (isset($getRes->reviews))
                <div class="col-sm-12">
                    @include('partials.review')
                </div>
            @endif

        </div>
    </div>
@endsection
