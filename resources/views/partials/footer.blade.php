<div class="container">
    <div class="row" style="margin-bottom:1%; margin-top:5%;">
    @php
        $countries = App\Models\Country::all();
    @endphp

    @foreach ($countries as $c)

        @if($c->states->count() > 0)
        <div class="col-sm-3">
            <a href="{{ route('country', ['countrySlug'=>strtolower($c->abv3)]) }}">
                <div class="card p-2 card-dark-bg ">

                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 text-center" style="">
                            @if ($c->abv == 'UK')
                                <img src="https://countryflagsapi.com/png/gb" alt=""
                                    class="img-fluid img-width-cst img-max-height-cst">
                            @elseif ($c->abv == 'TP')
                                <img src="https://countryflagsapi.com/png/tl" alt=""
                                    class="img-fluid img-width-cst img-max-height-cst">
                            @else
                                <img src="https://eatrynearme.com/country/{{ $c->abv }}.png"
                                    alt="" class="img-fluid img-width-cst img-max-height-cst">
                            @endif
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9" style="">
                            {{ $c->name }}
                        </div>
                    </div>
                </div>

            </a>
        </div>
        @endif
    @endforeach
    </div>
    <div class="row" style="margin-top:5%;">
        <div class="col-sm-6"><p>Copyright © 2022, Eatry Near Me</p></div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-2">
                    <a target="_blank" href="https://www.facebook.com/eatrynearme"><p>Facebook</p></a>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="https://www.instagram.com/eatrynearme/"><p>Instagram</p></a>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="https://www.linkedin.com/company/eatry-near-me/"><p>Linkedin</p></a>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="https://twitter.com/EatryN"><p>Twitter</p></a>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="https://www.pinterest.com/eatrynearme"><p>Pinterest</p></a>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="/blog"><p>Blogs</p></a>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        
        
