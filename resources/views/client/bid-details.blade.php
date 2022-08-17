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
    </div>
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Bid Payment Details</h5>
            <form action="{{ route('client-bid-payment') }}" method="POST">
                @csrf
                <input type="hidden" name="mineral_id" value="{{ $mineral->id }}" required>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="Seller" class="">Seller</label>
                            <input name="mine" id="Seller"  type="text" value="{{ getMine($mineral->mine_id)->name }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="Address" class="">Address</label>
                            <input name="address" id="Address" type="text" value="{{ getMine($mineral->mine_id)->address }}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="position-relative form-group">
                    <label for="Mineral" class="">Mineral</label>
                    <input name="mineral" id="Mineral" type="text" value="{{ $mineral->name }}" class="form-control" readonly>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="Quantity" class="">Quantity</label>
                        <input name="quantity" id="Quantity" type="text" value="{{ $mineral->quantity }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="Amount" class="">Amount Payable</label>
                            <input name="amount" id="Amount" type="text" value="{{ $bid->amount }}" class="form-control" required readonly>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="Email" class="">Payment Email</label>
                        <input name="email" id="Email" type="email"  class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="Phone" class="">Payment Phone</label>
                            <input name="phone" id="Phone" type="tel" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button class="mb-2 mr-2 btn btn-primary btn-lg btn-block">
                    Make Payment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
