@extends('layouts.dash-app')

@section('title','Dashboard  | Banks')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Banks
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Banks</li>
            </ol>
        </nav>
    </div>
   
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", {"name": "key", "attr": "data-key"}, {"name": "status", "attr": "data-status"}, {"name": "created", "attr": "data-created"}], "page": 10}' id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">Banks
                        </h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search">
                        <!-- Button -->
                        <button type="button" class="btn btn-primary ms-md-4" data-bs-toggle="modal" data-bs-target=".addModal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14" class="me-1">
                                <path d="M0,12a1.5,1.5,0,0,0,1.5,1.5h8.75a.25.25,0,0,1,.25.25V22.5a1.5,1.5,0,0,0,3,0V13.75a.25.25,0,0,1,.25-.25H22.5a1.5,1.5,0,0,0,0-3H13.75a.25.25,0,0,1-.25-.25V1.5a1.5,1.5,0,0,0-3,0v8.75a.25.25,0,0,1-.25.25H1.5A1.5,1.5,0,0,0,0,12Z" style="fill: currentColor"/>
                            </svg>
                            Create New
                        
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="number">#
                                    </a>
                                </th>
                                
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" >Url
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Description
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Created
                                    </a>
                                </th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                        <?php 
                            $i = 1;
                        foreach ($Banks as $bank) {
                            ?>
                            <tr>
                                <td><?= $i ?? 0 ;?></td>
                                <td><?=$bank->name ?? '' ?></td>
                                <td><?=$bank->url ?? '' ?></td>
                                <td><?=$bank->description ?? '' ?></td>
                                <td>{{ \Carbon\Carbon::parse($bank->created_at)->format('F j, Y,  h : i A') }}</td>
                                <td>
                                    <button type="button" 
                                        id="edit-btn" 
                                        data-id="<?=$bank->id ?? 0 ?>"
                                        class="btn btn-sm btn-secondary"
                                        >Edit
                                    </button>
                                    <button type="button" 
                                        id="edit-btn-api-key" 
                                        data-id="<?=$bank->id ?? 0 ?>"
                                        class="btn btn-sm btn-success"
                                    >api key
                                </button>
                                <button type="button" 
                                        id="edit-btn-img" 
                                        data-id="<?=$bank->id ?? 0 ?>"
                                        class="btn btn-sm btn-primary"
                                    >change image
                                </button>
                                </td>
                            </tr>
                            <?php
                          $i++;  }    
                        ?>
                         
                        </tbody>
                    </table>
                </div>
                <!-- / .table-responsive -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <ul class="pagination justify-content-end list-pagination mb-0"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- / .row -->
</div>

@include('admin.bankPartners.modal.add')
@include('admin.bankPartners.modal.edit')
@include('admin.bankPartners.modal.editApi')
@include('admin.bankPartners.modal.editImg')
<script src="{{asset('assets/js/admin/bankPartners/bank.js')}}"></script>

@endSection