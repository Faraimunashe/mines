<x-app-layout>
    <div class="row">
        <div class="col-md-12">
            <x-auth-validation-errors class="alert alert-danger alert-dismissible" :errors="$errors" />
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle"></i>
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-thumbs-up"></i>
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Add Mine Details</h5>
                    <form action="{{ route('mine-add') }}" method="POST" class="">
                        @csrf
                        <div class="position-relative form-group">
                            <label for="Name" class="">Name</label>
                            <input name="name" id="Name" placeholder="e.g Unkie Mine" type="text" class="form-control" required>
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleAddress" class="">Address</label>
                            <textarea name="address" id="exampleAddress" class="form-control" required>
                            </textarea>
                        </div>
                        <button type="submit" class="mb-2 mr-2 btn btn-primary btn-lg btn-block">
                            Save Details
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
