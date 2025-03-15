@extends('layouts.main')
@section('title')
  Book - Add
@stop

@section('header')
  Add New Book 
@stop

@section('content')
<div class="col-md-8">
    <div class="row">
        
    <div class="col-md-12">
            <label for="bName" class="form-label">Name</label>
            <input value="@if(!empty($result)){{$result->name}}@endif" type="text" class="form-control" id="bName" placeholder="The Hitchhiker's Guide to the Galaxy">
        </div>
        <div class="col-md-12">
            <label for="bAuthor" class="form-label">Author</label>
            <input  value="@if(!empty($result)){{$result->author}}@endif" type="text" class="form-control" id="bAuthor" placeholder=" Douglas Adams">
        </div>
        <div class="col-md-12">
            <label for="bGenre" class="form-label">Genre</label>
            <input value="@if(!empty($result)){{$result->genre}}@endif"  type="text" class="form-control" id="bGenre" placeholder="Fantasy">
        </div>
        <div class="col-md-12">
            <label for="bCondition" class="form-label">Condition</label>
            <input value="@if(!empty($result)){{$result->condition}}@endif"  type="text" class="form-control" id="bCondition" placeholder="Good / Bad / Damage ">
        </div>
        <div class="col-md-12">
            <label for="bPublishDate" class="form-label">Publication Date</label>
            <input value="@if(!empty($result)){{$result->publication_date}}@endif"  type="text" class="form-control" id="bPublishDate" placeholder="1979">
        </div>
        
        <div class="col-md-12">
            <label for="bCategory" class="form-label">Category</label>
            <select class="form-select form-select-md mb-3" aria-label=".form-select-md example" id="selectBookCategory">
                <option >Open this select menu</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="row">
        <div class="card col-md-12">
            <img src=" @if(!empty($result)){{url('/storage/' . $result->image)}}@else https://placehold.co/400?text=Image+Viewer @endif" class="img-fluid" alt="...">
            <div class="card-body">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <input class="form-control" type="file" id="image">
                    <input value="@if(!empty($result)){{$result->book_id}}@endif" hidden  type="text" class="form-control" id="bBookId">
                    @if(!empty($result))
                    <a id="btnupdate" class="btn btn-info">Update</a>
                    @else
                    <a id="btnsave" class="btn btn-primary">Save</a>
                    @endif
                    <a id="btncancel" href="{{url('/book')}}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>        
    </div>
</div>

<script>
    $(document).ready(function(){
        loadBookCategory();
    });

    function loadBookCategory(){
        $.ajax({
            url:'{{url('/api/load/category')}}',
            type:'GET',
            'content-type' : 'application/json'
        }).done(function(row){
            
            $.each(row.data,function(key, val){ 
                
            // console.log(val.category_id);           
                $("#selectBookCategory").append("<option value='"+val.category_id+"'>"+ val.name +"</option>");
            })
        })
    }

    $('#btnsave').click(function(){
        
        let imageFile = $("#image")[0].files[0];
        let requestData = {
            name : $('#bName').val(),
            author : $('#bAuthor').val(),
            genre : $('#bGenre').val(),  
            condition : $('#bCondition').val(),
            publication_date : $('#bPublishDate').val(),
            category_id : $('#selectBookCategory').val(), 
        };

        if(requestData.name == "" || requestData.description == "" || requestData.genre == "" || requestData.condition == "" || requestData.publication_date == ""){
            return false;
        }

        if (imageFile) {
            let reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function () {
                requestData.image = reader.result; // Convert image to Base64
                saveRequest(requestData);
            };
        } else {
            saveRequest(requestData);
        }
    })

    function saveRequest(data){
        $.ajax({
          url: '{{ url('/api/insert/book')}}',
          type: 'POST',
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function (response) {
            // $('#response').html(`<p style="color: green;">Success: ${JSON.stringify(response)}</p>`);
            window.location.replace("{{url('/book')}}");
          },
          error: function (error) {
            $('#response').html(`<p style="color: red;">Error: ${JSON.stringify(error)}</p>`);
          }
        });
    }

    $("#btnupdate").click(function(){
        let imageFile = $("#image")[0].files[0];

        let requestData = {
            name : $('#bName').val(),
            author : $('#bAuthor').val(),
            genre : $('#bGenre').val(),  
            condition : $('#bCondition').val(),
            publication_date : $('#bPublishDate').val(),
            category_id : $('#selectBookCategory').val(), 
            book_id : $('#bBookId').val(),
        };
        // console.log(requestData);
        
        if (imageFile) {

            let reader = new FileReader();
            reader.readAsDataURL(imageFile);
            reader.onload = function () {
                requestData.image = reader.result; // Convert image to Base64
                sendUpdateRequest(requestData);
            };
        } else {
            sendUpdateRequest(requestData);
        }
      
    });

    function sendUpdateRequest(data){
        $.ajax({
            url: '{{ url('/api/update/book')}}',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (response) {
                // $('#response').html(`<p style="color: green;">Success: ${JSON.stringify(response)}</p>`);
                window.location.replace("{{url('/book')}}");
            },
            error: function (error) {
                $('#response').html(`<p style="color: red;">Error: ${JSON.stringify(error)}</p>`);
            }
        })
    }

</script>
@stop