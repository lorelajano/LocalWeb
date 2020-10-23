@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row justify-content-center">

                <div class="card" >
                    <div class="card-header">{{ __('Lista e përdoruesve') }}</div>

                    <div class="card-body">

                            <table class="table w-auto">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Emri</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Datelindja</th>
                                    <th scope="col">Roli</th>
                                    <th scope="col">Statusi</th>
                                    <th scope="col">Karta ID</th>
                                    <th scope="col">Veprimet</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ date('d-m-Y', strtotime($user->birthday)) }}</td>
                                    <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>{{$user->statuses->name}}</td>

                                    <td><?php if (!empty($user->card)): ?><a href="users/{{ $user->card }}"><img src="{{URL::asset('images/icon-file.png')}}" alt="Image"/></a> <?php endif; ?></td>
                                    <td>
                                        @can('edit-users')
                                        <a href="{{route('admin.users.edit', $user->id)}}">
                                        <button type="button" class="btn btn-primary float-left">Ndrysho</button>
                                        </a>
                                        @endcan

                                        @can('delete-users')
                                        <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Fshi</button>
                                        </form>
                                        @endcan
                                          @if($user->statuses->name=="processing")

                                            <form action="{{route('admin.users.confirmed', $user)}}" method="PATCH" class="float-left">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <button type="submit" class="btn btn-success">
                                                    Aprovo
                                                </button>
                                            </form>

                                            @endif
                                    </td>
                                </tr>
                                @endforeach


                                </tbody>
                            </table>
                    </div>
                </div>

        </div>
    </div>
@endsection
