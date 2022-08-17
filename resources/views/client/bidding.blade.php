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
        @foreach ($minerals as $min)
            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        @php
                            $mine = \App\Models\Mine::where('id', $min->mine_id)->first();
                            echo $mine->name;
                        @endphp
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">
                                                    {{ $min->name }}
                                                </div>
                                                <div class="widget-subheading">{{ $min->quantity }}</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-primary">${{ $min->price }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <tr>
                            <th scope="row"><b>Highest Bid </b> - </b></th>
                            <td>${{ max_bid($min->id) }}</td>
                        </tr>
                        <hr>
                        <tr>
                            <th scope="row"><b>Your Bid </b> - </b></th>
                            <td>${{ client_bid($min->id) }}</td>
                            <td>
                                <a href="javascript:void(0);" class="mb-2 mr-2 badge badge-info">
                                    {{ client_bid_status($min->id) }}
                                </a>
                            </td>
                        </tr>
                    </div>
                    <div class="card-footer">
                        @if (active_bid($min->id))
                            @if (subscribed($min->level))
                                <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg{{ $min->id }}" class="mb-2 mr-2 btn btn-primary btn-lg btn-block">
                                    Place Bid
                                </button>
                            @else
                                <button type="button" disabled class="mb-2 mr-2 btn btn-primary btn-lg btn-block">
                                    <i class="pe-7s-lock icon-gradient bg-sunny-morning"> </i>
                                    {{ item_level($min->level) }}
                                </button>
                            @endif

                        @else
                            @if (client_won_bid($min->id))
                                <a href="{{ route('client-bid-details', the_bid($min->id)->id) }}" class="mb-2 mr-2 btn btn-success btn-lg btn-block">
                                    Make Payment
                                </a>
                            @else
                                <button type="button" class="mb-2 mr-2 btn btn-danger btn-lg btn-block" disabled>
                                    {{ client_bid_status($min->id) }}
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
@foreach ($minerals as $mm)
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg{{ $mm->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('client-bid') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Place Bid for {{ $mm->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="mineral_id" value="{{ $mm->id }}" required>
                        <div class="position-relative form-group">
                            <label for="Amount" class="">Your Bidding Amount</label>
                            <input name="amount" id="Amount" placeholder="e.g 123.98" type="number" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Place Bid</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

