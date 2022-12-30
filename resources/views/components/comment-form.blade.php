@props(['blog'])
<x-card-wrapper class="bg-secondary">
    <form action="/blogs/{{$blog->slug}}/comments" method="POST">
      @csrf
      <div class="form-group">
        <textarea
          class="form-control border border-0" 
          name="body" 
          id="" 
          cols="10" 
          rows="5"
          placeholder="write something about blog....">
        </textarea>
        <x-error name="body"/>
      </div>
      <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</x-card-wrapper>