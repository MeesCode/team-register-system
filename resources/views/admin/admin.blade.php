@extends('layouts.app')

@section('content')

	<p>Howdy admin, here are all teams</p>

	<table class="table">
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
						<form method="POST" action="{{ route('removeTeamAdmin') }}">
							@csrf
							<input type="hidden" name="id" value="{{ $team->id }}">
							<button type="submit" onclick="return confirm('are you sure you want to delete this team?')" class="btn btn-danger btn-sm">
								<i class="fas fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	

	<p>And here are all the users</p>


	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">School</th>
				<th scope="col">Details</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<th scope="row">{{ $loop->index + 1 }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->school_name }}</td>
					<td>
						<a href="{{ route('userDetail', [$user->id]) }}">
							<button type="button" class="btn btn-primary btn-sm">
								<i class="fas fa-info-circle"></i>
							</button>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
