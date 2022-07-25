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
                <div class="card-header">Available Minerals
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            {{-- <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                New
                            </button> --}}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Seller</th>
                            <th>Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Subscription</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($minerals as $min)
                                <tr>
                                    <td class="text-center text-muted">
                                        @php
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="widget-heading">
                                            @php
                                                $mine = \App\Models\Mine::where('id', $min->mine_id)->first();
                                                echo $mine->name;
                                            @endphp
                                        </div>
                                    </td>
                                    <td>
                                        {{ $min->name }}
                                    </td>
                                    <td class="text-center">{{ $min->price }}</td>
                                    <td class="text-center">{{ $min->quantity }}</td>
                                    <td class="text-center">
                                        @if ($min->level == 0)
                                            <div class="mb-2 mr-2 badge badge-secondary">{{ item_level($min->level) }}</div>
                                        @elseif ($min->level == 1)
                                            <div class="mb-2 mr-2 badge badge-primary">{{ item_level($min->level) }}</div>
                                        @elseif ($min->level == 2)
                                            <div class="mb-2 mr-2 badge badge-warning">{{ item_level($min->level) }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="mr-2 btn-icon btn-icon-only btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg{{ $min->id }}">
                                            <i class="fa fa-edit btn-icon-wrapper"> </i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Large modal -->
@foreach ($minerals as $min)
    <div class="modal fade bd-example-modal-lg{{ $min->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin-update-minerals') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update {{ $min->name }} Subscription Access</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="mineral_id" value="{{ $min->id }}" required>
                        <div class="position-relative form-group">
                            <label for="Level" class="">Subscription Accessibility</label>
                            <select name="level" id="Level" class="form-control" required>
                                <option selected disabled>Select Option</option>
                                <option value="0">Ordinary</option>
                                <option value="1">Premium</option>
                                <option value="2">Platinum</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
