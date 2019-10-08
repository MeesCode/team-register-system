@extends('layouts.app')

@section('content')

	<example-component></example-component>

	<p>Howdy admin, here are all teams</p>

	<table class="table">
		<thead class="thead-light">
			<tr>
				<th class="d-none d-sm-table-cell" scope="col">#</th>
				<th scope="col">{{ __('custom.name') }}</th>
				<th scope="col">School</th>
				<th class="d-none d-sm-table-cell" scope="col">{{ __('custom.category') }}</th>
				<th class="d-none d-sm-table-cell" scope="col">{{ __('custom.members_amount') }}</th>
				<th class="d-none d-sm-table-cell" scope="col">{{ __('custom.age_oldest_member') }}</th>
				<th scope="col">{{ __('custom.action') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($teams as $team)
				<tr>
					<th class="d-none d-sm-table-cell" scope="row">{{ $loop->index + 1 }}</th>
					<td>{{ $team->name }}</td>
					<td>{{ $team->school_name }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->category }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->members_amount }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->age_oldest_member }}</td>
					<td>
						<form method="POST" action="{{ route('removeTeamAdmin') }}">
							@csrf
							<input type="hidden" name="id" value="{{ $team->id }}">
							<button type="submit"  
							data-toggle="tooltip" 
							data-placement="top" 
							title="Remove this team" 
							onclick="return confirm('are you sure you want to delete this team?')" 
							class="btn btn-danger btn-sm"
							>
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
				<th class="d-none d-sm-table-cell" scope="col">#</th>
				<th scope="col">Name</th>
				<th class="d-none d-sm-table-cell" scope="col">Email</th>
				<th scope="col">School</th>
				<th scope="col">Details</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<th class="d-none d-sm-table-cell" scope="row">{{ $loop->index + 1 }}</th>
					<td>{{ $user->name }}</td>
					<td class="d-none d-sm-table-cell">{{ $user->email }}</td>
					<td>{{ $user->school_name }}</td>
					<td>
						<a href="{{ route('userDetail', [$user->id]) }}">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Go to detail page">
								<i class="fas fa-info-circle"></i>
							</button>
						</a>
						<a href="{{ route('addTeamAdmin', [$user->id]) }}">
							<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Add a team">
								<i class="fas fa-user-plus"></i>
							</button>
						</a>
						<form method="POST" action="{{ route('deleteUser') }}" class="d-inline">
							@csrf
							<input type="hidden" name="id" value="{{ $user->id }}">
							<button type="submit"  
							data-toggle="tooltip" 
							data-placement="top" 
							title="Remove this user" 
							onclick="return confirm('are you sure you want to delete this user and all their teams?')" 
							class="btn btn-danger btn-sm"
							>
								<i class="fas fa-trash-alt"></i>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
