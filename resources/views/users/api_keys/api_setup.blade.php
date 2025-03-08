@extends('layouts.app')

@section('title','Api Set up')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">API Keys
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">API Keys </li>
            </ol>
        </nav>
    </div>
    

    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card w-100 border-0 scroll-mt-3" id="">
                <div class="card-header">
                    <h2 class="h3 mb-0">Credit & Debit Transactions</h2>
                </div>
                <div class="card-body">
                    <form id="form-user-email" method="POST">
                        @csrf
                    <div class="row mb-6">
                        <div class="col-lg-2">
                            <label for="username" class="h3">Payload</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="http://pay-buddy.test/api/credit">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="http://pay-buddy.test/api/debit">
                            </div>
                            <div class="input-group mb-3">
                                <textarea name="" class="form-control" id="" cols="30" rows="4">
                                    headers: {
                                        "X-API-Key": "YOUR_SECRET_API_KEY",  //replace this with your api key
                                        "Content-Type": "application/json"
                                    },
                                </textarea>
                            </div>
                            <div class="input-group">                           
                                <textarea name="" id="" class="form-control" cols="70" rows="5">
                                    {
                                        "currency":"PHP",
                                        "amount"  : 200,
                                        "client_ref" : "Xtslf23" //replace this with your client_ref
                                    }
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-2">                           
                            <label for="" class="h3">Response</label>                                               
                        </div>
                        <div class="col-lg-9">
                           <div class="input-group mb-3">
                            <textarea name="" class="form-control" id="" cols="30" rows="20">
                                {
                                    "code": "EXIT_SUCCESS",
                                    "message": "ok",
                                    "data": {
                                        "transaction_id": "TXN-1741422237-coKzjxbZ",
                                        "currency": "PHP",
                                        "client_ref_id": "xslits",
                                        "type": "credit",
                                        "fee": "0",
                                        "description": "Credit, Transaction made via External Api",
                                        "amount": 50,
                                        "updatedBalance": {
                                            "user_id": 2,
                                            "account_number": "30684386840",
                                            "newBalance": "498.00",
                                            "transaction_date": "2025-03-08T08:23:57.000000Z"
                                        },
                                        "status": "success"
                                    }
                                }
                            </textarea>
                           </div>
                        </div>
                    </div>
                    <!-- / .row -->
                   
                </form>
                </div>
            </div>           
        </div>      
    </div>

    <div class="row">
        <div class="col d-flex">
            <div class="card w-100 border-0 scroll-mt-3">
                <div class="card-header">
                    <h2 class="h2">Check Balance</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="" class="h3">Payload</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="http://pay-buddy.test/api/check-balance">
                            </div>
                            <div class="input-group mb-2">
                                <textarea name="" class="form-control" id="" cols="30" rows="5">
                                    headers: {
                                        "X-API-Key": "YOUR_SECRET_API_KEY",  //replace this with your api key
                                        "Content-Type": "application/json"
                                    }
                                </textarea>
                            </div>
                            <div class="input-group mb-2">
                                <textarea name="" class="form-control" id="" cols="30" rows="5">
                                    {
                                        "currency":"USD"   //data to  be send
                                    }
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label for="" class="h3">Response</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group mb-2">
                                <textarea name="" class="form-control" id="" cols="30" rows="8">
                                    {
                                        "code": "EXIT_SUCCESS",
                                        "message": "ok",
                                        "data": {
                                            "balance": "50.00"
                                        }
                                    }
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex">
            <div class="card w-100 border-0 scroll-mt-3">
                <div class="card-header">
                    <h2 class="h3 mb-0">Get Transactions</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="" class="h3">Payload</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="http://pay-buddy.test/api/userTransactions">
                            </div>
                            <div class="input-group mb-2">
                                <textarea name="" class="form-control" id="" cols="30" rows="5">
                                    headers: {
                                        "X-API-Key": "YOUR_SECRET_API_KEY",  //replace this with your api key
                                        "Content-Type": "application/json"
                                    }
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="" class="h3">Response</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea name="" class="form-control" id="" cols="30" rows="10">
                                {
                                    "code": "EXIT_SUCCESS",
                                    "message": "Transaction retrieved successfully",
                                    "data": [
                                        {
                                            "transaction_id": "TXN-1741422581-a2NXIgcU",
                                            "description": "Credit, Transaction made via External Api",
                                            "status": "success",
                                            "amount": "50.00",
                                            "fee": "0.00",
                                            "created_at": "2025-03-08 08:29:41",
                                            "code": "USD",
                                            "client_ref_id": "xslits",
                                            "date_created": "March 8, 2025 8:29 AM"
                                        },
                                        {
                                            "transaction_id": "TXN-1741422237-coKzjxbZ",
                                            "description": "Credit, Transaction made via External Api",
                                            "status": "success",
                                            "amount": "50.00",
                                            "fee": "0.00",
                                            "created_at": "2025-03-08 08:23:57",
                                            "code": "PHP",
                                            "client_ref_id": "xslits",
                                            "date_created": "March 8, 2025 8:23 AM"
                                        },
                                        {
                                            "transaction_id": "TXN-1741338899-JHHmhS2P",
                                            "description": "Debit, Transaction made via External Api",
                                            "status": "success",
                                            "amount": "20.00",
                                            "fee": "15.00",
                                            "created_at": "2025-03-07 09:14:59",
                                            "code": "PHP",
                                            "client_ref_id": "Xlients-stss",
                                            "date_created": "March 7, 2025 9:14 AM"
                                        },
                                        {
                                            "transaction_id": "TXN-1741337533-m9JCptsc",
                                            "description": "Debit, Transaction made via External Api",
                                            "status": "success",
                                            "amount": "2.00",
                                            "fee": "15.00",
                                            "created_at": "2025-03-07 08:52:13",
                                            "code": "PHP",
                                            "client_ref_id": "Xlients-sts",
                                            "date_created": "March 7, 2025 8:52 AM"
                                        }
                                    ]
                                }
                            </textarea>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-end mt-5">
                        <!-- Button -->
                        <button type="submit" class="btn btn-primary">Test Api Connectivity</button>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
    <!-- / .row -->
</div>

<div class="modal fade" id="createKeyModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createKeyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" id="keyForm" >
                @csrf
                <!-- Header -->
                <div class="modal-header pb-0">
                    <h3 id="createKeyModalTitle" class="modal-title">New API key</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->
                <!-- Body -->
                <div class="modal-body">
                  
                    <div class="mb-3">
                        <label for="key" class="form-label">API key</label>
                        <input type="text" name="genKey" class="form-control" id="key" value="" readonly>
                    </div>
                </div>
                <!-- End Body -->
                <!-- Footer -->
                <div class="modal-footer pt-0">
                    <!-- Button -->
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <!-- Button -->
                    <button type="submit" class="btn btn-primary">Save API Key</button>
                </div>
                <!-- End Footer -->
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="displayKeyModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createKeyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header pb-0">

                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <h3>Here's your API Key</h3>
                    </div>
            
                    <div class="d-flex justify-content-center align-items-center">
                        <input id="key-01" class="form-control w-350px me-3" value="">
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
                </div>
            </div>
        
            <!-- Footer -->
            <div class="modal-footer pt-0">
                <!-- Cancel Button -->
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/key/key.js')}}"></script>

@endSection