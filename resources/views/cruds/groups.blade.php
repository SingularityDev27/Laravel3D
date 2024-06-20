@extends('layouts.app')

@section('title', 'Groups')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Groups</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#groupModal" onclick="clearForm()">
        Add Group
    </button>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Grade</th>
            <th>Section</th>
            <th>Code</th>
            <th>Tutor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="groupsTableBody">
        
    </tbody>
</table>

<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="groupForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModalLabel">Add/Edit Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="groupId" name="id">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="number" class="form-control" id="grade" name="grade" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" class="form-control" id="section" name="section" required>
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="tutor_id">Tutor</label>
                        <select class="form-control" id="tutor_id" name="tutor_id" required>
                            
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
        fetchGroups();
        fetchTeachers();

        $('#groupForm').on('submit', function (e) {
            e.preventDefault();

            let id = $('#groupId').val();
            console.log(id)
            let url = id ? `/update/group/${id}` : '/insert/group';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#groupForm').serialize(),
                success: function (response) {
                    $('#groupModal').modal('hide');
                    fetchGroups();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    function fetchGroups() {
        $.get('/get/groups', function (groups) {
            let tableBody = $('#groupsTableBody');
            tableBody.empty();
            groups.forEach(group => {
                tableBody.append(`
                    <tr>
                        <td>${group.grade}</td>
                        <td>${group.section}</td>
                        <td>${group.code}</td>
                        <td>${group.tutor_id}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editGroup(${group.id})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteGroup(${group.id})">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function fetchTeachers() {
        $.get('/get/teachers', function (teachers) {
            let tutorSelect = $('#tutor_id');
            tutorSelect.empty();
            teachers.forEach(teacher => {
                tutorSelect.append(`<option value="${teacher.id}">${teacher.name} ${teacher.lastname_p}</option>`);
            });
        });
    }

    function editGroup(id) {
        $.get(`/get/group/${id}`, function (group) {
            $('#groupId').val(group.id);
            $('#grade').val(group.grade);
            $('#section').val(group.section);
            $('#code').val(group.code);
            $('#tutor_id').val(group.tutor_id);
            $('#groupModal').modal('show');
        });
    }

    function deleteGroup(id) {
        $.ajax({
            url: `/delete/group/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchGroups();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#groupId').val('');
        $('#groupForm')[0].reset();
    }
</script>
@endsection
