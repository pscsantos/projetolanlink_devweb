@extends('adminlte::page')

@section('title', 'Histórico de Movimentação')

@section('content_header')
    <h1>Histórico de Movimentações</h1>
@stop

@section('content')
{{-- dd($transactions) --}}
    <div class="box">

    	<div class="box-header">

    		<form action="{{ route('admin.transaction.search') }}" method="POST" class = "form form-inline">
    			{!! csrf_field() !!}
                <select name ="funcionario" placeholder="Funcionário" class="form-control"> 
                	     <option  value="">-- Selecione o Funcionário --</option>
                		 @forelse ($employees as $id =>$name)
                		 <option  value="{{ $id }}">{{ $name }}</option>            	
						 @empty
						 @endforelse
                </select> 		    
    			<input type="text" name="descricao"   class="form-control" placeholder="Descrição" size="50">
    			<button type="submit" class="btn btn-primary">Pesquisar</button>
    		</form>
    		
    	</div>

		    <div class="box-body">    
			    <table class = "table table-bordered table-hover" >
			    	<thead>
			    		<tr>
			    			<th>Código</th>
			    			<th>Descrição</th>
			    			<th>Valor</th>
			    			<th>data da Transação</th>>
			    			<th>Funcionário</th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		@forelse( $transactions as $transaction)
			    		<tr>
				    		<td>{{ $transaction->id }}</td>
				    	    <td>{{ $transaction->description }}</td>
				    	    <td>{{ number_format($transaction->amount,'2', ',', '.') }}</td>
				    	    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y') }}</td>
				    	    <td>{{ $transaction->employee->name }}</td>
				    	</tr>
				    	@empty
				    	@endforelse
			    	</tbody>

			    </table>

			    <!-- Paginação -->
                {!! $transactions->links() !!}
			</div>
	</div>

@stop