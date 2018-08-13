<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Trnsaction;

class Transaction extends Model
{
    //Definição dos campos que serão inseridos via Mass Assignment
    protected $fillable = ['employee_id','description','amount','user_id'];

    //Definição dos campos que não podem ser inseridos via usuário.
    protected $guarded  = ['id', 'created_at', 'update_at'];

    //Regras que devem ser atentidas para cada campo no cadastro e atualização de dados
    public $rules       = [
    					   'employee_id'   =>  'required',
    					   'amount'        =>  'required',
    					   'description'   =>  'required|min:10',
                          ];

    
    public $messages    = [
                           'employee_id.required' => 'O campo funcionário é obrigatório',
                           'amount.required'      => 'O campo valor é obrigatório',
                           //'amount.regex'         => 'O campo deve seguir o formato 1111.22',
                           'description.required' => 'O campo descrição é obrigatório',
                           'description.required' => 'O campo descrição, mínimo 10 caracteres',
                          ];
    
    /**
     * Pega o funcionário que realizou a transação
    */
    public function employee()
    {
        //return $this->BelongsTo('App\Models\Employee');
        return $this->BelongsTo(Employee::class);
    }
 
    //Retorna pesquisa de acordo com o filtro
    public function search(Array $data, $totalPages){
        
        return $this->where(function ($query) use ($data) {

             if(isset($data['funcionario']))
                $query->where('employee_id',$data['funcionario']);

             if(isset($data['descricao']))
                $query->where('description','LIKE',$data['descricao']);

        })->paginate($totalPages);       

    }
}