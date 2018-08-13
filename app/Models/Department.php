<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //Definição dos campos que serão inseridos via Mass Assignment
    protected $fillable = ['name','user_id'];

    //Definição dos campos que não podem ser inseridos via usuário.
    protected $guarded  = ['id', 'created_at', 'update_at'];

    //Regras que devem ser atentidas para cada campo no cadastro e atualização de dados
    public $rules       = [
    					             'name' =>'required|min:3|max:100'
                          ];

    public $messages    = [
                           'name.required' => 'O campo nome é obrigatório',
                           'name.min'      => 'Preencha o campo com no mínimo 3 carateres',
                           'name.max'      => 'O campo aceita no máximo 100 caracteres'
                          ];
  
     /**
     * Pega os funcionários do departamento
     */
    public function employees()
    {
        return $this->hasMany('App\Models\employee');
    }
}
