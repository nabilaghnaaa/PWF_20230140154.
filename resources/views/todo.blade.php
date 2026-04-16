<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>

<h1>Todo Collection</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Is Completed</th>
        <th>User ID</th>
    </tr>

    @foreach($todos as $todo)
        <tr>
            <td>{{ $todo->id }}</td>
            <td>{{ $todo->title }}</td>
            <td>{{ $todo->description }}</td>
            <td>{{ $todo->is_completed }}</td>
            <td>{{ $todo->user_id }}</td>
        </tr>
    @endforeach

</table>

</body>
</html>