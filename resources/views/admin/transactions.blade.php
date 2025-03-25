@extends('layouts.dash-app')

@section('title','Dashboard | Transactions')

@section('content')

<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Transactions 
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Transactions</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "key", "amount", "fee", {"name": "status", "attr": "data-status"}, {"name": "created", "attr": "data-created"}], "page": 10}' id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <h2 class="card-header-title h4 text-uppercase">Transactions</h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search in keys">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Transaction Type</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Transaction Code</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="amount">Amount</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="fee">Fee (Optional)</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Date</a></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $i = 1;
                            foreach ($Transactions as $recent) { ?>
                                <tr>
                                    <td><?= $i ?? 0 ?></td>
                                    <td class="name"><?= $recent->description ?? '' ?></td>
                                    <td class="key" data-key="<?= $recent->transaction_id ?? 0 ?>"><?= $recent->transaction_id ?? 0 ?></td>
                                    <td class="amount"><?= $recent->amount ? $recent->amount . ' (' . $recent->code . ')' : 0 ?></td>
                                    <td class="fee"><?= $recent->fee ?? 0 ?></td>
                                    <td class="status" data-status="<?= $recent->status ?? '' ?>">
                                        <span class="legend-circle <?= $recent->status === 'success' ? 'bg-success' : 'bg-danger' ?>"></span>
                                        <?= $recent->status ?? '' ?>
                                    </td>
                                    <td class="created" data-created="<?= $recent->date_created ?>"><?= $recent->date_created ?></td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>
            </div>
            
            
            {{-- <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var options = {
                        valueNames: ['name', 'key', 'amount', 'fee', { name: 'status', attr: 'data-status' }, { name: 'created', attr: 'data-created' }],
                        page: 10,
                        pagination: true
                    };
            
                    var keysTable = new List('keysTable', options);
            
                    // Debugging
                    console.log(keysTable);
                    console.log(keysTable.items);
                });
            </script> --}}
        </div>
    </div>
    <!-- / .row -->
</div>

@endsection