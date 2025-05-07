@extends('admin.layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h1>Edit Village Contact</h1>
    <form action="{{ route('kontak.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $kontak->instagram) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $kontak->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_telepon" class="form-label">No telp</label>
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $kontak->no_telepon) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $kontak->facebook) }}" required>    
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection