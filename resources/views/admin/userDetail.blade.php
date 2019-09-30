@extends('layouts.app')

@section('content')

	<p>Here is the general information of of this school's coach</p>

	<a href="{{ route('addTeamAdmin', [$user->id]) }}">
        <button type="button" class="btn btn-primary">add new team</button>
    </a>

	<form method="POST" action="{{ route('deleteUser') }}" class="mt-3 mb-3">
		@csrf
		<input type="hidden" name="id" value="{{ $user->id }}">
		<button type="submit"  
		onclick="return confirm('are you sure you want to delete this user and all their teams?')" 
		class="btn btn-danger"
		>
			remove this user
		</button>
	</form>

	<div class="card">
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

	<p class="mt-3 mb-3">And the teams that they entered</p>

	<table class="table">
		<thead class="thead-light">
			<tr>
				<th class="d-none d-sm-table-cell" scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Category</th>
				<th class="d-none d-sm-table-cell" scope="col">Member count</th>
				<th class="d-none d-sm-table-cell" scope="col">Max age</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($teams as $team)
				<tr>
					<th class="d-none d-sm-table-cell" scope="row">{{ $loop->index + 1 }}</th>
					<td>{{ $team->name }}</td>
					<td>{{ $team->category }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->members_amount }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->age_oldest_member }}</td>
					<td>
						<form method="POST" action="{{ route('removeTeamAdmin') }}">
							@csrf
							<input type="hidden" name="id" value="{{ $team->id }}">
							<button type="submit" data-toggle="tooltip" data-placement="top" title="Remove this team" onclick="return confirm('are you sure you want to delete this team?')" class="btn btn-danger btn-sm">
								<i class="fas fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection
