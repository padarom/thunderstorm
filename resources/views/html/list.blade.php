<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ env('PAGE_TITLE') }}</title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script   src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 35px;">
            <table class="table">
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