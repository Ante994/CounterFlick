@extends('layouts.master')
@section('content')
<div class="show-profile">
    <ol class="all-results">
    @php
    if (!$player || !$weaponStatistic) {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $userInfoPosition = count($uri) - 2;
        $steamid = $uri[$userInfoPosition];
        @endphp
            <h2>User with Steam ID: {{ $steamid }} does not play shared game or his profile have private settings !</h2>
        @php
    } else {
        @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ date('d.m.Y',$player->lastlogoff) }}</h5>
        </div>
        @php
        foreach ($weaponStatistic['weapon_kills'] as $weapon => $kills) {
            @endphp
            <li class="item">
                <img src="{{ asset('public/images/weapons') }}/{{ $weapon }}.png">
                <h4>{{ strtoupper($weapon) }}</h4>
                <h5>
                    Kills <b>{{ $kills }}</b>
                    Accuracy % <b>{{ round(($weaponStatistic['total_hits'][$weapon]/$weaponStatistic['total_fired'][$weapon]) * 100 , 2) }} %</b>
                </h5>
            </li>
            @php
        }
    }
        @endphp
    </ol>
  </div>
@endsection
