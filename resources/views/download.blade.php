@extends('layouts.app')
@section('content')
<aside id="aside-menu">
</aside>
<div id="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>รายงาน</h1>
            <div class="card">
                <div class="card-header">รายงาน</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
