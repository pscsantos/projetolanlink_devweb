<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Employee;
use App\Models\Department;

class TransactionController extends Controller
{
    private $totalPages = 2;
    private $transaction;  
   
    //Injetando a classe Employee
    public function __construct( Transaction $transaction){

        $this->transaction = $transaction;
        $this->middleware('auth');
    
    }
    //Display histórico
    public function index()
    {
        // Irá retorna a tela de filtro e grid.
        $transactions = $this->transaction
                            ->paginate($this->totalPages);
        
        $employees    = Employee::pluck('name','id');
        
        return view ('admin.transaction.index',compact('transactions','employees'));
    }

    
    //Pesquisa movimentação
    public function search( Request $request , Transaction $transaction){
       
        $dataForm      = $request->all();

        $transactions   = $transaction->search($dataForm, $this->totalPages);

        //Consulta para gerar array com departamentos existentes.
        $employees = DB::table('employees')
                       ->pluck('name','id');

        return view ('admin.transaction.index',compact('transactions','employees'));
       
    }

    //Exibição do form de inserção 
    public function create()
    {
       //Recebe usuário logado
       $user      = auth()->user();

       $departments = Department::all()
                              ->pluck('name','id');

       //Consulta para gerar array com departamentos existentes.
       $employees = DB::table('employees')
                      ->pluck('name','id');

       return view('admin.transaction.create')->with(compact('user','employees', 'departments'));
    }

    //Inserção de dados
    public function store(Request $request)
    {
        // Valida preenchimento dos campos.
        $this->validate($request, $this->transaction->rules);
        
        // Recebe retorno da inserção
        $insert = $this->transaction->create($request->all());

        // Retorna mensagem para o usuário  
        if ($insert){
            return redirect()
                        ->route('transactions.create')
                        ->with('success', 'Movimentação inserida com sucesso!');
        }else{ 
            // Redireciona de volta com uma mensagem de erro
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao inserir');

        }
    }
    
}
