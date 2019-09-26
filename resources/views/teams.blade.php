@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teams</div>

                <div class="card-body">
                    <p>Here you can see your currently added teams</p>
                    <a href="{{ route('addTeam') }}">
                        <button type="button" class="btn btn-primary">add new team</button>
                    </a>

                    @foreach ($teams as $team)
                    <div class="card mt-3">
                        <div class="card-header">
                            {{ $team->name }}
                        </div>

                        <div class="card-body p-0">
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $team->category }}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount of members</th>
                                        <td>{{ $team->members_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Age oldest member</th>
                                        <td>{{ $team->age_oldest_member }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td>{{ $team->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
