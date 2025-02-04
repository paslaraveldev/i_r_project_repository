@extends('layouts.adminconstant')


@section('content')
    <div class="container">
        <h1>Add New Borrow Type</h1>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="borrow_type_id">Borrow Type ID</label>
                <input type="text" class="form-control" id="borrow_type_id" name="borrow_type_id" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
