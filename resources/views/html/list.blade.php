<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $pageTitle }}</title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css">

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ $pageTitle }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#login">Login</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Language <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($languages as $language)
                                    @if ($language == 'en')
                                        <li><a href="#"><span class="flag-icon flag-icon-gb"></span> en</a></li>
                                    @else
                                        <li><a href="#"><span class="flag-icon flag-icon-{{ $language }}"></span> {{ $language }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <table class="table table-hover">
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $package->identifier }}</td>
                    </tr>
                @endforeach
            </table>
            <footer class="text-right text-muted">
                <small>
                    Built with <a href="https://github.com/padarom/thunderstorm">Padarom's Thunderstorm</a> -- Click <a href="{!! $query !!}">here</a> for the XML version.
                </small>
            </footer>
        </div>
    </body>
</html>