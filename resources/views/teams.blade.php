@extends('layouts.app')

@section('content')
    <p>{{ __('custom.my_teams_1') }}</p>

    <a href="{{ route('addTeam') }}">
        <button type="button" class="btn btn-primary">{{ __('custom.add_team') }}</button>
    </a>

    <table class="table mt-3">
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
					<td>{{ __('custom.'.$team->category) }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->members_amount }}</td>
					<td class="d-none d-sm-table-cell">{{ $team->age_oldest_member }}</td>
					<td>
						<form method="POST" action="{{ route('removeTeam') }}">
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
