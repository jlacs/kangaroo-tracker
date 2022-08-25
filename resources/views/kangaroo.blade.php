<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 8 Ajax CRUD Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
</head>
<body>
<div class="container mt-2">
    
    <div class="row">
        <div class="col-md-12 card-header text-center font-weight-bold">
            <h2>Kangaroo Tracker</h2>
        </div>
        <div class="col-md-12 mt-1 mb-2">
            <button type="button" id="add-new-kangaroo" class="btn btn-success float-right">Create</button>
            <a href="{{ route('grid') }}">DashBoard</a> 
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">NICKNAME</th>
                        <th scope="col">WEIGHT</th>
                        <th scope="col">HEIGHT</th>
                        <th scope="col">GENDER</th>
                        <th scope="col">COLOR</th>
                        <th scope="col">FRIENDLINESS</th>
                        <th scope="col">BIRTHDAY</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($kangaroos as $kangaroo)
                    <tr>
                        <td>{{ $kangaroo->id }}</td>
                        <td>{{ $kangaroo->name }}</td>
                        <td>{{ $kangaroo->nickname }}</td>
                        <td>{{ $kangaroo->weight }}</td>
                        <td>{{ $kangaroo->height }}</td>
                        <td>{{ $kangaroo->gender }}</td>
                        <td>{{ $kangaroo->color }}</td>
                        <td>{{ $kangaroo->friendliness }}</td>
                        <td>{{ $kangaroo->birthday }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{ $kangaroo->id }}">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-primary delete" data-id="{{ $kangaroo->id }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $kangaroos->links() !!}
        </div>
    </div>        
</div>
<!-- boostrap model -->
<div class="modal fade" id="ajax-kangaroo-model" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="kangaroo-model"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="add-edit-form" name="add-edit-form" class="form-horizontal" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" value="" maxlength="50" required="">
                        <span id="name-span" class="text-danger">
                            <label class="col-form-label-sm" id="name-error"></label>
                        </span>
                    </div>  
                </div>  
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nickname</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nickname" name="nickname" value="" maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Weight</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="kg" value="" required="">
                        <span id="weight-span" class="text-danger">
                            <label class="col-form-label-sm" id="weight-error"></label>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Height</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="height" name="height" placeholder="cm" value="" required="">
                        <span id="height-span" class="text-danger">
                            <label class="col-form-label-sm" id="height-error"></label>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-12">
                        <select class="custom-select" id="gender" value="" required="">
                            <option selected disabled value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span id="gender-span" class="text-danger">
                            <label class="col-form-label-sm" id="gender-error"></label>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="color" name="color" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Friendliness</label>
                    <div class="col-sm-12">
                        <select class="custom-select" id="friendliness">
                            <option selected disabled value="">Select</option>
                            <option value="friendly">Friendly</option>
                            <option value="not friendly">Not Friendly</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Birthday</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control date" id="birthday" name="birthday" placeholder="yyyy-mm-dd" value="" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <span id="birthday-span" class="text-danger">
                            <label class="col-form-label-sm" id="birthday-error"></label>
                        </span>
                    </div>
                </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary float-right" id="btn-save" value="add-new-kangaroo">Save</button>
                </div>
                </form>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->
<script type="text/javascript">
$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#name-span').hide();
    $('#weight-span').hide();
    $('#height-span').hide();
    $('#gender-span').hide();
    $('#birthday-span').hide();

    $('.date').datepicker({  
        format: 'yyyy-mm-dd'
    });

    $('#add-new-kangaroo').click(function () {
        $('#add-edit-form').trigger("reset");
        $('#kangaroo-model').html("Add Kangaroo");
        $('#ajax-kangaroo-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        $.ajax({
            type:"POST",
            url: "{{ url('update') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $('#kangaroo-model').html("Edit Kangaroo");
                $('#ajax-kangaroo-model').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#nickname').val(res.nickname);
                $('#weight').val(res.weight);
                $('#height').val(res.height);
                $('#gender').val(res.gender);
                $('#color').val(res.color);
                $('#friendliness').val(res.friendliness);
                $('#birthday').val(res.birthday);
            }
        });
    });

    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
         
            $.ajax({
                type:"POST",
                url: "{{ url('delete') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    window.location.reload();
                }
            });
        }
    });

    $('body').on('click', '#btn-save', function (event) {
        var id = $("#id").val();
        var name = $('#name').val();
        var nickname = $('#nickname').val();
        var weight = $('#weight').val();
        var height = $('#height').val();
        var gender = $('#gender').val();
        var color = $('#color').val();
        var friendliness = $('#friendliness').val();
        var birthday = $('#birthday').val();
        
        $.ajax({
            type:"POST",
            url: "{{ url('create') }}",
            data: {
                id:id,
                name:name,
                nickname:nickname,
                weight:weight,
                height:height,
                gender:gender,
                color:color,
                friendliness:friendliness,
                birthday:birthday
            },
            dataType: 'json',
            success: function(res){
                console.log(res);
                if(res.errors) {
                    if(res.errors.name) {
                        $('#name-span').show();
                        $('#name-error').html(res.errors.name[0]);
                    }
                    else {
                        $('#name-span').hide();
                    }

                    if(res.errors.weight) {
                        $('#weight-span').show();
                        $('#weight-error').html(res.errors.weight[0]);
                    }
                    else {
                        $('#weight-span').hide();
                    }

                    if(res.errors.height) {
                        $('#height-span').show();
                        $('#height-error').html(res.errors.height[0]);
                    }
                    else {
                        $('#height-span').hide();
                    }

                    if(res.errors.gender) {
                        $('#gender-span').show();
                        $('#gender-error').html(res.errors.gender[0]);
                    }
                    else {
                        $('#gender-span').hide();
                    }

                    if(res.errors.birthday) {
                        $('#birthday-span').show();
                        $('#birthday-error').html(res.errors.birthday[0]);
                    }
                    else {
                        $('#birthday-span').hide();
                    }
                }

                if(res.success) {
                    $('#name-span').hide();
                    $('#weight-span').hide();
                    $('#height-span').hide();
                    $('#gender-span').hide();
                    $('#birthday-span').hide();
                    window.location.reload();
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                }
            }
        });
    });
});
</script>
</body>
</html>