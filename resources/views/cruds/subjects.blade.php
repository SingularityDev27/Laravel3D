@extends('templates.crud')

@section('title', 'Subjects')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Subjects</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subjectModal" onclick="clearForm()">
        Add Subject
    </button>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Code</th>
            <th>Grade</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="subjectsTableBody">
        
    </tbody>
</table>

<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="subjectForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectModalLabel">Add/Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="subjectId" name="id">
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="number" class="form-control" id="grade" name="grade" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Teacher</label>
                        <select class="form-control" id="teacher_id" name="teacher_id" required>
                            
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
        fetchSubjects();

        $('#subjectForm').on('submit', function (e) {
            e.preventDefault();

            let id = $('#subjectId').val();
            console.log(id)
            let url = id ? `/update/subject/${id}` : '/insert/subject';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#subjectForm').serialize(),
                success: function (response) {
                    $('#subjectModal').modal('hide');
                    fetchSubjects();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    function fetchSubjects() {
        $.get('/get/subjects', function (subjects) {
            let tableBody = $('#subjectsTableBody');
            tableBody.empty();
            subjects.forEach(subject => {
                tableBody.append(`
                    <tr>
                        <td>${subject.code}</td>
                        <td>${subject.grade}</td>
                        <td>${subject.name}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editSubject(${subject.id})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteSubject(${subject.id})">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function editSubject(id) {
        $.get(`/get/subject/${id}`, function (subject) {
            $('#subjectId').val(subject.id);
            $('#code').val(subject.code);
            $('#grade').val(subject.grade);
            $('#name').val(subject.name);
            $('#teacher_id').val(subject.teacher_id);
            $('#subjectModal').modal('show');
        });
    }

    function deleteSubject(id) {
        $.ajax({
            url: `/delete/subject/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchSubjects();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#subjectId').val('');
        $('#subjectForm')[0].reset();
    }

    function fetchTeachers() {
        $.get('/get/teachers', function (teachers) {
            let selectTeacher = $('#teacher_id');
            selectTeacher.empty();
            teachers.forEach(teacher => {
                selectTeacher.append(`<option value="${teacher.id}">${teacher.name} ${teacher.lastname_p}</option>`);
            });
        });
    }
</script>
@endsection
