@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('deleteProfile') }}" class="mt-3 mb-3">
		@csrf
		<button type="submit"  
		onclick="return confirm('are you sure you want to delete your account and all your teams?')" 
		class="btn btn-danger"
		>
			{{ __('custom.profile_button_1') }}
		</button>
	</form>

    <table class="table mt-3">
        <tbody>
            <tr>
				<th>{{ __('custom.name') }}</th>
				<td>{{ auth::user()->name }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.email') }}</th>
				<td>{{ auth::user()->email }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.phone_number') }}</th>
				<td>{{ auth::user()->phone_number }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.school') }}</th>
				<td>{{ auth::user()->school_name }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.place') }}</th>
				<td>{{ auth::user()->school_place }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.address') }}</th>
				<td>{{ auth::user()->school_address }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.postal_code') }}</th>
				<td>{{ auth::user()->school_postal_code }}</td>
			</tr>
			<tr>
				<th>{{ __('custom.registered_at') }}</th>
				<td>{{ auth::user()->created_at }}</td>
			</tr>
        </tbody>
    </table>

@endsection
