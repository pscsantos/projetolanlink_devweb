<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    private $employee;
    
    //Injetando a classe Employee
    public function __construct( Employee $employee){
        $this->employee = $employee;
        $this->middleware('auth');
    }

    //Exibe tela de cadastro
    public function create()
    {
       //Recebe usuário logado
       $user        = auth()->user();

       //Consulta para gerar array com departamentos existentes.
       $departments = DB::table('departments')
                      ->pluck('name','id');

       return view('admin.employee.create')->with(compact('user','departments'));
    }

    //Efeteua a inserção 
    public function store(Request $request)
    {
        // Valida preenchimento dos campos.
        $this->validate($request, $this->employee->rules, $this->employee->messages );
        
        // Recebe retorno da inserção
        $insert = $this->employee->create($request->all());

        // Retorna mensagem para o usuário  
        if ($insert){
            return redirect()
                        ->route('employees.create')
                        ->with('success', 'Registro de funcionário inserido com sucesso!');
        }else{ 
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao inserir');

        }
    }

    public function getEmployees(Request $request, $id){ 

    dd('testes');     
        //Recebe requisição ajax
        if($request->ajax()){
            //Chama a função passando o id do
            $employees = Employee::employees($id);
            return response()->json($employees);

        }
    }
    
}
