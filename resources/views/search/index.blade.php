hi
<form action="{{ url('/search') }} " method="POST">
    {{-- @method('GET') --}}
    @csrf
    <input type="date" value="{{ old('apdate') }}" name="putdate" class="form-control">
    <button type="submit" class="m-2 bg-blue-300 px-3 py-2 rounded" >搜尋</button>
</form>

@if (empty($flights))
不

    
@else
@foreach($flights as $flight)
        {{ $flight->fName}}
        {{ $flight->date }}
        
    @endforeach 
@endif
