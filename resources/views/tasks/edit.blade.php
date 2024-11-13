<h1>Edit Task</h1>
<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')
    <label>Title: <input type="text" name="title" value="{{ $task->title }}"></label>
    <label>Description: <textarea name="description">{{ $task->description }}</textarea></label>
    <label>Status: 
    <input type="checkbox" name="status" value="1" {{ $task->status ? 'checked' : '' }}>
</label>

    <label>Priority: 
        <select name="priority">
            <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
            <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
            <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
        </select>
    </label>
    <button type="submit">Update Task</button>
</form>
