<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf_token" content="{{ csrf_token() }}" /> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>

<h2>Todo List</h2>

<form action="#" method="post">
  
<input type="text" name="name" id="name"><input type="button" id="btn" class="" value="Add Task">
</form>

<br>

<div style="overflow-x:auto;">
  <table>
  <thead>  
  <tr>
      <th>#</th>
      <th>Task</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
</thead>
   <tbody id="tbody">
   @foreach($allrecords as $key=>$record)
   <tr>
      <td>{{ $key+1 }}</td>
      <td>{{ $record->name }}</td>
      @if($record->status=='completed')
      <td>{{ $record->status }}</td>
      <td><button value="{{ $record->id }}" id="{{ $record->id }}" onclick="delete_record(this.value)">Delete</button></td>
      @else
      <td>{{ $record->status }}</td>
      <td>
      <input type="checkbox" value="{{ $record->id }}" id="{{ $record->id }}" onclick="checkbox_record(this.value)">
      <button value="{{ $record->id }}" id="{{ $record->id }}" onclick="delete_record(this.value)">Delete</button>
      </td>
      @endif
    </tr>
   @endforeach
</tbody>
    
     
  </table>
</div>


<script>
$(document).ready(function()
{
  $("#btn").click(function(e){
     e.preventDefault();
     let datas = $("#name").val();
     if(datas=='')
     {
        alert("name is required");
        return;
     }
     $.ajax({
        url: "/submit",
        type: "POST",
        data : {
            _token:"{{ csrf_token() }}" ,
            name:datas,
        },
        success: function(response) 
        {
          if(response.status==0)
          {
             alert("This name aleady exist");
          }
          else
          {
            $("#name").val('');
             $("#tbody").html(response);
          }

        }    
    });  
  });
});


  function delete_record(id)
  {
    if(confirm("Are you sure you want to delete this?"))
    {
        $.ajax({
        url: "/delete",
        type: "POST",
        data : {
            _token:"{{ csrf_token() }}" ,
            id:id,
        },
        success: function(response) 
        {
            if(response.status==0)
          {
             alert("Record not deleted");
          }
          else
          {
            $("#tbody").html(response);
          }

        }    
    }); 
    }
    else
    {
        return false;
    }
  }


  function checkbox_record(id)
  {
    
        $.ajax({
        url: "/checkbox",
        type: "POST",
        data : {
            _token:"{{ csrf_token() }}" ,
            id:id,
        },
        success: function(response) 
        {
            if(response.status==0)
          {
             alert("Record not deleted");
          }
          else
          {
            $("#tbody").html(response);
          }

        }    
    }); 
    
   
  }
 



</script>    
</body>
</html>
