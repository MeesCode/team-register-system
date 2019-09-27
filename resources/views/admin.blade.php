@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Admin overview</div>

				<div class="card-body">
					<p>Howdy admin, here are all teams</p>

					@foreach ($teams as $team)
					<div class="card mt-3">
						<div class="card-header">
							{{ $team->name }}
							<form method="POST" class="float-right" action="{{ route('removeTeamAdmin') }}">
									@csrf
									<input type="hidden" name="id" value="{{ $team->id }}">
									<button type="submit" class="btn btn-danger btn-sm">remove team</button>
							</form>
						</div>

						<div class="card-body p-0">
							<table class="table m-0">
								<tbody>
									<tr>
										<th>School</th>
										<td>{{ $team->school_name }}</td>
									</tr>
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

				<div class="card-body">
					<p>And here are all the users</p>

					@foreach ($users as $user)
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
					@endforeach

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
