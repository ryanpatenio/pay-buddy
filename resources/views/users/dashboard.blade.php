
@extends('layouts.app')

@section('content')
            <div class="container-fluid">
                <!-- Title -->
                <h1 class="h2">My Wallet
                </h1>
                <form method="GET" >
                    <select id="currencySelect" name="currency" class="form-select bg-primary text-black mb-5" style="width:120px;">
                        <?php
                        
                        foreach ($walletCurrencies as $curr) { ?>
                            <option value="<?=$curr->code ?>" ><?=$curr->name ?></option>
                       <?php }

                        ?>
                        {{-- <option value="" >🇵🇭 PHP</option>
                        <option value="USD" >🇺🇸 USD</option>
                        <option value="EUR" >🇪🇺 EUR</option> --}}
                    </select>
                </form>
                
                <div class="row">
                    <div class="col-lg-6 col-xxl-6 d-flex">
                        <!-- Card -->
                        <div class="card border-0 flex-fill w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Title -->
                                        
                                        <h5 class="text-uppercase text-muted fw-semibold mb-2">
                                            <span class="legend-circle-sm bg-success"></span>
                                            Current Balance
                                        </h5>
                                        <!-- Subtitle -->
                                     
                                        
                                        <h2 class="mb-0" id="wallet-balance">  
                                            <?= ($walletBalance->symbol ?? '₱') . ' ' . ($walletBalance->balance ?? 0) ?>
                                        </h2> 
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32">
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
                                                <title>cash-briefcase</title>
                                                <path class="a" d="M9.75,15.937c0,.932,1.007,1.688,2.25,1.688s2.25-.756,2.25-1.688S13.243,14.25,12,14.25s-2.25-.756-2.25-1.688,1.007-1.687,2.25-1.687,2.25.755,2.25,1.687"/>
                                                <line class="a" x1="12" y1="9.75" x2="12" y2="10.875"/>
                                                <line class="a" x1="12" y1="17.625" x2="12" y2="18.75"/>
                                                <rect class="a" x="1.5" y="6.75" width="21" height="15" rx="1.5" ry="1.5"/>
                                                <path class="a" d="M15.342,3.275A1.5,1.5,0,0,0,13.919,2.25H10.081A1.5,1.5,0,0,0,8.658,3.275L7.5,6.75h9Z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <!-- / .row -->
                            </div>
                            <div class="card-footer">
                               
                                <!-- / .row -->
                            </div>
                        </div>
                    </div>

                    <!--ORDERS--->
                    <div class="col-lg-6 col-xxl-6 d-flex">
                        <!-- Card -->
                        <div class="card border-0  flex-fill w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Title -->
                                        <h5 class="text-uppercase  text-muted fw-semibold mb-2">Send Money
                                        </h5>
                                        <!-- Subtitle -->
                                        <a href="#" id="dash-send-btn">
                                            <h2 class="mb-0">Send Money
                                            </h2>
                                        </a>
                                        
                                    </div>
                                    <div class="col-auto">
                                        <!-- Icon -->
                                        <span class="text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
                                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
                                              </svg>
                                        </span>
                                    </div>
                                </div>
                                <!-- / .row -->
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <!-- Label -->

                                       <a href="">
                                         <p class="fs-6 text-muted text-uppercase mb-0">Today Transactions                                    
                                            </p>
                                            <!-- Comment -->
                                            <p class="fs-5 fw-bold mb-0">121
                                        </p>
                                    </a>
                                    </div>
                                   
                                </div>
                                <!-- / .row -->
                            </div>
                        </div>
                    </div>

                  
                </div>
            
                <div class="row">
                    <!--Recent Transactions-->
                    <div class="col-xxl-12 d-flex">
                        <!-- Card -->
                        <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "price", "quantity", "amount", {"name": "sales", "attr": "data-sales"}], "page": 5}' id="topSellingProducts">
                            <div class="card-header border-0 card-header-space-between">
                                <!-- Title -->
                                <h2 class="card-header-title h4 text-uppercase">Transactions Today
                                </h2>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle no-arrow text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                            <g>
                                                <circle cx="12" cy="3.25" r="3.25" style="fill: currentColor"/>
                                                <circle cx="12" cy="12" r="3.25" style="fill: currentColor"/>
                                                <circle cx="12" cy="20.75" r="3.25" style="fill: currentColor"/>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="javascript: void(0);" class="dropdown-item">Action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">Another action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">Something else here
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table align-middle table-edge table-nowrap mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Transaction Type
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Transaction Code
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Amount
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Fee (Optional)
                                                </a>
                                            </th>
                                            
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status
                                                </a>
                                            </th>
                                            <th>
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Date
                                                </a>
                                            </th>
                                            {{-- <th class="text-end">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                       <?php
                                        foreach ($recentTransactions as $recent) { ?>
                                          <tr>
                                            <td class="name"><?=$recent->description ?? '' ?></td>
                                            <td class="key" data-key="<?= $recent->transaction_id ?? 0?>">
                                                <div class="d-flex">
                                                    <input id="key-01" class="form-control w-350px me-3" value="<?=$recent->transaction_id?? 0 ?>" readonly>
                                                    <!-- Button -->
                                                    <button class="clipboard btn btn-link px-0" data-clipboard-target="#key-01" data-bs-toggle="tooltip" data-bs-title="Copy to clipboard">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="18" width="18">
                                                            <g>
                                                                <path d="M13.4,4.73a.24.24,0,0,0,.2.26,1.09,1.09,0,0,1,.82,1.11V7.5a1.24,1.24,0,0,0,1.25,1.24h0A1.23,1.23,0,0,0,16.91,7.5V4a1.5,1.5,0,0,0-1.49-1.5H13.69a.29.29,0,0,0-.18.07.26.26,0,0,0-.07.18C13.44,3.2,13.44,4.22,13.4,4.73Z" style="fill: currentColor"/>
                                                                <path d="M9,21.26A1.23,1.23,0,0,0,7.71,20H3.48a1.07,1.07,0,0,1-1-1.14V6.1A1.08,1.08,0,0,1,3.33,5a.25.25,0,0,0,.2-.26c0-.77,0-1.6,0-2a.25.25,0,0,0-.25-.25H1.5A1.5,1.5,0,0,0,0,4V21a1.5,1.5,0,0,0,1.49,1.5H7.71A1.24,1.24,0,0,0,9,21.26Z" style="fill: currentColor"/>
                                                                <path d="M11.94,4.47v-2a.5.5,0,0,0-.5-.49h-.76a.26.26,0,0,1-.25-.22,2,2,0,0,0-3.95,0A.25.25,0,0,1,6.23,2H5.47A.49.49,0,0,0,5,2.48v2a.49.49,0,0,0,.49.5h6A.5.5,0,0,0,11.94,4.47Z" style="fill: currentColor"/>
                                                                <path d="M19,17.27H15a.75.75,0,0,0,0,1.5h4a.75.75,0,0,0,0-1.5Z" style="fill: currentColor"/>
                                                                <path d="M14.29,14.54a.76.76,0,0,0,.75.75h2.49a.75.75,0,0,0,0-1.5H15A.76.76,0,0,0,14.29,14.54Z" style="fill: currentColor"/>
                                                                <path d="M23.5,13.46a2,2,0,0,0-.58-1.41l-1.41-1.4a2,2,0,0,0-1.41-.59H12.49a2,2,0,0,0-2,2V22a2,2,0,0,0,2,2h9a2,2,0,0,0,2-2Zm-11-.4a1,1,0,0,1,1-1h6.19a1,1,0,0,1,.71.29l.82.82a1,1,0,0,1,.29.7V21a1,1,0,0,1-1,1h-7a1,1,0,0,1-1-1Z" style="fill: currentColor"/>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td><?=$recent->amount ? $recent->amount .' ('.$recent->code.')' : 0 ?></td>
                                            <td><?=$recent->fee ?? 0 ?></td>
                                            <td class="status" data-status="Active">
                                                <span class="legend-circle <?= $recent->status === 'success' ? 'bg-success' : 'bg-danger' ?>"></span>
                                                <?=$recent->status ?? '' ?>
                                            </td>
                                            <td class="created" data-created=""><?=$recent->date_created ?></td>
                                           
                                        </tr>

                                       <?php }
                                        
                                        ?>
                                      
                                    </tbody>
                                </table>
                            </div>
                            <!-- / .table-responsive -->
                        </div>
                    </div>

                  
                </div>
                <!-- / .row -->
              
            </div>
            <!-- / .container-fluid -->

            <!--Modal---->

            <div class="modal fade sendOptionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="myLargeModalLabel">Send Options</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-5 d-flex justify-content-center align-items-center gap-5">
                                                                   
                                <button class="btn btn-primary" type="button" id="xpress-btn">Xpress Send</button>
                                                            
                                <button class="btn btn-primary" type="button" id="bank-x-btn">Bank Transfer</button>                                    
                                
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>

            <script src="{{URL::asset('assets/js/dashboard/balanceChart.js')}}"></script>
            <script>
                // Define route as a JavaScript variable
                const dashboardRoute = @json(route('user.dashboard'));
                const dashGetBalUrl = @json(route('user.wallet.balance'));
                const bankOptionUrl = @json(route('bank.options'));
            </script>
            <script src="{{URL::asset('assets/js/dashboard/dash.js')}}"></script>
 
@endsection