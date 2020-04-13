@extends('layouts.master')

@section('title', 'Converted Times')

@section('content')
    <h1>Available Times In Your Timezone</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Time</th>
            <th>TimeZone</th>
        </tr>
        </thead>
        <tbody>
        @foreach($times as $time)
            <tr>
                <td>{{ $time['time'] }}</td>
                <td>{{ $time['timezone'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/">View in original timezones</a>
@stop
