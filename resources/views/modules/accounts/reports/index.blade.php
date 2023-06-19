@extends('layouts.app')

@section('title')
    @php($title='Select a report') {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{$title}} <small class="text-danger float-right">(field marked with * are mandatory)</small></h4>

            </div>
        </div>
    </div>
@endsection
