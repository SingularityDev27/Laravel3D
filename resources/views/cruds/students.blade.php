@extends('templates.crud')

@section('title', 'Students')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Students</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal" onclick="clearForm()">
        Add Student
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
            <th>Group</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="studentsTableBody">
       
    </tbody>
</table>

<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="studentForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Add/Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="studentId" name="id">
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
                        <label for="group_id">Group</label>
                        <select class="form-control" id="group_id" name="group_id" required>
                            
                        </select>
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
        fetchStudents();
        fetchGroups();

        $('#studentForm').on('submit', function (e) {
            e.preventDefault();

            let id = $('#studentId').val();
            let url = id ? `/update/student/${id}` : '/insert/student';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#studentForm').serialize(),
                success: function (response) {
                    $('#studentModal').modal('hide');
                    fetchStudents();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    function fetchStudents() {
        $.get('/get/students', function (students) {
            let tableBody = $('#studentsTableBody');
            tableBody.empty();
            students.forEach(student => {
                tableBody.append(`
                    <tr>
                        <td>${student.name}</td>
                        <td>${student.lastname_p}</td>
                        <td>${student.lastname_m}</td>
                        <td>${student.age}</td>
                        <td>${student.degree}</td>
                        <td>${student.email}</td>
                        <td>${student.phone}</td>
                        <td>${student.birthdate}</td>
                        <td>${student.group_id}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editStudent(${student.id})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteStudent(${student.id})">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function fetchGroups() {
        $.get('/get/groups', function (groups) {
            let groupSelect = $('#group_id');
            groupSelect.empty();
            groups.forEach(group => {
                groupSelect.append(`<option value="${group.id}">${group.code}</option>`);
            });
        });
    }

    function editStudent(id) {
        $.get(`/get/student/${id}`, function (student) {
            $('#studentId').val(student.id);
            $('#name').val(student.name);
            $('#lastname_p').val(student.lastname_p);
            $('#lastname_m').val(student.lastname_m);
            $('#age').val(student.age);
            $('#degree').val(student.degree);
            $('#email').val(student.email);
            $('#phone').val(student.phone);
            $('#birthdate').val(student.birthdate);
            $('#group_id').val(student.group_id);
            $('#studentModal').modal('show');
        });
    }

    function deleteStudent(id) {
        $.ajax({
            url: `/delete/student/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchStudents();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#studentId').val('');
        $('#studentForm')[0].reset();
    }
</script>
@endsection
