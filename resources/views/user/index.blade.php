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
                        <div class="file-upload-inner ts-forms">
                            <div class="input prepend-big-btn">
                                <label class="icon-right" for="prepend-big-btn">
                                    <i class="fa fa-download"></i>
                                </label>
                                <div class="file-button">
                                    Ngarko
                                    <input type="file" name="card" id="card"  onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                </div>
                                <input type="text" id="prepend-big-btn" placeholder="nuk është zgjedhur asnjë doc">
                            </div>
                        </div>

                            <button type="submit" class="btn btn-success">Ruaj</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
