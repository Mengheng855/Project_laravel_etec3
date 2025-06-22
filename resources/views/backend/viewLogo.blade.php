@extends('backend.master')

@section('site-title', 'Admin | View Logo')
@section('page-main-title', 'Latest Logo')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Uploaded Logo</h5>
            </div>

            <div class="card-body">
                @if (!$logo)
                    <p>No logo uploaded yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Logo Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $logo->id }}</td>
                                <td>
                                    <img src="{{ asset($logo->logo) }}" alt="Logo" style="max-height: 70px;">
                                </td>
                                <td>
                                    <form action="{{ route('deleteLogo') }}" method="POST" onsubmit="return confirm('Are you sure to delete?');" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $logo->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
