@extends('layouts.dashboard')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit Mentor</li>
        </ol>
        <a class="btn btn-link mb-2" href="{{URL::previous()}}">
            <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
        </a>
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
        {{-- @dd($item) --}}
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{route('mentors.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{old('name') ?? $item->name}}" class="form-control">
                            </div>
                           <div class="form-group">
                                <label>Motivation</label>
                                <input type="text" name="motivation" value="{{old('motivation') ?? $item->motivation}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                <div class="styled-select">
                                <select name="course_categories_id">
                                    <option value="{{$item->course_categories_id}}">{{$item->courses->name}}</option>
                                    @foreach ($course as $courses)
                                        <option value="{{$courses->id}}">{{$courses->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control">
                                {{-- <small class="form-text mb-3 text-danger">Please input image in size 400X800</small> --}}
                            </div>
                        </div>
                    </div>
                   <p><button type="submit" class="btn btn-primary plus float-right">Save</button></p>
                </form>
            </div>
            <!-- /tables-->
        </div>
    </div>

    @endsection