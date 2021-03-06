@extends('front.layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Guest Book</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('front') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>First Name</label>
                <input required type="text" placeholder="First Name" class="form-control" name="first_name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input required type="text" placeholder="Last Name" class="form-control" name="last_name">
            </div>
            <div class="form-group">
                <label>Organization</label>
                <input required type="text" placeholder="Organization" class="form-control" name="organization">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input required type="text" placeholder="Addres" class="form-control" name="address">
            </div>
            <div class="form-group">
                <label>City</label>
                <select required name="city" class="form-control">
                    <option selected disabled>Choose . . .</option>
                    @foreach ($city as $item)
                    <option value="{{ $item['nama'] }}">{{ $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Province</label>
                <select required name="province" class="form-control">
                    <option selected disabled>Choose . . .</option>
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
