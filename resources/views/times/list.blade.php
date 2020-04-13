@extends('layouts.master')

@section('title', 'Available Times')

@section('content')
    <h1>Available Times</h1>
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
    <a href="/converted">Convert all times to your timezone</a>
@stop
