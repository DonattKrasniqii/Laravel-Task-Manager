<h1>Create New Task</h1>
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <label>Title: <input type="text" name="title" value="{{ old('title') }}"></label>
    <label>Description: <textarea name="description">{{ old('description') }}</textarea></label>
    <label>Priority: 
        <select name="priority">
            <option value="1">High</option>
            <option value="2">Medium</option>
            <option value="3">Low</option>
        </select>
    </label>

    @if ($errors->has('title') || $errors->has('description'))
        <div style="color: red;">
            You must provide a title and description for the task.
        </div>
    @endif
    <button type="submit">Create Task</button>
</form>
