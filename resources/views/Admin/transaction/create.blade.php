@extends('adminlte::page')

@section('title', 'Cadastro de Movimentação Financeira - Departamento')

@section('content_header')
    <h1>Cadastro de Movimentação Financeira - Departamento</h1>
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- Será utilizado para gerar o campo dinâmico de funcionário via ajax --}}
{!! Html::script('js/dropdown.js') !!}

@section('content')

   <!-- Exibe mensagem de erro ou sucesso na inserção -->
   @if (session('success'))
   		<div class="alert alert-success">
	        {{ session('success') }}
	    </div>
   @else
   	 	@if(session('error'))
		    <div class="alert alert-danger">
		        {{ session('error') }}
		    </div>
		@endif
   @endif  
    
	<!-- Exibe mensagem caso o usuário não preencha os dados corretamente-->     
    @if ( isset($errors) && ( count($errors) > 0 ) )
	    <div class="alert alert-danger" >
	        @foreach ($errors->all() as $error)
	        	<ul>
	        		<li> {{ $error }} </li>
	        	</ul>
	        @endforeach
	    </div>
    @endif 

	@if  ( isset( $transaction ) )	 	
	    	{!! Form::model($transaction, [ 'route' => ['employees.update', $transaction->id ] , 'class'=>'form','method' => 'put' ]) !!}
    @else    		
        	{!! Form::open(['route'=>'transactions.store', 'method'=>'post', $user->id ]) !!}      	
    @endif
	     
    <!-- Hiden com o id do usuário logado -->
    {!! Form::hidden('user_id', $user->id ) !!}

    <!-- Campo Departamento-->
	<!--<div class="form-group" > -->  
	    {{--  Form::label('department', 'Departamento') !!}
        {!! Form::select('department', $departments, null, ['placeholder'=>'Selecione','class' => 'form-control','id'=>'department'])--}}
    <!--</div>-->
    
    <!-- Campo Funcionário-->
	<div class="form-group" >    
	    {!! Form::label('employee', 'Funcionário') !!}
        {!! Form::select('employee_id', $employees, null, ['placeholder'=>'Selecione','class' => 'form-control','id'=>'employee'])!!}
    </div>

    <!-- Campo Funcionário-->
    <div class="form-group">		
        {!! Form::label('description', 'Descrição') !!}
		{!! Form::text('description', null, ['class' => 'form-control' ], array('required' => 'required'))!!}
	</div>

	<!-- Campo Funcionário-->
	<div class="form-group" >    
	    {!! Form::label('amount', 'Valor da Movimentação (Seguir o modelo -> 1234.12)') !!}
        {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => '00.00', 'pattern' => '\d+(\.\d{1,2})?']) !!}
    </div>

	<div class="form-group">
		    {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
	</div>

<!-- Fim do formulário->
{!! Form::close() !!}

@stop