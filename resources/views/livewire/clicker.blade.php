<div>
    @if(session()->has('message'))
        <div class="alert alert-success" id="alert-message">
            {{ session('message') }}
        </div>
    @endif
    <div class="bnt-primary"></div>
    <form wire:submit="createNewUser">
        <input wire:model="name" class="form-control m-4" name="name" placeholder="name" type="text">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        <input wire:model="email" class="form-control m-4" name="email" type="text" placeholder="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror
        <input wire:model="password" class="form-control m-4"  name="password" type="password" placeholder="password">
        @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
        <button class="btn btn-success m-4">Submit</button>
    </form>
    <hr>
    <div class="m-4">
            <h1>Users</h1>

            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach

           {{$users->withQueryString()->links()}}

    </div>
    <hr>

</div>
