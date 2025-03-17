@extends('layouts.dash-app')

@section('title','Dashboard  | Fees')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Fee(s)
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Fee(s)</li>
            </ol>
        </nav>
    </div>
   
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["number", "key", "currency", "status"], "page": 10}' id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">Fee(s)</h2>
                        <!-- Search Input -->
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search">
                        <!-- Button -->
                        <button type="button" class="btn btn-primary ms-md-4" id="addBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14" class="me-1">
                                <path d="M0,12a1.5,1.5,0,0,0,1.5,1.5h8.75a.25.25,0,0,1,.25.25V22.5a1.5,1.5,0,0,0,3,0V13.75a.25.25,0,0,1,.25-.25H22.5a1.5,1.5,0,0,0,0-3H13.75a.25.25,0,0,1-.25-.25V1.5a1.5,1.5,0,0,0-3,0v8.75a.25.25,0,0,1-.25.25H1.5A1.5,1.5,0,0,0,0,12Z" style="fill: currentColor"/>
                            </svg>
                            Create new
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="number">#</a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Transaction Type</a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="currency">Currency</a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Amount</a>
                                </th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $i = 1;
                            foreach ($Fees as $fee) {
                            ?>
                                <tr>
                                    <td class="number"><?= $i ?? 0; ?></td>
                                    <td class="key" data-key="<?= $fee->transaction_type ?? '' ?>"><?= $fee->transaction_type ?? '' ?></td>
                                    <td class="currency" data-currency="<?= $fee->currency ?? '' ?>"><?= $fee->currency ?? '' ?></td>
                                    <td class="status" data-status="<?= $fee->amount ?? 0 ?>"><?= $fee->amount ?? 0 ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-secondary" id="edit-btn" data-id="<?= $fee->id ?? 0 ?>">Edit</button>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="card-footer">
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>
            </div>
            
            
        </div>
    </div>
    <!-- / .row -->
</div>
@include('admin.fees.modal.add')
@include('admin.fees.modal.edit')
<script src="{{asset('assets/js/admin/fees/fees.js')}}"></script>

@endSection