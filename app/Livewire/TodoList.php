<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|string|max:255|min:3')]
    public $title;

    public $search;
    public $todoId;

    #[Rule('required|string|max:255|min:3')]
    public $newTitle;

    public function create(){
        $validated=$this->validateOnly('title');
        Todo::create($validated);
        $this->reset('title');
        session()->flash('message', 'Created');
        $this->resetPage();
    }
    public function edit($id){
        $todo=Todo::where('id',$id)->first();
        $this->todoId=$todo->id;
        $this->newTitle=$todo->title;
    }
    public function update($id){
        $validated=$this->validateOnly('newTitle');
        $todo=Todo::where('id',$id)->first();
        $todo->title=$validated['newTitle'];
        $todo->save();
        $this->cancel();
    }
    public function cancel(){
        $this->reset(['todoId','newTitle']);
    }
    public function delete($id){
        try {
            Todo::findorFail($id)->delete();
        }
        catch (\Exception $e) {
            session()->flash('error', 'Something went wrong!');
            return;
        }
    }
    public function toggle($id){
        $todo=Todo::where('id',$id)->first();
        $todo->completed=!$todo->completed;
        $todo->save();
    }
    public function render()
    {
        $todos=Todo::latest()->where('title','like',"%{$this->search}%")->paginate(5);
        return view('livewire.todo-list',compact('todos'));
    }
}
