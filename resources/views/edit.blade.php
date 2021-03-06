@extends('home')
@section('content')
<div class="col-md-12 mt-5">
    <div class="card">
        <form action="{{ url('list') }}/{{ $data->id }}" method="post">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <div class="form-group">
                <label>First Name</label>
                <input value="{{ $data->first_name }}" required type="text" placeholder="First Name"
                    class="form-control" name="first_name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input value="{{ $data->last_name }}" required type="text" placeholder="Last Name" class="form-control"
                    name="last_name">
            </div>
            <div class="form-group">
                <label>Organization</label>
                <input value="{{ $data->organization }}" required type="text" placeholder="Organization"
                    class="form-control" name="organization">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input value="{{ $data->address }}" required type="text" placeholder="Address" class="form-control"
                    name="address">
            </div>
            <div class="form-group">
                <label>City</label>
                <select required name="city" class="form-control">
                    <option value="{{ $data->city }}" selected>{{ $data->city }}</option>
                    @foreach ($city as $item)
                    <option value="{{ $item['nama'] }}">{{ $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Province</label>
                <select required name="province" class="form-control">
                    <option value="{{ $data->province }}" selected>{{ $data->province }}</option>
                    @foreach ($province as $item)
                    <option value="{{ $item['nama'] }}">{{ $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <button style="margin:10px;" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
