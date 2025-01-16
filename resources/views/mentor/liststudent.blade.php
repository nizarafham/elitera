@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pelajar di Kelas: {{ $class }}</h1>

    <a href="{{ route('mentor.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classStudents as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
