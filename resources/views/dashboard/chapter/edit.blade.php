@extends('layouts.dashboard')

@section('content')


<div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Log Book</li>
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

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Update Chapter</h2>
        </div>

    {{-- @dd($id); --}}
    @foreach ($data as $data)
        <form action="/dashboard/chapter/update" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_categories_id" value="{{$data->course_categories_id}}"> <br />
            <input type="hidden" name="id" value="{{$data->id}}"> <br />
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Chapter Name</label>
                        <input type="text" name="name" value="{{$data->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea type="text" class="form-control" name="abstract">{{$data->abstract}}</textarea>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <!-- /row-->
                <p><button type="submit" class="btn btn-primary plus float-right">Save</button></p>
            </form>
    @endforeach
    </div>	
    </div>
<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fa fa-angle-up"></i>
</a>


@endsection