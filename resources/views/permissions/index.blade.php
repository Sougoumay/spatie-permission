@extends('layouts.admin-layout')
@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <a type="button" href="{{route('super.admin.permissions.create')}}" class="btn btn-primary">Create Permission</a>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Async Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$permission->name}}</td>
                                    <td><a class="btn btn-primary" type="button" href="{{route('super.admin.permissions.edit',$permission)}}">Edit</a> </td>
                                    <td><a class="btn btn-danger" type="button" href="{{route('super.admin.destroy.permission',$permission)}}">Delete</a></td>
                                    <td><a type="button" class="btn btn-info" href="{{route('super.admin.permissions.role',$permission)}}">Async Role</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
