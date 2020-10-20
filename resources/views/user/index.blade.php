@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ngarko Karten e Identitetit') }}</div>

                    <div class="card-body">
                        <div class="file-upload-inner ts-forms">
                            <div class="input prepend-big-btn">
                                <label class="icon-right" for="prepend-big-btn">
                                    <i class="fa fa-download"></i>
                                </label>
                                <div class="file-button">
                                    Ngarko
                                    <input type="file" name="doc" id="doc" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                </div>
                                <input type="text" id="prepend-big-btn" placeholder="nuk është zgjedhur asnjë doc">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
