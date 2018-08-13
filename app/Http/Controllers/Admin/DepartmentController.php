<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\User;
use Validator;

class DepartmentController extends Controller
{
    private $totalPages = 5;

    private $department;
    
    //Injetando a classe Department
    public function __construct( Department $department){
        $this->department = $department;
        $this->middleware('auth');
    }

    // Redireciona para a tela de cadastro
    public function create()
    {

       $title = "Cadastro de Departamentos";

       $user = auth()->user();

       return view('admin.department.create')->with(compact('title','user'));
    }

    //Recebe dados da tela de cadastro e insere no banco de dados.
    public function store(Request $request)
    {
         // Valida preenchimento dos campos.
        $this->validate($request, $this->department->rules, $this->department->messages);
        
        // Recebe retorno da inserção
        $insert = $this->department->create($request->all());

        // Retorna mensagem para o usuário  
        if ($insert){
            return redirect()
                        ->route('departments.create')
                        ->with('success', 'Departamento inserido com sucesso!');
        }else{ 
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao inserir');

        }
    }
    
}
