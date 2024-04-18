<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School CRUD Testing</title>
</head>
<body>
    <h1>School CRUD Testing</h1>

    <h2>Create School</h2>
    <form action="{{ route('school.create') }}" method="POST">
        @csrf
        <label for="Thai_Name">Thai Name:</label><br>
        <input type="text" id="Thai_Name" name="Thai_Name" value=""><br><br>
        <!-- Add more input fields for other attributes if needed -->
        <button type="submit">Create</button>
    </form>

    <hr>

    <h2>Update School</h2>
    <form id="updateForm" action="{{ route('school.update', ['id' => '__id__']) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="update_id">Enter School ID:</label><br>
        <input type="text" id="update_id" name="id" value=""><br><br>
        <label for="Updated_Thai_Name">Updated Thai Name:</label><br>
        <input type="text" id="Updated_Thai_Name" name="Thai_Name" value=""><br><br>
        <!-- Add more input fields for other attributes if needed -->
        <button type="submit">Update</button>
    </form>
    
    <hr>

    <h2>Delete School</h2>
    <form id="deleteForm" action="{{ route('school.delete', ['id' => '__id__']) }}" method="POST">
        @csrf
        @method('DELETE')
        <label for="delete_id">Enter School ID:</label><br>
        <input type="text" id="delete_id" name="id" value=""><br><br>
        <button type="submit">Delete</button>
    </form>

    <hr>

    <h2>Get School by ID</h2>
    <form id="getForm" action="{{ route('school.getById', ['id' => '__id__']) }}" method="GET">
        @csrf
        <label for="get_id">Enter School ID:</label><br>
        <input type="text" id="get_id" name="id" value=""><br><br>
        <button type="submit">Get School</button>
    </form>

    <script>
        document.getElementById('update_id').addEventListener('input', function() {
            var updateFormAction = "{{ route('school.update', ['id' => '__id__']) }}";
            var updatedAction = updateFormAction.replace('__id__', this.value);
            document.getElementById('updateForm').action = updatedAction;
        });

        document.getElementById('delete_id').addEventListener('input', function() {
            var deleteFormAction = "{{ route('school.delete', ['id' => '__id__']) }}";
            var updatedAction = deleteFormAction.replace('__id__', this.value);
            document.getElementById('deleteForm').action = updatedAction;
        });

        document.getElementById('get_id').addEventListener('input', function() {
            var getFormAction = "{{ route('school.getById', ['id' => '__id__']) }}";
            var updatedAction = getFormAction.replace('__id__', this.value);
            document.getElementById('getForm').action = updatedAction;
        });
    </script>
</body>
</html>
