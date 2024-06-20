@extends('templates.crud')

@section('title', 'Teachers')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Teachers</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#teacherModal" onclick="clearForm()">
        Add Teacher
    </button>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Lastname P</th>
            <th>Lastname M</th>
            <th>Age</th>
            <th>Degree</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birthdate</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="teachersTableBody">
        
    </tbody>
</table>

<div class="modal fade" id="teacherModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="teacherForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="teacherModalLabel">Add/Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="teacherId" name="id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname_p">Lastname P</label>
                        <input type="text" class="form-control" id="lastname_p" name="lastname_p" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname_m">Lastname M</label>
                        <input type="text" class="form-control" id="lastname_m" name="lastname_m" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        fetchTeachers();

        $('#teacherForm').on('submit', function (e) {
            e.preventDefault();

            let id = $('#teacherId').val();
            console.log(id)
            let url = id ? `/update/teacher/${id}` : '/insert/teacher';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#teacherForm').serialize(),
                success: function (response) {
                    $('#teacherModal').modal('hide');
                    fetchTeachers();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    function fetchTeachers() {
        $.get('/get/teachers', function (teachers) {
            let tableBody = $('#teachersTableBody');
            tableBody.empty();
            teachers.forEach(teacher => {
                tableBody.append(`
                    <tr>
                        <td>${teacher.name}</td>
                        <td>${teacher.lastname_p}</td>
                        <td>${teacher.lastname_m}</td>
                        <td>${teacher.age}</td>
                        <td>${teacher.degree}</td>
                        <td>${teacher.email}</td>
                        <td>${teacher.phone}</td>
                        <td>${teacher.birthdate}</td>
                        <td>${teacher.salary}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editTeacher(${teacher.id})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteTeacher(${teacher.id})">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function editTeacher(id) {
        $.get(`/get/teacher/${id}`, function (teacher) {
            $('#teacherId').val(teacher.id);
            $('#name').val(teacher.name);
            $('#lastname_p').val(teacher.lastname_p);
            $('#lastname_m').val(teacher.lastname_m);
            $('#age').val(teacher.age);
            $('#degree').val(teacher.degree);
            $('#email').val(teacher.email);
            $('#phone').val(teacher.phone);
            $('#birthdate').val(teacher.birthdate);
            $('#salary').val(teacher.salary);
            $('#teacherModal').modal('show');
        });
    }

    function deleteTeacher(id) {
        $.ajax({
            url: `/delete/teacher/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchTeachers();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#teacherId').val('');
        $('#teacherForm')[0].reset();
    }
</script>
@endsection
