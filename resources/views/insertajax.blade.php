@extends('adminlte::page')

@section('title', 'Cadastro de Departamento')

@section('content_header')
    <h1>Cadastro de Departamento</h1>
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

   
    {!! Form::open(['method'=>'POST', $user->id ]) !!}      		     

    {!! Form::hidden('user_id', $user->id ) !!}

    <div class="form-group">		
        {!! Form::label('name', 'Nome:') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'id'=>'name' ], array('required' => 'required'))!!}
	</div>

	<div class="form-group">
		    {!! Form::submit('Salvar', ['class' => 'btn btn-success', 'id' => 'salvar']) !!}
	</div>



<!-- Fim do formulário-->
{!! Form::close() !!}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">

	$('#salvar').click( function(){

		var name  = $("#name").val();
        var token = $("input[type=hidden][name=_token]").val();

        $.ajax({
					type:'POST',
					url: 'createajax',
					data: { name: name , 
						    _token: token }
					,
        success: function() {
            alert('Deu certo!');
        },
        error: function() {
            self.html(result.statusText + result.responseText);
        }
	})
  })
</script>

@stop