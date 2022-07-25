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
                <div class="card-header">Available Clients
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
                            <th>User</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th class="">Phone</th>
                            <th class="">Subscription</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($clients as $client)
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
                                                $user = \App\Models\User::where('id', $client->user_id)->first();
                                                echo $user->name;
                                            @endphp
                                        </div>
                                    </td>
                                    <td>
                                        {{ $client->firstname }}
                                    </td>
                                    <td>
                                        {{ $client->lastname }}
                                    </td>
                                    <td class="">{{ $client->phone }}</td>
                                    <td>
                                        @if ($client->level == 0)
                                            <div class="mb-2 mr-2 badge badge-secondary">{{ item_level($client->level) }}</div>
                                        @elseif ($client->level == 1)
                                            <div class="mb-2 mr-2 badge badge-primary">{{ item_level($client->level) }}</div>
                                        @elseif ($client->level == 2)
                                            <div class="mb-2 mr-2 badge badge-warning">{{ item_level($client->level) }}</div>
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
