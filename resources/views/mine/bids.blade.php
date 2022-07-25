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
                @foreach ($minerals as $min)
                    <div class="card-header">{{ $min->name }} Bidding
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
                                <th>Bidder</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                    $bids = \App\Models\MineralBid::where('mineral_id', $min->id)->orderBy('amount', 'DESC')->get();
                                @endphp
                                @foreach ($bids as $bid)
                                    <tr>
                                        <td class="text-center text-muted">
                                            @php
                                                $count++;
                                                echo $count;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $bidder = \App\Models\User::find($bid->user_id);
                                                echo $bidder->name;
                                            @endphp
                                        </td>
                                        <td class="text-center">{{ $bid->amount }}</td>
                                        <td class="text-center">
                                            {{ $bid->status }}
                                        </td>
                                        <td class="text-center">
                                            @if (!bids_selected($bid->id))
                                                <a href="{{ route('mine-chose-bid', $bid->id) }}" class="mr-2 btn-icon btn-icon-only btn btn-outline-success"><i class="fa fa-check btn-icon-wrapper"> </i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
