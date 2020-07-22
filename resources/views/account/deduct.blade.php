@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuskaityti lėšas</div>

                <div class="card-body">
                    <form method="POST" action="{{route('account.deductFunds',[$account])}}">
                        <div class="form-group">
                            
                            <div>{{$account->name}} {{$account->surname}} <br> {{$account->id_no}} <br> {{$account->formatIban($account->account)}} <br> {{$account->balance}} Eur</div>
                            <input class="w-25" type="number" step="0.01" name="balance" class="form-control">
                            
                        </div>
                            
                        @csrf
                        <button class="btn btn-primary" type="submit">Nuskaityti lėšas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection