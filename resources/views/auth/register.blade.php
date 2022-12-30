<x-layout>
    <div class="container my-3">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h3 class="text-primary text-center">Register form</h3>
                <div class="card p-4 my-3 shadow-sm">
                    <form method="POST" action="/register/store">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            <x-error name="name"/>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                            <x-error name="username"/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                            <x-error name="email"/>
                        </div>  
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password">
                          <x-error name="password"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>