@extends('layouts.app')

@section('title','Requests')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Request
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Requests</li>
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
                        <h2 class="card-header-title h4 text-uppercase">Requests 
                            <button class="btn btn-primary btn-sm" id="newRequestBtn"> + New request</button>
                        </h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search in keys">
                        <!-- Button -->
                       
                    </div>
                    
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">#
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Request
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Status
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Date
                                    </a>
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $i = 1;
                            foreach ($requests as $req) { ?>
                               <tr>
                                <td class="name"><?=$i; ?></td>
                                <td class="key"><?=$req->message ?? '' ?></td>
                                
                                <td class="status">
                                    <span class="legend-circle 
                                            <?= $req->status === 'success' ? 'bg-success' : ($req->status === 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                                           
                                    </span> 
                                    <?=$req->status ?? '' ?>
                                </td>
                                <td><?=$req->date_created ?? '' ?></td>
                               
                            </tr>
                               
                          <?php  $i++;}    
                                
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
<div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createKeyModalTitle" aria-hidden="true">
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
                        <label for="name" class="form-label">API key name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        
                    </div>
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
<script src="{{asset('assets/js/request/request.js')}}"></script>

@endsection