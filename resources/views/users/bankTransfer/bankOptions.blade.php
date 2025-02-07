@extends('layouts.app')

@section('title','Bank Transfer')

@section('content')
<script>
    //const bankProcessUrl = @json(route('bank.transfer'));
</script>

<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Bank Transfer
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Bank Partners</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        
        <div class="col">
            <div class="tab-content" id="wizard-tabContent">
                <div class="tab-pane fade show active" id="wizardStepOneSelected" role="tabpanel" aria-labelledby="wizardTabOneSelected">
                    <div class="card min-h-600px">
                        <div class="card-body px-6 pb-0">
                            <h3>Choose Bank</h3>
                            <div class="row">
                                <?php
                                foreach ($bankPartners as $bank) { ?>
                                     <div class="col-sm-6 col-xxl-4">
                                        <div class="form-check form-state-switch w-100">
                                            <input class="form-state-input" type="radio" name="platforms" id="connection1">
                                            <label class="form-state-label w-100" for="connection1">
                                                <span class="">
                                                    <!-- Button -->
                                                    <span class="card shadow-sm">
                                                        <span class="card-body">
                                                            <span class="d-flex justify-content-between">
                                                                <span class="d-flex align-items-center">
                                                                    <span class="avatar avatar-lg text-bg-gray-300 d-flex align-items-center justify-content-center">
                                                                        <img src="{{asset('assets/img/bank_img')}}<?= '/'.$bank->img_url ?>" class="img-fluid" width="42" alt="...">
                                                                    </span>
                                                                    <span class="ms-4">
                                                                        <span class="h3 card-title mb-0"><?=$bank->name?? '' ?></span>
                                                                        <br>
                                                                       
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                        <span class="card-footer p-0">
                                                            <!-- Button -->
                                                            <span id="selectedBank" data-id="<?= $bank->name?? ''?>" class="btn text-bg-light link-secondary d-flex align-items-center justify-content-center rounded-0 rounded-bottom">Select
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>
                                                
                                            </label>
                                        </div>
                                    </div>

                               <?php }    
                                    
                                ?>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <!-- Button -->
                                <a class="btn btn-primary" data-toggle="wizard" href="#wizardStepTwoSelected">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>

    </div>
</div>
<script>
     $(document).on('click','#selectedBank',function(e){
        e.preventDefault();

        let bankSelected = $(this).attr('data-id');

        window.location.href = '/Bank-Transfer-process?bankCode='+bankSelected;

    });
</script>


@endsection