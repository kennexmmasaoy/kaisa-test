@extends('layouts.main')
@section('title')
  Book 
@stop

@section('header')
  Book  CRUD
@stop

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('/book/add')}}" class="btn btn-primary me-md-2" type="button">Add New Book</a>
        </div>
        <table
            id="tbl_book" 
            class="table table-striped"
            data-page-length='10'
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Condition</th>
                    <th scope="col">Publication Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

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
      url:'{{url('/api/load/book')}}',
      type:'GET',
      'content-type' : 'application/json'
    })
    .done(function(row){
      $('#tbl_book')
      .dataTable({
            "order": [[ 0, 'desc' ]],
            "bPaginate": true, //pagination numbers
            "bInfo": false, //pagination entries
            "searching": true, //search box
            'paging' : true, //drop down 
            'processing' : true,
            "aaData": row['data'],
            "columns": [
                { "data": "book_id" },
                { "data" : null,
                    render : function(data, type, full){
                        return(
                           '<img width="150px" class="img-fluid  img-thumbnail" src="{{url('/storage/')}}' + '/' + data.image +'" />'
                        )
                    }
                },
                { "data": "name" },
                { "data": "author" },
                { "data": "genre" },
                { "data": "condition" },
                { "data": "publication_date" },
                { "data": null,
                  render : function(data, type,full){
                        return(
                            '<a class="btn btn-sm btn-info" id="btnEdit" data-bookid="'+ data.book_id +'">Edit</a> '+ 
                            '<a class="btn btn-sm btn-danger" id="btnDelete" >Delete</a>'
                        )
                    }
                }
            ],
      });

    });
}

$("#tbl_book").on('click',"a[id='btnEdit']",function()
{
    let bookid = $(this).closest("tr").find('a[id="btnEdit"]').data('bookid');
    window.location.replace("{{url('/book/edit')}}?id=" + bookid);
})

$('#tbl_book').on('click', "a[id='btnDelete']",function(){ 
    let bookid = $(this).closest("tr").find('a[id="btnEdit"]').data('bookid');
    let data = {
        'catid' : bookid, 
      };
    $.ajax({
      'url' : '{{url('/api/delete/book/')}}',
      'type': 'GET',
      'data': data,
      'content-type':'application/json',
    }).done(function(){  
    //   destroyTable();
    //   loadTable()
    window.location.replace("{{url('/book')}}");
    });
});
</script>
@stop