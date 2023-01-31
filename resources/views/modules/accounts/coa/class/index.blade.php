@extends('layouts.app')

@section('title')
    COA Class
@endsection

@section('body')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">COA Class <a href="{{route('acc.class.create')}}" class="btn btn-primary" style="margin-left: 84.8%">Add New</a></h4>
                                @if ($message = Session::get('destroy_message'))
                                    <p class="text-center text-danger">{{ $message }}</p>
                                @elseif( $message = Session::get('store_message'))
                                    <p class="text-center text-success">{{ $message }}</p>
                                @elseif( $message = Session::get('update_message'))
                                    <p class="text-center text-primary">{{ $message }}</p>
                                @endif
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width: 15%">Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $class)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$class->class_id}}</td>
                                        <td>{{$class->class_name}}</td>
                                        <td>{{$class->status}}</td>
                                        <td class="text-center">
                                            <form action="{{route('acc.class.destroy', ['id' => $class->id])}}" method="post">
                                            <a href="{{route('acc.class.edit',['id' => $class->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you confirm to delete?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
@endsection



