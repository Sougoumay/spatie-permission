@extends('layouts.admin-layout')
@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @can('publish articles')
                            <a type="button" href="{{route('articles.create')}}" class="btn btn-primary">Create Article</a>
                        @endcan
                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                @can('edit articles')
                                    <th scope="col">Edit</th>
                                @endcan
                                @can('delete articles')
                                    <th scope="col">Delete</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td><a href="{{route('articles.show',$article)}}">{{$article->title}}</a></td>
                                    <td>{{$article->description}}</td>
                                    @can('edit articles')
                                        <td><a class="btn btn-primary" type="button" href="{{route('articles.edit',$article)}}">Edit</a> </td>
                                    @endcan
                                    @can('edit articles')
                                        <td><a class="btn btn-danger" type="button" href="{{route('articles.delete',$article)}}">Delete</a></td>
                                    @endcan
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
