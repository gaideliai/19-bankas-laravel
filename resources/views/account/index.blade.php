@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sąskaitų sąrašas</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>                                
                                    <th scope="col">Vardas</th>
                                    <th scope="col">Pavardė</th>
                                    <th scope="col">Asmens kodas</th>
                                    <th scope="col">Sąskaitos numeris</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                @foreach ($accounts as $account)
                                    <tr>    
                                        <td> {{$account->name}} </td>
                                        <td> {{$account->surname}} </td>
                                        <td> {{$account->id_no}} </td>
                                        <td> {{$account->formatIban($account->account)}} </td>
                                    </tr>    
                                        
                                    <tr>
                                        <td colspan="4">
                                        <form method="POST" action="{{route('account.destroy', [$account])}}">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Ištrinti</button>
                                            <a class="btn btn-primary mx-3" href="{{route('account.add', [$account])}}">Pridėti lėšų</a>
                                            <a class="btn btn-primary" href="{{route('account.deduct', [$account])}}">Nuskaičiuoti lėšas</a>                            
                                        </form>
                                        
                                        </td>
                                    </tr>                        
                                @endforeach                 
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection