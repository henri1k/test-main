<?php

namespace Tests\Feature;

use App\Models\Tarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SystemTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_full_tarefa_crud() {
        //criar uma tarefa
        $tarefa = Tarefa::create([
            'titulo' => 'Nova Tarefa',
            'descricao' => 'Tarefa de teste',
            'concluida' => false
        ]);

        $this->assertDatabaseHas('Tarefas',[
            'titulo' => 'Nova Tarefa'
        ]);
        //assertDatabaseHas: esse método verifica
        //se há entrada especifica no banco de dados    

        //Read
        $tarefaRecuperada =  Tarefa::find($tarefa->id);
        $this->assertEquals('Nova Tarefa', $tarefaRecuperada->titulo);
        $this->assertEquals('Tarefa de teste', $tarefaRecuperada->descricao);

        $tarefaRecuperada->update(['titulo' => 'Tarefa Atualizada']);
        $this->assertEquals('Tarefa Atualizada', $tarefaRecuperada->titulo);

        $tarefaRecuperada->delete();
        $this->assertDatabaseMissing('tarefas',['id'=> $tarefaRecuperada->id]);
        //assertDatabaseMissing: metodo verifica se nao mais determinado
        //registro no banco
    }

}
