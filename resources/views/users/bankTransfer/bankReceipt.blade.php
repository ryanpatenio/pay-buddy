@extends('layouts.app')

@section('title','Bank Receipt')

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
    <div class="card border-0">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-7 col-xl-6 col-xxl-5">
                    {{-- <img src="" alt="..." class="mb-7" width="125" height="25"> --}}
                    <div>
                       <h2 class="h3">Transaction Type</h2>
                       <strong class="text-primary" id="transaction-type"> __BANK TRANSFER___</strong>
                    </div>
                </div>
                <div class="col-auto text-md-end">
                    <p class="fw-bold">
                        <img src="{{ asset('assets/img/bank_img/' . ($transactionData->bankTransactionDetail?->bankPartner?->img_url ?? '')) }}" width="95" height="95" class="img-fluid" alt="...">                         
                    </p>                
                    {{$transactionData->bankTransactionDetail->bankPartner->description ?? ''}}
                </div>
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
                                <strong class="text-primary" id="sent-to">{{$transactionData->bankTransactionDetail->receiver_name ?? ''}}</strong> | Account Name
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
                            <p class="mb-5 text-primary" id="account-number">{{
                                $transactionData->bankTransactionDetail->receiver_account_number ?? ''    
                            }}</p>
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
                            <p class="mb-5" id="transaction-date">{{ \Carbon\Carbon::parse($transactionData->created_at)->format('F j, Y, h:i A') ?? '' }}</p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-auto w-160px">
                            <p class="mb-3 mb-md-5">
                                <span class="text-secondary">Transaction Code:</span>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-5" id="transaction-code">#{{$transactionData->transaction_id ?? ''}}</p>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="col col-lg-auto text-end">
                    <span class="text-secondary mb-2">Fee (<span id="currency" class="text-primary">PHP</span>)</span>
                    <h3 class="display-5 mb-2" id="total-amount">{{$transactionData->fee ?? 0}}</h3>
                    <span class="text-secondary">Total Amount Sent (<span id="currency" class="text-primary">PHP</span>)</span>
                    <h3 class="display-2 mb-2" id="total-amount">{{$transactionData->amount + $transactionData->fee ?? 0}}</h3>
                   
                    <span class="text-secondary">status</span>
                    <br>
                    <span class="badge bg-success  fs-6 fw-bold mb-6" id="status">Success</span>
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
                    <button type="button" class="btn btn-light bg-primary">Print</button>
                    <!-- Button -->                  
                </div>
            </div>
            <!-- / .row -->
        </div>
    </div>
</div>

@endSection