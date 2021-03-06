@extends('layout.layout')
@push('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/musicSheetCard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/song.css') }}">
@endpush
@push('extra-js')
    <script crossorigin src='//genius.com/songs/1195035/embed.js'></script>
@endpush
@section('content')
<div style="padding-top: 90px;">

    <!-- Start Hero Area -->
    <section class="hero-area pt-4 pb-4">
        <div class="container mt-4">
            <div class="row">
                <div class="col-7 pt-4">
                    <h2 class="song-title">{{$song->title}}</h2>
                    <h4 class="song-author mt-4">{{$song->author}}</h4>
                    <div class="d-flex align-items-center mt-4 song-info">
                        <div class="icon mr-2">
                            @include('fragments.icons.album')
                            <i></i>
                        </div>
                        <span class="label mr-2">Album: </span>
                        @if($song->album_name != null)
                            <p>{{$song->album_name}}</p>
                        @endif
                        @unless($song->album_name != null)
                            <p>Not specified</p>
                        @endunless
                    </div>
                    @if($song->album_type != null)
                        <div class="d-flex align-items-center mt-4 song-info">
                            <div class="icon mr-2">
                                @include('fragments.icons.album-type')
                                <i></i>
                            </div>
                            <span class="label mr-2">Tipo di Album:</span>
                            <p style="text-transform:capitalize"> {{strtolower($song->album_type)}}</p>
                        </div>
                    @endif
                    @if($song->duration != null)
                        <div class="d-flex align-items-center mt-4 song-info">
                            <div class="icon mr-2">
                                @include('fragments.icons.duration')
                                <i></i>
                            </div>
                            <span class="label mr-2">Durata</span>
                            <p inline="text">{{floor(($song->duration/1000)/60)}} minuti {{($song->duration/1000)%60}} secondi</p>
                        </div>
                    @endif
                    @if($song->spotify_id != null && $song->spotify_id != 0)
                        <iframe title="spotify-player"
                                src="https://open.spotify.com/embed/track/{{$song->spotify_id}}"
                                height="80" allow="encrypted-media" class="spotify-player mt-4">
                        </iframe>
                    @endif
                </div>
                <div class="col-5 pt-5 text-center">
                    @if($song->image_url)
                    <img src="{{asset($song->image_url)}}" alt="song image cover" class="song-image">
                    @endif
                    @unless($song->image_url)
                    <img src="{{asset('/img/nocover.jpg')}}" alt="song image cover" class="song-image">
                    @endunless
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4 pt-4 pb-4">
                    <h3 class="mt-4 mb-4">Testo</h3>
                    <div class="lyrics-container p-4">
                            {{$readable}}
{{--                        <p th:if="${song.lyrics != null}" nl2br:text="${song.lyrics}" class="text-center"></p>--}}
{{--                        <p th:unless="${song.lyrics != null}">Testo non disponibile</p>--}}
{{--                        <p>Testo non disponibile</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Last insert-->
    @if($musicsheets)
        <section class="service section">
            <div class="container">
                <div class="row">
                    <div class="col-12 relative">
                        <div class="section-title align-left">
                            <span class="wow fadeInDown" data-wow-delay=".2s">Spartiti</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">Esplora gli spartiti per il brano</h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">Prendi ispirazione, suona, scarica o riarrangia gli spartiti inseriti dalla nostra community</p>
                        </div>

                        @foreach ($musicsheets as $musicSheet)
                            @include('fragments.musicSheetCard', $musicSheet)
                        @endforeach

                        <img class="service-patern wow fadeInRight overlay-image" data-wow-delay=".5s"
                             src="{{asset('img/service-patern.png')}}" alt="#"
                             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;position: absolute;top: 287px;right: -25px;">
                        <img class="service-patern wow fadeInRight overlay-image" data-wow-delay=".5s"
                             src="{{asset('img/service-patern.png')}}" alt="#"
                             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;position: absolute;bottom: -3px;left: -25px;">
                    </div>
                </div>
            </div>
        </section>
    @endif

</div>
@endsection
