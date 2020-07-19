@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New account</div>

                <div class="card-body">
                    <form method="POST" action="{{route('client.store')}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="client_name" class="form-control">
                            <label>Surname</label>
                            <input type="text" name="client_surname" class="form-control">
                            <label>IBAN</label>
                            <input type="text" name="account_number" class="form-control" value="{{$account->generateAccount()}}" readonly>
                            <input type="hidden" name="account_balance" class="form-control" value="0">
                            <label>ID</label>
                            <input type="number" name="client_id_no" class="form-control">
                        </div>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection