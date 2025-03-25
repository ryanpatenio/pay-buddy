@extends('layouts.dash-app')

@section('title','Pay Buddy | admin')

@section('content')

<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">Dashboard
    </h1>
    <div class="row">
        <!--users--->
        <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Title -->
                            <h5 class="text-uppercase text-muted fw-semibold mb-2">Users
                            </h5>
                            <!-- Subtitle -->
                            <h2 class="mb-0"><?=$userCount ?? 0 ?>
                            </h2>
                        </div>
                        <div class="col-auto">
                            <!-- Icon -->
                            <svg viewBox="0 0 24 24" height="30" width="30" class="text-primary" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.250 6.000 A2.250 2.250 0 1 0 6.750 6.000 A2.250 2.250 0 1 0 2.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M4.5,9.75A3.75,3.75,0,0,0,.75,13.5v2.25h1.5l.75,6H6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.250 6.000 A2.250 2.250 0 1 0 21.750 6.000 A2.250 2.250 0 1 0 17.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M19.5,9.75a3.75,3.75,0,0,1,3.75,3.75v2.25h-1.5l-.75,6H18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M9.000 3.750 A3.000 3.000 0 1 0 15.000 3.750 A3.000 3.000 0 1 0 9.000 3.750 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25,13.5a5.25,5.25,0,0,0-10.5,0v2.25H9l.75,7.5h4.5l.75-7.5h2.25Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Today users
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0"><?=$userCountThisDay ?? 0 ?>
                            </p>
                        </div>
                        <div class="col text-end text-truncate">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Monthly users
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0"><?=$userCountThisMonth ?? 0 ?>
                            </p>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div>
        <!--End of Users-->

        
        <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Title -->
                            <h5 class="text-uppercase text-muted fw-semibold mb-2">Request
                            </h5>
                            <!-- Subtitle -->
                            <h2 class="mb-0"><?=$totalRequest ?? 0 ?>
                            </h2>
                        </div>
                        <div class="col-auto">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-exclamation text-primary" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                              </svg>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Today Request
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0"><?=$requestThisDay ?? 0 ?>
                            </p>
                        </div>
                        <div class="col text-end text-truncate">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Monthly Request
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0"><?=$requestThisMonth ?? 0 ?>
                            </p>
                        </div>
                        
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div>


        <!---Investors-->
        {{-- <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Title -->
                            <h5 class="text-uppercase text-muted fw-semibold mb-2">Investors
                            </h5>
                            <!-- Subtitle -->
                            <h2 class="mb-0">10
                            </h2>
                        </div>
                        <div class="col-auto">
                            <!-- Icon -->
                            <svg viewBox="0 0 24 24" height="30" width="30" class="text-primary" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.250 6.000 A2.250 2.250 0 1 0 6.750 6.000 A2.250 2.250 0 1 0 2.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M4.5,9.75A3.75,3.75,0,0,0,.75,13.5v2.25h1.5l.75,6H6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.250 6.000 A2.250 2.250 0 1 0 21.750 6.000 A2.250 2.250 0 1 0 17.250 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M19.5,9.75a3.75,3.75,0,0,1,3.75,3.75v2.25h-1.5l-.75,6H18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M9.000 3.750 A3.000 3.000 0 1 0 15.000 3.750 A3.000 3.000 0 1 0 9.000 3.750 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25,13.5a5.25,5.25,0,0,0-10.5,0v2.25H9l.75,7.5h4.5l.75-7.5h2.25Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <!-- Label -->
                            <a href="/Dashboard-Investors"class="text-primary">View Investors</a>
                            <p class="fs-6 text-muted text-uppercase mb-0">
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0">
                            </p>
                        </div>
                        
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div> --}}

        <!---End User Request-->

        <!--Earnings--->
        <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Title -->
                            <h5 class="text-uppercase text-muted fw-semibold mb-2">Earnings
                            </h5>
                            <!-- Subtitle -->
                            <h2 class="mb-0" id="total-earnings">
                                <?= $earnings['total'] ? ($earnings['total']->symbol . ' ' . $earnings['total']->total) : '0' ?>
                            </h2>
                        </div>
                        <div class="col-auto">
                            <!-- Icon -->
                            <label for="">Currency</label>
                            <select name="currency" class="form-control bg-primary text-black" id="currency">
                                <?php
                                foreach ($currencies as $curr) { ?>
                                   <option value="<?=$curr->code ?? '' ?>"><?=$curr->code ?? '' ?></option>
                              <?php  }    
                                ?>
                                
                            </select>
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="30" width="30" class="text-primary">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                            stroke: currentColor;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }
                                    </style>
                                </defs>
                                <title>monitor-graph-line</title>
                                <polygon class="a" points="15 23.253 9 23.253 9.75 18.753 14.25 18.753 15 23.253"/>
                                <line class="a" x1="6.75" y1="23.253" x2="17.25" y2="23.253"/>
                                <rect class="a" x="0.75" y="0.753" width="22.5" height="18" rx="3" ry="3"/>
                                <path class="a" d="M18.75,5.253H16.717a1.342,1.342,0,0,0-.5,2.588l2.064.825a1.342,1.342,0,0,1-.5,2.587H15.75"/>
                                <line class="a" x1="17.25" y1="5.253" x2="17.25" y2="4.503"/>
                                <line class="a" x1="17.25" y1="12.003" x2="17.25" y2="11.253"/>
                                <path class="a" d="M.75,11.253,4.72,7.284a.749.749,0,0,1,1.06,0L7.72,9.223a.749.749,0,0,0,1.06,0l3.97-3.97"/>
                                <line class="a" x1="0.75" y1="15.753" x2="23.25" y2="15.753"/>
                            </svg> --}}
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Today earnings
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0" id="today-earnings">
                                <?= $earnings['today'] ? ($earnings['today']->symbol . ' ' . $earnings['today']->total) : '0' ?>
                            </p>
                        </div>
                        <div class="col text-end text-truncate">
                            <!-- Label -->
                            <p class="fs-6 text-muted text-uppercase mb-0">Monthly earnings
                            </p>
                            <!-- Comment -->
                            <p class="fs-5 fw-bold mb-0" id="monthly-earnings">
                                <?= $earnings['monthly'] ? ($earnings['monthly']->symbol . ' ' . $earnings['monthly']->total) : '0' ?>
                            </p>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div>
        <!--End of Earnings-->

        <!--Overall Balance-->
        {{-- <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 text-bg-primary flex-fill w-100">
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="text-uppercase fw-semibold mb-2">Total Bank Balance
                    </h4>
                    <!-- Subtitle -->
                    <h2 class="mb-0">₱ 981,340
                    </h2>
                    <!-- Chart -->
                    
                </div>
            </div>
        </div>
    </div> --}}
    <!--End of Overall Balance -->

    <!--Recent Transactions-->
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["key", "code", "amount", "fee", "status", "created"], "page": 10}' id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <h2 class="card-header-title h4 text-uppercase">Recent Transactions</h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search in keys">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Transaction Type</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="code">Transaction Code</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="amount">Amount</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="fee">Fee (Optional)</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status</a></th>
                                <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Date</a></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php foreach ($Transactions as $recent) { ?>
                                <tr>
                                    <td class="key" data-key="<?= $recent->description ?? '' ?>"><?= $recent->description ?? '' ?></td>
                                    <td class="code" data-code="<?= $recent->transaction_id ?? 0 ?>"><?= $recent->transaction_id ?? 0 ?></td>
                                    <td class="amount" data-amount="<?= $recent->amount ? $recent->amount . ' (' . $recent->code . ')' : 0 ?>"><?= $recent->amount ? $recent->amount . ' (' . $recent->code . ')' : 0 ?></td>
                                    <td class="fee" data-fee="<?= $recent->fee ?? 0 ?>"><?= $recent->fee ?? 0 ?></td>
                                    <td class="status" data-status="<?= $recent->status ?? '' ?>"><?= $recent->status ?? '' ?>
                                        <span class="legend-circle <?= $recent->status === 'success' ? 'bg-success' : 'bg-danger' ?>"></span>
                                    </td>
                                    <td class="created" data-created="<?= $recent->date_created ?>"><?= $recent->date_created ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>
            </div>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var options = {
                        valueNames: ['key', 'code', 'amount', 'fee', 'status', 'created'],
                        page: 10,
                        pagination: true
                    };
            
                    var keysTable = new List('keysTable', options);
            
                    // Debugging
                    // console.log(keysTable);
                    // console.log(keysTable.items);
                });
            </script>
        </div>
    </div>
    
    <!--End of recent Transactions-->
   
    <!-- / .row -->
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-header border-0 card-header-space-between">
                    <!-- Title -->
                    <h2 class="card-header-title h4 text-uppercase">Earnings report this year
                    </h2>
                    <ul class="nav">
                        <li class="nav-item d-flex" data-toggle="chart" data-target="#salesReportChart" data-dataset="0">
                            <a class="nav-link active chart-legend" href="#" data-bs-toggle="tab">
                                <span class="legend-circle-lg bg-primary"></span>
                                Earnings
                            
                            </a>
                            <select id="currencySelector" class="form-select bg-primary text-black">
                                <?php
                                foreach ($currencies as $curr) { ?>
                                   <option value="<?=$curr->code ?? '' ?>"><?=$curr->code ?? '' ?></option>
                              <?php  }    
                                ?>
                            </select>
                        </li>
                       
                    </ul>
                </div>
                <div class="card-body d-flex flex-column">
                    <!-- Chart -->
                    <div class="chart-container flex-grow-1 h-275px">
                        <canvas id="salesReportChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / .row -->
</div>

<script src="{{asset('assets/js/admin/dashboard/dash.js')}}"></script>

@endSection