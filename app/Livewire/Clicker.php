<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule(['required', 'string', 'max:255'])]  // Define clear validation rules for name
    public $name = '';

    #[Rule(['required', 'email', 'unique:users,email'])]  // Separate rules for email
    public $email = '';

    #[Rule(['required', 'min:8'])]  // Minimum password length for example
    public $password = '';

    public function createNewUser()
    {
        // Trigger validation using the built-in method
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,  // Hash password for security
        ]);
        $this->reset();  // Clear the form fields

        // Flash message
        session()->flash('message', 'User created successfully.');
    }
    public function render()
    {
        $title = 'Users';
        $users = User::paginate(5);
        return view('livewire.clicker'
            , compact('title', 'users')
            );
    }
}
