@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Anggota</h1>

    @include('admin.content.village_member._form', [
        'route' => route('anggota_desa.update', $member),
        'method' => 'PUT',
        'submit' => 'Update'
    ])
</div>
@endsection
