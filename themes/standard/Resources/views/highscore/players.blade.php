@extends('standard::layouts.default')

@section('title')
Highscore - @parent
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Players highscore
    </div>
    <div class="panel-body">
        <div class="jumbotron">
            <form class="form-inline" role="form" action="{{ route('highscore.players') }}" method="post">
                {{ Form::token() }}
                <div class="form-group">
                    <select name="job" class="form-control">
                        <option>all</option>
                        <option>Warrior</option>
                        <option>Ninja</option>
                        <option>Sura</option>
                        <option>Shaman</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Character name">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="5">Rank</th>
                <th>Name</th>
                <th width="10">Kindom</th>
                <th width="10">Level</th>
                <th width="10">EXP</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($players as $player)
                <tr>
                    <td>{{ $player['rank'] }}</td>
                    <td>{{ $player['name'] }}</td>
                    <td>
                        <img src="{{ assetTheme('img/kindoms/'.$player['empire'].'.png') }}" alt="">
                    </td>
                    <td>{{ $player['level'] }}</td>
                    <td>{{ $player['exp'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $players->links() }}
    </div>
</div>
@stop