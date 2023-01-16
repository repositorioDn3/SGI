<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $search,
    $nome,
    $descricao,
    $id_categoria;
    //metodo para limpar os campos
    public function resetInputs(){
        $this->search = '';
        $this->nome = '';
        $this->descricao = '';
        $this->id_categoria = '';
    }
    //Validacoa de campos
    protected $rules = ['nome'=>'required|min:3'];
    //Validacao a tempo real
    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }
    //Metodo para salvar dados no banco
    public function save(){
        try{

            $this->validate($this->rules);

            $categoriaAdded = new Categoria();
            $categoriaAdded->nome = $this->nome;
            $categoriaAdded->descricao = $this->descricao;
            $categoriaAdded->save();


            if($categoriaAdded){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Categoria adicionada com sucesso.'
                ]);
            }else{
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Falha ao adicionar categoria.'
                ]);
            }

            $this->resetInputs();
        }catch(\Exception $ex) {
            $this->dispatchBrowserEvent('serverError',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);
        }
    }
    //metodo para editar dados
    public function edit($id){
        $categoria = Categoria::find($id);
        $this->nome = $categoria->nome;
        $this->descricao = $categoria->descricao;
        $this->id_categoria = $categoria->id;
    
    }
    //metodo para actualizar dados
    public function update(){
        try {


             $categoriaUpdated =  Categoria::find($this->id_categoria);
             $categoriaUpdated->nome = $this->nome;
             $categoriaUpdated->descricao = $this->descricao;
             $categoriaUpdated->save();
 
 
             if($categoriaUpdated){

                 $this->dispatchBrowserEvent('close-modal');

                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Categoria actualizada com sucesso.'
                 ]);


             }else{

                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Falha ao actualizar categoria.'
                 ]);
                 
             }
 
             $this->resetInputs();
         }catch(\Exception $ex) {
             $this->dispatchBrowserEvent('serverError',[
                 'message'=>'Falha no servidor: '.$ex->getMessage()
             ]);
         }
    }
    //Metodo para excuir dados
    public function delete($id){
        try {
             $categoriaFinded = Categoria::find($id);
             $categoriaFinded->esta_desponivel = 'nao';
             $categoriaFinded->save();
            
 
 
             if($categoriaFinded){
                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Categoria excluida com sucesso.'
                 ]);
             }else{
                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Falha ao excluir categoria.'
                 ]);
             }
 
             $this->resetInputs();
         }catch(\Exception $ex) {
             $this->dispatchBrowserEvent('serverError',[
                 'message'=>'Falha no servidor: '.$ex->getMessage()
             ]);
         }
    }

    //Metodo para mostrar dados 
    public function show($search = null){
        if(isset($search)){
            $allCategorias = Categoria::where('nome','like','%'.$search.'%')
                                        ->where('esta_desponivel','<>','nao')->paginate(5);
            return $allCategorias;

        }else{

            $allCategorias = Categoria::
                        where('esta_desponivel','<>','nao')->paginate(5);
            return $allCategorias;
        }
    }
    //Metodo principal do componente
    public function render()
    {
        return view('livewire.categorias',[
            'categorias'=>$this->show($this->search)
        ])
        ->layout('modules.admin.app');
    }
}
