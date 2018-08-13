@extends('adminlte::page')

@section('title', 'Cadastro de Departamento')
	

@section('content_header')
    <h1>Cadastro de Departamento</h1>
@stop

@section('content')

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>

    <script type="text/javascript">

       $(document).ready(function (){
        	$("#form_department").validate({
		       rules : {
		            name:{
		                required:true,
		                minlength:3
		             }
		        },
		        messages:{
		            name:{
		                required:" Campo obrigatório",
		                minlength:"O campo deve possuir pelo menos 3 caracteres"
             	    }
                }
        	});
        });
	</script>

    <!-- Exibe mensagem de erro ou sucesso na inserção no banco de dados -->
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
	
    {!! Form::open(['route'=>'departments.store', 'method'=>'POST', 'id' => 'form_department', $user->id ]) !!}    	
   
	    {!! Form::hidden('user_id', $user->id ) !!}

	    <div class="form-group">		
	        {!! Form::label('name', 'Nome:') !!}
			{!! Form::text('name', null, ['class' => 'form-control' ,'id'=>'name'], array('required' => 'required'))!!}
		</div>

		<div class="form-group">
			    {!! Form::submit('Salvar', ['class' => 'btn btn-success btn-submit']) !!}
		</div>

	<!-- Fim do formulário-->
	{!! Form::close() !!}

@stop