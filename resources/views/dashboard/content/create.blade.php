@extends('layouts.dashboard')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tambah Materi</li>
        </ol>

        @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="alert alert-danger" role="alert">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $eror)
                                        <li>{{$eror}}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i></i> Tambah Materi Baru
            </div>
            <div class="card-body">
                <form action="/dashboard/content/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="chapters_id" value="{{ $id }}"> <br />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Materi</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                        <div class="col-md-14">
                            <div class="form-group">
                            <label>Text</label>
                            <textarea class="editor" name="text"></textarea>
                            </div>
                        </div>
                        <p><button type="submit" class="btn btn-primary plus float-right">Save</button></p>
                    </form>
            </div>
            
            <!-- /tables-->
        </div>
    </div>

    @endsection