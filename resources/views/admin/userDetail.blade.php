@extends('layouts.app')

@section('content')

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

	<table class="table">
		<tbody>
			<tr>
				<th>{{ __('custom.name') }}</th>
				<td>{{ $user->name }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.email') }}</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.phone_number') }}</th>
				<td>{{ $user->phone_number }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.school') }}</th>
				<td>{{ $user->school_name }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.place') }}</th>
				<td>{{ $user->school_place }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.address') }}</th>
				<td>{{ $user->school_address }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.postal_code') }}</th>
				<td>{{ $user->school_postal_code }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.registered_at') }}</th>
				<td>{{ $user->created_at }}</td>
			</tr>
		</tbody>
	</table>

	<table class="table">
		<thead class="thead-light">
			<tr>
				<th class="d-none d-sm-table-cell" scope="col">#</th>
				<th scope="col">{{ __('custom.name') }}</th>
				<th scope="col">{{ __('custom.category') }}</th>
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
