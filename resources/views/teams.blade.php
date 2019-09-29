@extends('layouts.app')

@section('content')
    <p>Here you can see your currently added teams</p>
    <a href="{{ route('addTeam') }}">
        <button type="button" class="btn btn-primary">add new team</button>
    </a>

    <table class="table mt-3">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">School</th>
				<th scope="col">Category</th>
				<th scope="col">Member count</th>
				<th scope="col">Max age</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($teams as $team)
				<tr>
					<th scope="row">{{ $loop->index + 1 }}</th>
					<td>{{ $team->name }}</td>
					<td>{{ $team->school_name }}</td>
					<td>{{ $team->category }}</td>
					<td>{{ $team->members_amount }}</td>
					<td>{{ $team->age_oldest_member }}</td>
					<td>
						<form method="POST" action="{{ route('removeTeam') }}">
							@csrf
							<input type="hidden" name="id" value="{{ $team->id }}">
							<button type="submit" onclick="return confirm('are you sure you want to delete this team?')" class="btn btn-danger btn-sm">remove team</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
