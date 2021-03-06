@extends('home')
@section('content')
<div class="col-md-12 mt-5">
    <a class="btn btn-success" href="{{ url('list/create') }}">Tambah</a>
    <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Organization</th>
                    <th>Address</th>
                    <th>Province</th>
                    <th>City</th>
                    <th></th>
                </tr>
            </thead>
            @foreach ($data as $index => $item)
            <tbody>
                <td>{{ ++$index }}</td>
                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                <td>{{ $item->organization }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td>{{ $item->tipe }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <form action="{{ url('list') }}/{{ $item->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-primary" href="{{ url('list') }}/{{ $item->id }}/edit">Edit</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
