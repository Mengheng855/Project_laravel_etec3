@extends('backend.master')
@section('content')

@section('site-title')
Admin | Add Logo
@endsection
@section('page-main-title')
Add Post
@endsection

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <!-- File input -->
            <form action="/admin/add-logo-submit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    @if (Session::has('message'))
                    <p class="text-danger text-center">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card-body">
                        <div class="mb-3 col-6">
                            <label for="formFile" class="form-label fs-5">AddLogo</label>
                           <input class="form-control" type="file" name="logo" id="image" />
                            

                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Add Logo">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection