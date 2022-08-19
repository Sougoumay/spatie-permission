@extends('layouts.admin-layout')
@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Role</h5>

                        <!-- General Form Elements -->
                        <form action="{{route('super.admin.roles.give-permission',$role)}}" method="post">
                            @csrf
                            @if($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Permissions</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="give-permission[]" multiple aria-label="multiple select example">
                                        <option>Open this select menu</option>
                                        @foreach($permissions as $permission)

                                            <option value="{{$permission->name}}" @if($role->hasPermissionTo($permission)) selected="selected"@endif>{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
