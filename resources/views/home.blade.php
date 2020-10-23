@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  Kjo eshte faqe qe mund te aksesohet nga te gjitha rolet:
                    <ul>
                        <li>admin</li>
                        <li>manager</li>
                        <li>user</li>
                    </ul>

                        Kjo eshte faqe qe mund te aksesohet nga roli user qe:
                        <ul>
                            <li>Ka moshe me te madhe ose te barabarte se 18.</li>
                            <li>Nese eshte nen moshen 18 , ai perdorues duhet te kete ngarkuar dokumentin ID dhe i eshte aprovuar nga admin/manager.</li>

                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
