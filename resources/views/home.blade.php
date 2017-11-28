@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in member!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/add"><button class="btn btn-success">New Wisata</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Name</td>
                    <td>Lokasi</td>
                    <td>File</td>
                    <td></td>
                    </thead>
                    <tbody>
                    @foreach ($wisatas as $wisata)
                        <tr>
                            <td>{{$wisata->name}}</td>
                            <td>{{$wisata->lokasi}}$</td>
                            <td>{{$wisata->file_name}}</td>
                            <td><a href="/destroy/{{$wisata->id}}"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
