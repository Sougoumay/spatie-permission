@extends('layouts.admin-layout')
@section('main')
    <p>Title : {{$article->title}}</p>
    <p>Description : {{$article->description}}</p>
    <p>Content : {{$article->content}}</p>
    <p>User Role : {{$article->user->role}}</p>
@endsection
