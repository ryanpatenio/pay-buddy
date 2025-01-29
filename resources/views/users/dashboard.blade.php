
@extends('layouts.app')

@section('content')
            <div class="container-fluid">
                <!-- Title -->
                <h1 class="h2">My Wallet
                </h1>
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
                                        
                                        <h2 class="mb-0">₱ 6,328
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
                                        <a href="">
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
                                <h2 class="card-header-title h4 text-uppercase">Recent Transactions
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
                                            </th>
                                            
                                            <th class="text-end">
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="amount">Amount
                                                </a>
                                            </th>
                                            <th class="text-end pe-7 min-w-200px">
                                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="sales">Date
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr>
                                            <td class="name fw-bold">Send Money</td>
                                            <td class="price text-end">$599</td>
                                         
                                            <td class="amount text-end">January 1 2025</td>
                                           
                                        </tr>
                                      
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
       
@endsection