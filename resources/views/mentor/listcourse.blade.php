@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Mentor</h1>
    <h2>Daftar Kelas</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Jumlah Pelajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->student_count }}</td>
                    <td>
                        <a href="{{ route('mentor.students', ['classId' => $class->id]) }}" class="btn btn-primary">Lihat Pelajar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
