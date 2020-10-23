@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ndryshim të drejtash për: {{$user->name}} </div>

                    <div class="card-body">
                        <form action="{{route('admin.users.update', $user)}}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}

                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    @if($user->roles->pluck('id')->contains($role->id)) checked
@endif>
                                    <label>{{ $role->name}}</label>
                                </div>
                            @endforeach
                    <button type="submit" class="btn btn-success">
                            Ruaj
                    </button>
                            <a href="{{route('admin.users.index')}}">
                            <button type="submit" class="btn btn-primary">
                                Kthehu
                            </button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
