@extends('standard::layouts.default')

@section('title')
Highscore - @parent
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Guilds highscore
    </div>
    <div class="panel-body">
        <div class="jumbotron">
            <form class="form-inline" role="form" action="{{ route('highscore.guilds') }}" method="post">
                {{ Form::token() }}
                <div class="form-group">
                    <select name="kindom" class="form-control">
                        <option>all</option>
                        <option>Red</option>
                        <option>Blue</option>
                        <option>Yellow</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Guild name">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="5">Rank</th>
                <th>Name</th>
                <th>Master</th>
                <th width="10">Kindom</th>
                <th width="10">Level</th>
                <th width="10">Points</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($guilds as $guild)
            <tr>
                <td>{{ $guild['rank'] }}</td>
                <td>{{ $guild['guild_name'] }}</td>
                <td>{{ $guild['master_name'] }}</td>
                <td>
                    <img src="{{ assetTheme('img/kindoms/'.$guild['empire'].'.png') }}" alt="">
                </td>
                <td>{{ $guild['level'] }}</td>
                <td>{{ $guild['ladder_point'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop