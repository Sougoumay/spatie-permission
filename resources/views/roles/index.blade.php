@extends('layouts.admin-layout')
@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <a type="button" href="{{route('super.admin.permissions.create')}}" class="btn btn-primary">Create Role</a>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Give Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$role->name}}</td>
                                    <td><a class="btn btn-primary" type="button" href="{{route('super.admin.roles.edit',$role)}}">Edit</a> </td>
                                    <td><a class="btn btn-danger" type="button" href="{{route('super.admin.destroy.role',$role)}}">Delete</a></td>
                                    <td><a type="button" class="btn btn-info" href="{{route('super.admin.roles.permissions',$role)}}">Give Permissions</a> </td>
                                </tr>
                                >
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
