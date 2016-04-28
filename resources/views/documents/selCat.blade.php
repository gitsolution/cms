@foreach($Categories as $cat)
    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
@endforeach

