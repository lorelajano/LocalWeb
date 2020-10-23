@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ngarko Karten e Identitetit</div>

                    <div class="card-body">
                        <form action="{{ url('/user/permission/'.$user->id) }}" enctype="multipart/form-data" method="POST">

                            @csrf
                            {{ method_field('PUT') }}

                                <div class="file-button">

                                    <input type="file" name="card" id="card" required >
                                </div>

                        <button type="submit" class="btn btn-success">Ruaj</button>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
