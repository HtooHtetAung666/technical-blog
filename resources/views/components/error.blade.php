@props(['name'])
@error($name)
    <p class="text-danger mt-2">{{$message}}</p>
@enderror