@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('createTeam') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Team name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

            <div class="col-md-6">
                <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autocomplete="category">
                    <option value="dancing">Dancing</option>
                    <option value="rescue_basic">Rescue basic</option>
                    <option value="rescue_advanced">Rescue advanced</option>
                    <option value="soccer">Soccer</option>
                </select>

                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="members_amount" class="col-md-4 col-form-label text-md-right">Amount of members</label>

            <div class="col-md-6">
                <input id="members_amount" type="number" max="4" min="1" class="form-control @error('members_amount') is-invalid @enderror" name="members_amount" value="{{ old('members_amount') }}" required autocomplete="members_amount">

                @error('members_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="age_oldest_member" class="col-md-4 col-form-label text-md-right">Age oldest team member</label>

            <div class="col-md-6">
                <input id="age_oldest_member" type="number" min="1" class="form-control @error('age_oldest_member') is-invalid @enderror" name="age_oldest_member" value="{{ old('age_oldest_member') }}" required autocomplete="age_oldest_member">

                @error('age_oldest_member')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Add team</button>
            </div>
        </div>
    </form>

@endsection
