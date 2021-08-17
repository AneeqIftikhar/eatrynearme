@php
    $revs = json_decode(unserialize($getRes->reviews->json_data));


@endphp
@if(isset($revs) && isset($revs->results))
    @foreach($revs->results->data as $d)
        <div class=" px-0 mx-auto">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-8 col-md-10 col-12 text-center mb-1 px-0">
                    <div class="card py-2">
                        <div class="row d-flex">
                            @if($d->user->name)
                                <div class="d-flex flex-column">
                                    <h3 class="mt-2 mb-0">{{ $d->user->name }}</h3>
                                </div>
                            @endif
                            <div class="ml-auto">
                                <p class="text-muted pt-5 pt-sm-3">{{ date('F, j, Y', strtotime($d->published_date)) }}</p>
                            </div>
                        </div>
                        <div class="">
                            <h4 class="blue-text mt-3">"{{$d->title}}"</h4>
                            <p class="px-4">{{ $d->text }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

