<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h3>Student List</h3>
        <a href="{{ route('student.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-dark">
              @foreach($studentloginfroms as $student )
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
      
            <tr>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <!-- EDIT (later) -->
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>

                    <!-- DELETE -->
                    <form action="{{ route('student.delete', $student->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

</body>
</html>
