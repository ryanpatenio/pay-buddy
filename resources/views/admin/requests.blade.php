@extends('layouts.dash-app')

@section('title','Dashboard | Requests')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Requests
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Users Request</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name","request", {"name": "status", "attr": "data-status"}, {"name": "created", "attr": "data-created"}], "page": 10}' id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">Requests
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
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="">#
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="request">Requests
                                    </a>
                                </th>
                                
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Date
                                    </a>
                                </th>
                                {{-- <th class="text-end">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $i = 1;
                            foreach ($requests as $req) { ?>

                                 <tr style="cursor: pointer" class="requestedRow" data-name="<?=$req->name ?? '' ?>" data-id="<?= $req->request_id ?? 0 ?>">
                                    <td><?=$i ?? 0 ?></td>
                                    <td class="name" data-name="<?=$req->name ?? '' ?>"><?=$req->name ?? '' ?></td>
                                    <td class="request" data-request="<?= $req->message ?? '' ?>" >
                                        <?= $req->message ?? '' ?>
                                    </td>
                                    <td class="status" data-status="<?= $req->status ?? '' ?>">
                                        <span class="legend-circle 
                                        <?= $req->status === "approved" ? 'bg-success' : ($req->status === "pending" ? 'bg-warning' : 'bg-danger')  ?>
                                       "></span>
                                        <?= $req->status ?? '' ?>
                                    </td>
                                    <td class="created" data-created="<?=$req->date_created ?? '' ?>"><?=$req->date_created ?? '' ?></td>
                                   
                                </tr>
                           <?php $i++; }

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
<!-- Modal --->
<div class="modal fade approveModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Request?</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="requestForm">
                    @csrf
                    <input type="hidden" id="hidden_u_id" name="hidden_u_id">
                    <input type="hidden" id="hidden_req_id" name="hidden_req_id">
                    <div class="row mb-5">
                        <div class="col">
                            <label for="">Name: </label>
                            <input type="text" class="form-control" name="name" id="name" readonly>
                        </div>                       
                    </div>
                    <div class="row">
                        <p class="m3" id="message"></p>
                    </div>
                                       
                    <div class="modal-footer d-flex align-items-center justify-content-center">
                       
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                        <button type="button" id="approve-btn" class="btn btn-primary">Approve </button >
                        <button type="button" id="decline-btn" class="btn btn-danger">Decline </button >
                   </div >
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/admin/requests/req.js')}}"></script>

@endSection