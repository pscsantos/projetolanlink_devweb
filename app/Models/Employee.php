<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //Definição dos campos que serão inseridos via Mass Assignment
    protected $fillable = ['name','user_id','department_id'];

    //Definição dos campos que não podem ser inseridos via usuário.
    protected $guarded  = ['id', 'created_at', 'update_at'];

    //Regras de validação de campos do formulário
    public $rules       = [
              					   'name'              => 'required|min:10|max:200',
              					   'department_id'     => 'required',
                          ];

    public $messages    = [
                           'name.required'           => 'O campo nome é obrigatório',
                           'name.min'                => 'Preencha o campo com no mínimo 10 carateres',
                           'name.max'                => 'O campo aceita no máximo 200 caracteres',
                           'department_id.required'  => 'Campo departamento é obrigatório',
                          ];

    //Seráutilizado para gerar o select de funcionários via ajax
    public static function employees($id){
        return Employee::where('department_id','=',$id)
             ->OrderByRaw('name')
             ->get();
    }

    /**
     * Pega o departamento ao qual o funcionário pertence.
     */
    public function department()
    {
        return $this->BelongsTo(Department::class);
    }

    /**
     * Pega as movimentações realizadas pelo funcionário
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

}
