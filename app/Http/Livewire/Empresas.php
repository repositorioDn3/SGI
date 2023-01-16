<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Municipality;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithFileUploads;
class Empresas extends Component
{
    use WithFileUploads;
    public
        $nome,$nif,
        $logotipo,
        $nome_logo ,
        $province,
        $provincia,
        $regime,
        $detalhes_localizacao,
        $municipality,$municipio,
        $municipalities,
        $telefone_alternativo,
        $telefone,
        $email,
        $website,
        $province_id,
        $provincia_valor;

    public function edit(){
         $empresa = Empresa::find(1);

         if($empresa){
             $this->nome = $empresa->nome;
             $this->logotipo = $empresa->logotipo;
             $this->nif = $empresa->nif;
             $this->logotipo = $empresa->logotipo;
             $this->province = $empresa->provincia;
             $this->regime = $empresa->regime;
             $this->detalhes_localizacao = $empresa->detalhes_localizacao;
             $this->municipality = $empresa->municipio;
             $this->telefone = $empresa->telefone;
             $this->telefone_alternativo = $empresa->telefone_alternativo;
             $this->email = $empresa->email;
             $this->website = $empresa->website;
             $this->nome_logo = $empresa->logotipo;
         }
    }

    protected $rules = [
        'nome' => 'required',
        'nif' => 'required',
        'province' => 'required',
        'regime' => 'required',
        'detalhes_localizacao' => 'required',
        'municipality' => 'required',
        'telefone' => 'required',
        'email' => 'required|email',
    ];

    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }

      //filtrar municipios por provincia
      public function ShowMunicipality($province = null){

        if(isset($province)){
            $this->province_id = $province;
            $this->provincia_valor = Province::find($province);
            $this->municipalities = Municipality::where('province_id','=',$province)->get();

          return $this->municipalities;
        }
    }
    //filtrar municipios por provincia
    public function ShowProvince(){

            $provinces = Province::get();
            return $provinces;

    }
    public function save(){
        try {

            if(Empresa::get()->count() > 0 ){

                $empresa = Empresa::find(1);
                $this->validate($this->rules);

                if($this->logotipo){
                    if($this->logotipo === $empresa->logotipo){
                        $this->logotipo = $empresa->logotipo;
                    }else{

                        $extensao = $this->logotipo->getclientOriginalExtension();
                        $this->nome_logo = md5($this->logotipo->getclientOriginalName()).'.'.
                        $extensao;

                        $this->logotipo->storeAs('/public/logotipo/', $this->nome_logo );
                    }

                }else{

                    $this->logotipo = $empresa->logotipo;

                }

                $empresa->update([
                    'nome'=> $this->nome,
                    'nif'=> $this->nif,
                    'regime'=> $this->regime ?? '',
                    'provincia'=> $this->provincia_valor->name,
                    'municipio'=>$this->municipality,
                    'detalhes_localizacao'=>$this->detalhes_localizacao,
                    'telefone'=>$this->telefone,
                    'telefone_alternativo'=>$this->telefone_alternativo,
                    'email'=>$this->email,
                    'website'=>$this->website,
                    'logotipo'=> $this->nome_logo ,
                    'regime'=>$this->regime ,


                ]);

                if($empresa){
                    $this->dispatchBrowserEvent('success',[
                        'message'=>'Dados da empresa actualizados com sucesso'
                    ]);
                }else{
                    $this->dispatchBrowserEvent('error',[
                        'message'=>'Falha ao actualizar dados'
                    ]);
                }
            }else{

            $this->validate($this->rules);

            if($this->logotipo){
                $extensao = $this->logotipo->getclientOriginalExtension();
                $this->nome_logo  = md5($this->logotipo->getclientOriginalName()).'.'.
                $extensao;

                $this->logotipo->storeAs('/public/logotipo/',$this->nome_logo );
            }
            $empresa = Empresa::create([
                'nome'=> $this->nome,
                'nif'=> $this->nif,
                'provincia'=> $this->provincia_valor->name,
                'municipio'=>$this->municipality,
                'detalhes_localizacao'=>$this->detalhes_localizacao,
                'telefone'=>$this->telefone,
                'telefone_alternativo'=>$this->telefone_alternativo,
                'email'=>$this->email,
                'website'=>$this->website,
                'logotipo'=>$this->nome_logo ,
                'regime'=>$this->regime ,

            ]);

            if($empresa){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Dados adicionados com sucesso'
                ]);
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao adicionar dados'
                ]);
            }
            }

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);

        }
    }





    //buscar a provincia selecionada

    public function province(){
        $province = Province::find($this->province);
        $this->provincia = $province->name;
    }
    public function render()
    {
        return view('livewire.empresas',[
            'provinces'=>$this->ShowProvince(),
            'municipalities'=>$this->ShowMunicipality($this->province),
         ])->layout('modules.admin.app');

    }
}
