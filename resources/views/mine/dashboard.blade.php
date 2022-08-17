<x-app-layout>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Minerals</div>
                            <div class="widget-subheading">different types</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success">
                                @php
                                    $minerals = \App\Models\Mineral::where('mine_id', mine()->id)->count();
                                    echo $minerals;
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
                            <div class="widget-heading">Total Bids</div>
                            <div class="widget-subheading">placed on minerals offered</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">
                                @php
                                    $bidcount = 0;
                                    $mins = \App\Models\Mineral::where('mine_id', mine()->id)->get();

                                    foreach ($mins as $min) {
                                        $bids = \App\Models\MineralBid::where('mineral_id', $min->id)->count();
                                        $bidcount = $bidcount + $bids;
                                    }

                                    echo $bidcount;
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
                            <div class="widget-heading">Total Sales</div>
                            <div class="widget-subheading">purchased minerals</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Income</div>
                            <div class="widget-subheading">Expected totals</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-focus">$147</div>
                        </div>
                    </div>
                    <div class="widget-progress-wrapper">
                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                        </div>
                        <div class="progress-sub-label">
                            <div class="sub-label-left">Expenses</div>
                            <div class="sub-label-right">100%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
