<x-app-layout>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    @if (client_level() == 0)
                        <i class="fa fa-user"> </i>
                    @elseif (client_level() == 1)
                        <i class="fa fa-user icon-gradient bg-happy-itmeo"> </i>
                    @elseif (client_level() == 2)
                        <i class="fa fa-user icon-gradient bg-sunny-morning"> </i>
                    @endif
                </div>
                <div>
                    @if (client_level() == 0)
                        Ordinary Account
                        <div class="page-title-subheading">
                            You can pay a subscription fee to upgrade to premium or platinum.
                        </div>
                    @elseif (client_level() == 1)
                        Premium Account
                        <div class="page-title-subheading">
                            You can pay a subscription fee to upgrade to platinum.
                        </div>
                    @elseif (client_level() == 2)
                        Platinum Account
                        <div class="page-title-subheading">
                            You are current a platinum user all features are available.
                        </div>
                    @endif

                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Platinum users have all rights access" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-info"></i>
                </button>
                <div class="d-inline-block dropdown">
                    @if (client_level() < 2)
                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-angle-double-up fa-w-20"></i>
                            </span>
                            Upgrade
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Transactions</div>
                            <div class="widget-subheading">different types</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Bids Won</div>
                            <div class="widget-subheading">bid selected by seller</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">
                                @php
                                    $won = \App\Models\MineralBid::where('user_id', Auth::id())->count();
                                    echo $won;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Consultations</div>
                            <div class="widget-subheading">requested consultations</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">
                                @php
                                    $con = \App\Models\Consultation::where('user_id', Auth::id())->count();
                                    echo $con;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .frb-group {
        margin: 15px 0;
    }

    .frb ~ .frb {
        margin-top: 15px;
    }

    .frb input[type="radio"]:empty,
    .frb input[type="checkbox"]:empty {
        display: none;
    }

    .frb input[type="radio"] ~ label:before,
    .frb input[type="checkbox"] ~ label:before {
        font-family: FontAwesome;
        content: '\f096';
        position: absolute;
        top: 50%;
        margin-top: -11px;
        left: 15px;
        font-size: 22px;
    }

    .frb input[type="radio"]:checked ~ label:before,
    .frb input[type="checkbox"]:checked ~ label:before {
        content: '\f046';
    }

    .frb input[type="radio"] ~ label,
    .frb input[type="checkbox"] ~ label {
        position: relative;
        cursor: pointer;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f2f2f2;
    }

    .frb input[type="radio"] ~ label:focus,
    .frb input[type="radio"] ~ label:hover,
    .frb input[type="checkbox"] ~ label:focus,
    .frb input[type="checkbox"] ~ label:hover {
        box-shadow: 0px 0px 3px #333;
    }

    .frb input[type="radio"]:checked ~ label,
    .frb input[type="checkbox"]:checked ~ label {
        color: #fafafa;
    }

    .frb input[type="radio"]:checked ~ label,
    .frb input[type="checkbox"]:checked ~ label {
        background-color: #f2f2f2;
    }

    .frb.frb-default input[type="radio"]:checked ~ label,
    .frb.frb-default input[type="checkbox"]:checked ~ label {
        color: #333;
    }

    .frb.frb-primary input[type="radio"]:checked ~ label,
    .frb.frb-primary input[type="checkbox"]:checked ~ label {
        background-color: #337ab7;
    }

    .frb.frb-success input[type="radio"]:checked ~ label,
    .frb.frb-success input[type="checkbox"]:checked ~ label {
        background-color: #5cb85c;
    }

    .frb.frb-info input[type="radio"]:checked ~ label,
    .frb.frb-info input[type="checkbox"]:checked ~ label {
        background-color: #5bc0de;
    }

    .frb.frb-warning input[type="radio"]:checked ~ label,
    .frb.frb-warning input[type="checkbox"]:checked ~ label {
        background-color: #f0ad4e;
    }

    .frb.frb-danger input[type="radio"]:checked ~ label,
    .frb.frb-danger input[type="checkbox"]:checked ~ label {
        background-color: #d9534f;
    }

    .frb input[type="radio"]:empty ~ label span,
    .frb input[type="checkbox"]:empty ~ label span {
        display: inline-block;
    }

    .frb input[type="radio"]:empty ~ label span.frb-title,
    .frb input[type="checkbox"]:empty ~ label span.frb-title {
        font-size: 16px;
        font-weight: 700;
        margin: 5px 5px 5px 50px;
    }

    .frb input[type="radio"]:empty ~ label span.frb-description,
    .frb input[type="checkbox"]:empty ~ label span.frb-description {
        font-weight: normal;
        font-style: italic;
        color: #999;
        margin: 5px 5px 5px 50px;
    }

    .frb input[type="radio"]:empty:checked ~ label span.frb-description,
    .frb input[type="checkbox"]:empty:checked ~ label span.frb-description {
        color: #fafafa;
    }

    .frb.frb-default input[type="radio"]:empty:checked ~ label span.frb-description,
    .frb.frb-default input[type="checkbox"]:empty:checked ~ label span.frb-description {
        color: #999;
    }
</style>
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('client-subscribe') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Account Subscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($subs as $sub)
                        <div class="frb frb-primary">
                            <input type="radio" id="radio-button-{{ $sub->id }}" name="amount" value="{{ $sub->amount }}">
                            <label for="radio-button-{{ $sub->id }}">
                                <span class="frb-title">${{ $sub->amount }}</span>
                                <span class="frb-description">{{ $sub->type }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="position-relative form-group">
                        <label for="Phone" class="">Ecocash/Onemoney Mobile Number</label>
                        <input name="phone" id="Phone" placeholder="e.g 0783540959" type="tel" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="Email" class="">Email Address</label>
                        <input name="email" id="Email" placeholder="e.g foo@bar.com" type="email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upgrade Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
