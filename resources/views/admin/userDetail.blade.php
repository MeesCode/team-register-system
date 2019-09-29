@extends('layouts.app')

@section('content')

	<div class="card mt-3">
		<div class="card-header">
			{{ $user->name }}
		</div>

		<div class="card-body p-0">
			<table class="table m-0">
				<tbody>
					<tr>
						<th>Email address</th>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<th>Phone number</th>
						<td>{{ $user->phone_number }}</td>
					</tr>
					<tr>
						<th>School name</th>
						<td>{{ $user->school_name }}</td>
					</tr>
					<tr>
						<th>School city</th>
						<td>{{ $user->school_place }}</td>
					</tr>
					<tr>
						<th>School adres</th>
						<td>{{ $user->school_address }}</td>
					</tr>
					<tr>
						<th>School postal code</th>
						<td>{{ $user->school_postal_code }}</td>
					</tr>
					<tr>
						<th>Registered at</th>
						<td>{{ $user->created_at }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<table class="table mt-3">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
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
	
@endsection
