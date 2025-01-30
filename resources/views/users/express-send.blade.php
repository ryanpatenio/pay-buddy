@extends('layouts.app')

@section('title','Create Receipt')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Express Send
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Receipt</li>
            </ol>
        </nav>
    </div>

    <div class="col-lg-12 col-xxl-12 d-flex">
        <!-- Card -->
        <div class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <label for=""> Account Number</label>
                        <input type="text" class="form-control" name="account_number" id="account-number" required placeholder="Account Number">
                    </div>
                    <div class="col">
                        <label for=""> Account Name</label>
                        <input type="text" class="form-control" name="account_name" id="account-name" required placeholder="Account Name">
                    </div>
                </div>
                <hr>
               
                <div class="row mb-5">
                    <div class="col">
                        <label for="">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount-to-send" required placeholder="Amount">
                    </div>
                </div>
                <!-- / .row -->
            </div>
            <div class="card-footer">
            <div class="row">
                <div class="alert text-bg-danger-soft d-flex align-items-center" role="alert">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32" class="me-3">
                            <path d="M23.39,10.53,13.46.6a2.07,2.07,0,0,0-2.92,0L.61,10.54a2.06,2.06,0,0,0,0,2.92h0l9.93,9.92A2,2,0,0,0,12,24a2.07,2.07,0,0,0,1.47-.61l9.92-9.92A2.08,2.08,0,0,0,23.39,10.53ZM11,6.42a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h0a1.54,1.54,0,0,1-1.52-1.47A1.47,1.47,0,0,1,12,14.93h0A1.53,1.53,0,0,1,13.5,16.4,1.48,1.48,0,0,1,12.05,17.93Z" style="fill: currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="mb-0">Confirm transactions <strong>will not be refunded.</strong>
                            Please make sure that the account number and amount are correct.
                    
                    </div>
                
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <!-- Input -->
                        <input type="checkbox" class="form-check-input" id="">
                        <!-- Label -->
                        <label class="form-check-label" for="deleteAccount">I confirm that details are correct.
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <!-- Button -->
                    <button type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
                
            </div>
        </div>
    </div>

</div>

@endsection