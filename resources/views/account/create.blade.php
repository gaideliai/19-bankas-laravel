@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nauja sąskaita</div>

                <div class="card-body">
                    <form method="POST" action="{{route('account.store')}}">
                        <div class="form-group">
                            <label>Vardas</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            <label>Pavardė</label>
                            <input type="text" name="surname" value="{{old('surname')}}" class="form-control">
                            <label>IBAN</label>
                            <input type="text" name="account" class="form-control" value="{{$account->generateAccount()}}" readonly>
                            <input type="hidden" name="balance" class="form-control" value="0">
                            <label>Asmens kodas</label>
                            <input type="number" name="id_no" value="{{old('id_no')}}" class="form-control">
                        </div>
                        @csrf
                        <button class="btn btn-primary" type="submit">Pridėti</button>
                        <a class="btn btn-secondary" href="{{route('account.create')}}">Išvalyti</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection