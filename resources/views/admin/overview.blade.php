@extends('layouts.app')

@section('content')

    <a href="{{ route('databaseDumpUsers') }}" target="_blank">
        <button type="button" class="btn btn-primary">Download database dump of the users</button>
    </a>

    <a href="{{ route('databaseDumpTeams') }}" target="_blank" class="mt-3">
        <button type="button" class="btn btn-primary">Download database dump of the teams</button>
    </a>

@endsection
