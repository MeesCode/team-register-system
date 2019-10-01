@extends('layouts.app')

@section('content')

    <a href="{{ route('databaseDumpUsers') }}" target="_blank">
        <button type="button" class="btn btn-primary">Download database dump of the users</button>
    </a>

    <a href="{{ route('databaseDumpTeams') }}" target="_blank" class="mt-3">
        <button type="button" class="btn btn-primary">Download database dump of the teams</button>
    </a>

    <p class="mt-3">logs:</p>

    <iframe src="{{ route('logViewer') }}" width="100%" height="800px">Browser not compatible.</iframe>

@endsection
