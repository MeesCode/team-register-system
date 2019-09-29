@extends('layouts.app')

@section('content')

    <table class="table mt-3">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ auth::user()->name }}</td>
            </tr>
            <tr>
                <th>Email adres</th>
                <td>{{ auth::user()->email }}</td>
            </tr>
            <tr>
                <th>Phone number</th>
                <td>{{ auth::user()->phone_number }}</td>
            </tr>
            <tr>
                <th>School name</th>
                <td>{{ auth::user()->school_name }}</td>
            </tr>
            <tr>
                <th>School city</th>
                <td>{{ auth::user()->school_place }}</td>
            </tr>
            <tr>
                <th>School adres</th>
                <td>{{ auth::user()->school_address }}</td>
            </tr>
            <tr>
                <th>School postal code</th>
                <td>{{ auth::user()->school_postal_code }}</td>
            </tr>
        </tbody>
    </table>

@endsection
