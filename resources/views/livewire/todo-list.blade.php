<div>

    @if(session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @include('livewire.includes.create-todo-box')
    @include('livewire.includes.search-box')
    <div id="todos-list">
        @foreach($todos as $todo)
            @include('livewire.includes.todo-card')
        @endforeach
        <div class="my-2">
            {{$todos->withQueryString()->links()}}
        </div>
    </div>
</div>
