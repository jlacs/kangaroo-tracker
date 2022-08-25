<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 8 Ajax CRUD Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.1.4/css/dx.material.orange.light.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.1.4/js/dx.all.js"></script>
    
</head>
<body>
<div class="container mt-2">
    
    <div class="row">
        <div class="col-md-12 card-header text-center font-weight-bold">
            <h2>Kangaroo Tracker</h2>
        </div>
        <div class="col-md-12 mt-1 mb-2">
            <a href="{{ route('kangaroo') }}">Home</a> 
        </div>
        <div id="gridContainer"></div>
    </div>        
</div>

<script type="text/javascript">
$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const kangaroot = [];
    @foreach ($kangaroos as $kangaroo)
        kangaroot.push({
            ID: "{{ $kangaroo->id }}",
            NAME: "{{ $kangaroo->name }}",
            BIRTHDAY: "{{ $kangaroo->birthday }}",
            WEIGHT: "{{ $kangaroo->weight }}",
            HEIGHT: "{{ $kangaroo->height }}",
            FRIENDLINESS: "{{ $kangaroo->friendliness }}",
        });
    @endforeach

    console.log(kangaroot);

    $('#gridContainer').dxDataGrid({
        dataSource: kangaroot,
        headerFilter: { 
            visible: true,
            allowSearch: true
        },
        keyExpr: 'ID',
        columns: [
            'ID', 
            'NAME', 
            'BIRTHDAY',
            'WEIGHT', 
            'HEIGHT', 
            'FRIENDLINESS', 
        ],
        showBorders: true,
    });
});
</script>
</body>
</html>