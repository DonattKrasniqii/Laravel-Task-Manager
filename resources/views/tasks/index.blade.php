<h1>Your Tasks</h1>
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
<a href="{{ route('tasks.create') }}">Create Task</a>
<ul>
    @foreach($tasks as $task)
        <li>
            <h2>{{ $task->title }} @if($task->status) (Completed) @endif</h2>
            <p>{{ $task->description }}</p>
            <p>Date Created: {{$task->created_at}}</p>
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
<form method="GET" action="{{ route('tasks.index') }}">
    <label>Status: 
        <select name="status">
            <option value="" {{ request('status') === null ? 'selected' : '' }}>All</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Completed</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Not Completed</option>
        </select>
    </label>
    <label>Priority:
        <select name="priority">
            <option value="" {{ request('priority') === null ? 'selected' : '' }}>All</option>
            <option value="1" {{ request('priority') === '1' ? 'selected' : '' }}>High</option>
            <option value="2" {{ request('priority') === '2' ? 'selected' : '' }}>Medium</option>
            <option value="3" {{ request('priority') === '3' ? 'selected' : '' }}>Low</option>
        </select>
    </label>
    <button type="submit">Filter</button>
</form>


