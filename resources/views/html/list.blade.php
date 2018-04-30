<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $pageTitle }}</title>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css">

        <script src="//code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar is-danger">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">{{ $pageTitle }}</a>
                </div>

                <div id="navMenuExample" class="navbar-menu">
                    <div class="navbar-end">
                        <a class="navbar-item" href="#">
                            Login
                        </a>

                        <div class="navbar-item has-dropdown is-hoverable">
                            <a href="#" class="navbar-link">
                                Language
                            </a>
                            <div class="navbar-dropdown">
                                @foreach($languages as $language)
                                    @if ($language == 'en')
                                        <a class="navbar-item" href="#"><span class="flag-icon flag-icon-gb"></span> en</a>
                                    @else
                                        <a class="navbar-item" href="#"><span class="flag-icon flag-icon-{{ $language }}"></span> {{ $language }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="packages">
                @foreach ($packages as $package)
                    <div class="box">
                        <div class="level">
                            <div class="level-left"><strong>{{ $package->name }}</strong></div>
                            <div class="level-right">
                                <a href="/package/{{ $package->identifier }}"><div class="tag">{{ $package->identifier }}</div></a>
                            </div>
                        </div>
                        {{ $package->description }}<br>
                        <span class="is-size-7">
                            @if ($package->authorurl)
                                By <a href="{{ $package->authorurl }}">{{ $package->author }}</a>
                            @else 
                                By {{ $package->author }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="level">
                <div class="level-left"></div>
                <div class="level-right">
                    <div class="level-item">
                        <small class="is-size-7">
                            Built with <a href="https://github.com/padarom/thunderstorm">Padarom's Thunderstorm</a> -- Click <a href="{!! $query !!}">here</a> for the XML version.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Inlined style for ease of deployment and development --}}
        <style>
            .packages { margin: 30px 0; }
            .flag-icon { margin-right: 6px; }
            .level { margin-bottom: 0 !important;}
        </style>
    </body>
</html>