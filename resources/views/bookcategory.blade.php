@extends('layouts.main')
@section('title')
  Book Category
@stop

@section('header')
  Book Category CRUD
@stop

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <table 
        id="tbl_bookcat" 
        class="table table-striped"
        data-page-length='10' >
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="bookcat" >
          <tr>
            <th scope="row">...</th>
            <td>...</td>
            <td>...</td>
            <td>...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
        <div class="mb-3">
          <label for="iBookCategoryName" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="iBookCategoryName" aria-describedby="Book Category Name">
        </div>
        <div class="mb-3">
          <label for="iBookCategoryDescription" class="form-label">Category Description</label>
          
          <textarea class="form-control" id="iBookCategoryDescription" rows="3"  aria-describedby="Book Category Description"></textarea>
          
        </div>
        <div id="response"></div>
        <button id="submit" class="btn btn-primary">Add</button>
    
    </div>
  </div>
</div>
<i>{{url('/')}}</i>
<script>
   $(document).ready(function(){
    destroyTable();
    loadTable();
   });

   function destroyTable(){
    $('#tbl_bookcat').DataTable().destroy();
   }

   function loadTable(){
    $.ajax({
      url:'{{url('/api/load/category')}}',
      type:'GET',
      'content-type' : 'application/json'
    })
    .done(function(row){
      $('#tbl_bookcat')
      .dataTable({
            "order": [[ 0, 'desc' ]],
            "bPaginate": true, //pagination numbers
            "bInfo": false, //pagination entries
            "searching": true, //search box
            'paging' : true, //drop down 
            'processing' : true,
            "aaData": row['data'],
            "columns": [
                { "data": "category_id" },
                { "data": "name" },
                { "data": "description" },
                { "data": null,
                  render : function(data, type,full){
                        return(
                            '<a class="btn btn-sm btn-info" id="btnEdit" data-catid="'+ data.category_id +'">Edit</a> '+ 
                            '<a class="btn btn-sm btn-danger" id="btnDelete" >Delete</a>'
                        )
                    }
                }
            ],
      });

    });
   }

   $('#tbl_bookcat').on('click', "a[id='btnDelete']",function(){
    let catid = $(this).closest("tr").find('a[id="btnEdit"]').data('catid');
    let data = {
        'catid' : catid, 
      };
    $.ajax({
      'url' : '{{url('/api/delete/category/')}}',
      'type': 'GET',
      'data': data,
      'content-type':'application/json',
    }).done(function(){      
      destroyTable();
      loadTable();
      
      $('#submit').removeAttr('data-catid');
      $('#submit').text('Add');
    });
   });

   $('#tbl_bookcat').on('click',"a[id='btnEdit']",function(){
      let catid = $(this).closest("tr").find('a[id="btnEdit"]').data('catid');
      let data = {
        'catid' : catid, 
      };
      $.ajax({
        'url' : '{{url('/api/edit/category')}}',
        'type': 'GET',
        'data': data,
        'content-type' : 'application/json',
      }).done(function(row){
        $('#iBookCategoryName').val(row.data[0].name);
        $('#iBookCategoryDescription').val(row.data[0].description);
        $('#submit').attr('data-catid',row.data[0].category_id);
        $('#submit').text('Update');
      });
    });

    $('#submit').click(function(){
      
      let submittext = $('#submit').text();
     

      let data = {
        name : $('#iBookCategoryName').val(),
        description : $('#iBookCategoryDescription').val(),  
        category_id : $('#submit').data('catid')
      };

      if(data.name == "" || data.description == ""){
        return;
      }

      if(submittext == "Update"){
        console.log(submittext);
        $.ajax({
          url: '{{ url('/api/update/category')}}',
          type: 'POST',
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function(response){
            $('#response').html(`<p style="color: green;">Success: ${JSON.stringify(response)}</p>`);
            $('#iBookCategoryName').val('');
            $('#iBookCategoryDescription').val('');
            destroyTable();
            loadTable();
          },
          error: function (error) {
            $('#response').html(`<p style="color: red;">Error: ${JSON.stringify(error)}</p>`);
          }
        })
      }else{
        $.ajax({
          url: '{{ url('/api/insert/category')}}',
          type: 'POST',
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function (response) {
            $('#response').html(`<p style="color: green;">Success: ${JSON.stringify(response)}</p>`);
            $('#iBookCategoryName').val('');
            $('#iBookCategoryDescription').val('');
            destroyTable();
            loadTable();
          },
          error: function (error) {
            $('#response').html(`<p style="color: red;">Error: ${JSON.stringify(error)}</p>`);
          }
        });
      }
    
    
    });

</script>
@stop