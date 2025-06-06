@extends('layouts.app')

@section('title','Receipt')

@section('content')

<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2 d-flex">Receipt
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Receipt</li>
            </ol>
        </nav>
    </div>
    <!-- Card -->
    <div class="card border-0" id="capture-area">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-7 col-xl-6 col-xxl-5">
                    {{-- <img src="" alt="..." class="mb-7" width="125" height="25"> --}}
                    <div>
                       <h2 class="h3">Transaction Type</h2>
                       <strong class="text-primary" id="transactio-type"> __SEND MONEY___</strong>
                    </div>
                </div>
                {{-- <div class="col-auto text-md-end">
                    <p class="fw-bold">
                        Dashly Limited<br>
                        52 West Ketch Road<br>
                        Orlando, FL 32812<br>United States
                    </p>
                    <img src="./assets/images/printscreens/qr.svg" width="95" height="95" class="img-fluid" alt="...">
                </div> --}}
            </div>
            <!-- / .row -->
            <!-- Divider -->
            <hr>
            <div class="row justify-content-between">
                <div class="col col-lg-auto fw-semibold mb-5">
                    <div class="row">
                        <div class="col-auto w-150px">
                            <p class="mb-3 mb-md-5">
                                <span class="text-secondary"> Sent To:</span>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-3">
                                <strong class="text-primary" id="sent-to">Ryan Wong</strong> | Account Name
                            </p>
                            <p class="mb-5">
                               
                            </p>
                        </div>
                    </div>
                    <!-- / .row -->
                    <div class="row">
                        <div class="col-auto w-150px">
                            <p class="mb-3 mb-md-5">
                                <span class="text-secondary" >Account Number:</span>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-5 text-primary" id="account-number">5345084395</p>
                        </div>
                    </div>
                    <!-- / .row -->
                    <!-- / .row -->
                    <div class="row">
                        <div class="col-auto w-150px">
                            <p class="mb-3 mb-md-5">
                                <span class="text-secondary">Transaction Date:</span>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-5" id="transaction-date">06/03/2022</p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-auto w-150px">
                            <p class="mb-3 mb-md-5">
                                <span class="text-secondary">Transction Code:</span>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-5" id="transaction-code">#PO-AC-002931</p>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="col col-lg-auto text-end">
                    <span class="text-secondary">Total Amount Sent (<span id="currency" class="text-primary">PHP</span>)</span>
                    <h3 class="display-2 mb-2" id="total-amount">2000</h3>
                   
                    <span class="text-secondary">status</span>
                    <br>
                    <span class="badge  fs-6 fw-bold mb-6" id="status">Success</span>
                </div>
            </div>
            <!-- / .row -->
          
            <!-- / .row -->
        </div>
        <div class="card-footer">
            <div class="row align-items-end">
                <div class="col mb-5 mb-md-0">
                    <small class="text-secondary">If you have any questions, please let us know.</small>
                </div>
                <div class="col-md-auto">
                    <!-- Button -->
                    <button type="button" id="screenshotBtn" class="btn btn-light bg-primary">Save</button>
                    <!-- Button -->                  
                </div>
            </div>
            <!-- / .row -->
        </div>
    </div>
</div>
<script src="{{asset('assets/js/xpress/receipt.js')}}"></script>
<script src="{{asset('assets/js/html2/html2canvas.min.js')}}"></script>
<script>
document.getElementById('screenshotBtn').addEventListener('click', function() {
  const element = document.getElementById('capture-area');
  const randomNum = Math.floor(Math.random() * 10000);

  html2canvas(element, {
    useCORS: true,     // Try to load securely first
    allowTaint: true,  // Fallback for local HTTP
    logging: false,    // Silence internal logs
  }).then(canvas => {
    const link = document.createElement('a');
    link.download = `screenshot-${randomNum}.png`;
    link.href = canvas.toDataURL('image/png');
    link.click();
  });
});
</script>

@endSection