<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tournament Teams</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('bulma.min.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="container p-6 has-background-light  has-text-dark">
        <h1 class="title is-1">Tournament</h1>
        @foreach ($teams as $team)

            <div class="panel is-info">
                <div class="panel-heading">
                    <p class="has-text-weight-bold has-text-light">Team {{ $team['name'] }}
                    </p>
                </div>
                <div class="panel-block has-background-white">
                    <div class=" is-flex is-flex-direction-column content">
                        <h4 class="title is-4">{{ $team['players']->count() }} Players</h4>
                        <h5 class="subtitle is-6">Ranking {{ $team['ranking'] }}</h5>
                        <div class="columns is-multiline">
                            @foreach ($team['players'] as $player)
                                <div class="column is-full is-6-tablet is-3-desktop">
                                    {{ $player->fullname }}
                                    @if ($player->isGoalie) 🥅 @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
