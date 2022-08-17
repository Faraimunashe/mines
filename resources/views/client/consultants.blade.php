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
                <div class="card-header">Available Consults
                    <div class="btn-actions-pane-right">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Consultant</th>
                            <th>Issue</th>
                            <th>Price</th>
                            <th>Subscription</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($consultants as $item)
                                <tr>
                                    <td class="text-center text-muted">
                                        @php
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </td>
                                    <td>
                                        {{ get_consultant($item->consultant_id)->name }}
                                    </td>
                                    <td>{{ $item->topic }}</td>
                                    <td>
                                        {{ $item->fee }}
                                    </td>
                                    <td>
                                        @if ($item->level == 0)
                                            <div class="mb-2 mr-2 badge badge-secondary">{{ item_level($item->level) }}</div>
                                        @elseif ($item->level == 1)
                                            <div class="mb-2 mr-2 badge badge-primary">{{ item_level($item->level) }}</div>
                                        @elseif ($item->level == 2)
                                            <div class="mb-2 mr-2 badge badge-warning">{{ item_level($item->level) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (subscribed($item->level))
                                            <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg{{ $item->id }}" class="mr-2 btn-icon btn-icon-only btn btn-outline-success">
                                                <i class="pe-7s-check btn-icon-wrapper"> </i>
                                            </button>
                                        @else
                                            upgrade
                                        @endif
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
@foreach ($consultants as $mm)
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg{{ $mm->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('client-consult') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pay fee for {{ $mm->topic }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="consult_id" value="{{ $mm->id }}" required>
                        <div class="position-relative form-group">
                            <label for="Amount" class="">Enter Amount</label>
                            <input name="amount" id="Amount" placeholder="e.g 123.98" type="number" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pay Fee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

