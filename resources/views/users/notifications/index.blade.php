@extends('layouts.app')

@section('title','Notifications')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Notifications
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
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
                        <h2 class="card-header-title h4 text-uppercase">Notifications
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
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Message
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
                            foreach ($notifications as $notif) { ?>

                              <tr style="cursor: pointer" class="notif-row"  data-id="<?=$notif->id ?? 0 ?>" >
                                <td class="status" data-status="Active">
                                    <span class="legend-circle <?= $notif->status === 'read' ? 'bg-success' : 'bg-danger' ?>"></span>
                                    <?=$recent->status ?? '' ?>
                                </td>
                        
                                <td class="name"><?=$notif->title ?? '' ?></td>
                                
                                <td class="name"><?=$notif->message ?? '' ?></td>
                                <td class="created" data-created="1642550400"><?=$notif->created_at ?? '' ?></td>
                               
                            </tr>  
                           <?php }
                            
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
<div class="modal fade notifModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Message</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden_notif_id">
                <div class="row">
                    <div class="col">
                        <label for="" ></label>
                        <strong class="h3" id="title"></strong>
                        <hr style="margin-top: 0px">
       
                    </div>                
                </div>
                <div class="row">
                    <div class="col">
                        <span class="h4" id="msg">
                           
                        </span>
                    </div>
                </div>
                <hr style="margin-bottom:0px;">
                <div class="row">
                    <div class="col">
                        <label for="">Date : </label>
                        <strong id="date"></strong>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="mark-as-read-btn" class="btn btn-primary">mark as read </button >
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >                   
               </div >
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/notifications/notif.js')}}"></script>


@endsection