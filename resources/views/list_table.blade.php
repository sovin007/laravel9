
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
 