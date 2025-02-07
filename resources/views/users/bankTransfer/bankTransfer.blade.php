@extends('layouts.app')

@section('title','Bank Transfer')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Bank Transfer
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Bank Transfer</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xxl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Title -->
                            
                            <h5 class="text-uppercase text-muted fw-semibold mb-2">
                                <span class="legend-circle-sm bg-success"></span>
                                Available Balance
                            </h5>
                            <!-- Subtitle -->
                         
                            
                            <h2 class="mb-0" class=""  id="wallet-balance"> ₱ <?=$userWalletBalance ?? 0 ?>
                                
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

      
    </div>

    <div class="col-lg-12 col-xxl-12 d-flex">
        <!-- Card -->
        <div class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex align-items-center justify-between">
                        <img class="img-fluid" id="bank-img" width="80" alt="..." src="" >
                        <span class="ms-4" id="bank-description"> </span>
                    </div>
                </div>
                <hr>

            <form action="" id="bank-transfer-form">
                <input type="hidden" id="hidden-balance" value="<?=$userWalletBalance ?? 0 ?>"><!--500 example wallet Balance--->
                @csrf
                <div class="row mb-2">
                    <div class="col">
                        <label for="" class="mb-2"> Account Number</label>
                        <input type="text" class="form-control" maxlength="12" name="account_number" id="account-number" required placeholder="Account Number">
                        <span class="text-danger px-2 mt-2" role="alert">
                            <strong id="acct-error"></strong>
                        </span>
                    </div>
                   
                    <div class="col">
                        <label for="" class="mb-2"> Account Name</label>
                        <input type="text" class="form-control" name="account_name" id="account-name" required placeholder="Account Name" required>
                    </div>
                </div>
                <hr>
               
                <div class="row mb-5">
                    <div class="col">
                        <label for="" class="mb-2 text-primary">Amount |  <strong>Currency: <strong class="text-primary" id="curr">PHP</strong></strong></label>
                        <input type="text" class="form-control" name="amount" id="amount-to-send" required placeholder="Amount">
                    </div>
                    <div class="col">
                        <label for="" class="mb-2 text-primary">Fee (s)</label>
                        <input type="text" class="form-control" id="fee" name="fee" id="transaction-fee" value="<?=$transactionFee ?? 0 ?>" required placeholder="Fee" readonly>
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
                        <input type="checkbox" class="form-check-input" id="" required>
                        <!-- Label -->
                        <label class="form-check-label" for="deleteAccount">I confirm that details are correct.
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <!-- Button -->
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
            </div>
                
            </div>
        </div>
    </div>
</div>
<script>
     //const dashboardRoute = @json(route('user.dashboard'));
</script>
<script src="{{asset('assets/js/bankT/bankT.js')}}"></script>



@endsection