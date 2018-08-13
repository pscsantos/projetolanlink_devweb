@extends('adminlte::page')

@section('title', 'Cadastro de Funcionário')

@section('content_header')
    <h1>Cadastro de Funcionário</h1>
@stop

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

	@if  ( isset( $employee ) )	 	
	    	{!! Form::model($employee, [ 'route' => ['employees.update', $employee->id ] , 'class'=>'form','method' => 'put' ]) !!}
    @else    		
        	{!! Form::open(['route'=>'employees.store', 'method'=>'post', $user->id ]) !!}      	
    @endif
	     

    {!! Form::hidden('user_id', $user->id ) !!}

    <div class="form-group">		
        {!! Form::label('name', 'Nome') !!}
		{!! Form::text('name', null, ['class' => 'form-control' ], array('required' => 'required'))!!}
	</div>
	<div class="form-group" >    
	    {!! Form::label('department', 'Departamento') !!}
        {!! Form::select('department_id', $departments, null, ['placeholder'=>'Selecione','class' => 'form-control','id'=>'department'])!!}
    </div>

	<div class="form-group">
		    {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
	</div>

<!-- Fim do formulário->
{!! Form::close() !!}

@stop