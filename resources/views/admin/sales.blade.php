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
                <div class="card-header">Sales
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button type="button" class="btn mr-2 mb-2 btn-primary" >
                                Print Report
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Buyer</th>
                            <th>Mineral</th>
                            <th>Seller</th>
                            <th>Amount</th>
                            <th>Mine Share</th>
                            <th>Difference</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($sales as $item)
                                <tr>
                                    <td class="text-center text-muted">
                                        @php
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </td>
                                    <td>
                                        {{ buyer($item->buyer_id)->firstname}} {{ buyer($item->buyer_id)->lastname}}
                                    </td>
                                    <td>
                                        {{ sold($item->mineral_id)->name}}
                                    </td>
                                    <td>{{ seller(sold($item->mineral_id)->mine_id)->name }}</td>
                                    <td>{{ $item->selling_amount }}</td>
                                    <td>{{ $item->mine_amount }}</td>
                                    <td>{{ $item->system_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
