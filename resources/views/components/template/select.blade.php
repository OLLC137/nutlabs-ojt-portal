<div class="form-group">
    <label> {{ $text }} </label>
    <select class="form-control">
        @foreach($options as $key=>$value)
        <option value="{{$key}}"> {{ $value }} </option>
        @endforeach
    </select>
</div>