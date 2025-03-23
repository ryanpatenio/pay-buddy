@extends('layouts.dash-app')

@section('title','Dashboard  | Logs')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Api Logs
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Api Logs</li>
            </ol>
        </nav>
    </div>
   
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["number","name", 
                    {"name": "key", "attr": "data-key"},
                     {"name": "status", "attr": "data-status"},
                      {"name": "created", "attr": "data-created"}], "page": 10}' id="keysTable">

                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">Api Logs
                        </h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search">
                        <!-- Button -->
                       
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
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Api Key
                                    </a>
                                </th>
                               
                               
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="created">Requested at
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status
                                    </a>
                                </th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                               $i = 1;
                               foreach ($logs as $log) { ?>
                                <tr>
                                    <td><?=$i ?? 0; ?></td>
                                    <td class="name">
                                       <?=$log->name ?? '' ?>
                                    </td>
                                    <td class="key" data-key="<?=$log->api_key ?? '' ?>">
                                        <div class="d-flex">
                                            <input id="key-01" class="form-control w-350px me-3" value="<?=$log->api_key ?? '' ?>">
                                            <!-- Button -->
                                            <button class="clipboard btn btn-link px-0" data-clipboard-target="#key-01" data-bs-toggle="tooltip" data-bs-title="Copy to clipboard">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="18" width="18">
                                                    <g>
                                                        <path d="M13.4,4.73a.24.24,0,0,0,.2.26,1.09,1.09,0,0,1,.82,1.11V7.5a1.24,1.24,0,0,0,1.25,1.24h0A1.23,1.23,0,0,0,16.91,7.5V4a1.5,1.5,0,0,0-1.49-1.5H13.69a.29.29,0,0,0-.18.07.26.26,0,0,0-.07.18C13.44,3.2,13.44,4.22,13.4,4.73Z" style="fill: currentColor"/>
                                                        <path d="M9,21.26A1.23,1.23,0,0,0,7.71,20H3.48a1.07,1.07,0,0,1-1-1.14V6.1A1.08,1.08,0,0,1,3.33,5a.25.25,0,0,0,.2-.26c0-.77,0-1.6,0-2a.25.25,0,0,0-.25-.25H1.5A1.5,1.5,0,0,0,0,4V21a1.5,1.5,0,0,0,1.49,1.5H7.71A1.24,1.24,0,0,0,9,21.26Z" style="fill: currentColor"/>
                                                        <path d="M11.94,4.47v-2a.5.5,0,0,0-.5-.49h-.76a.26.26,0,0,1-.25-.22,2,2,0,0,0-3.95,0A.25.25,0,0,1,6.23,2H5.47A.49.49,0,0,0,5,2.48v2a.49.49,0,0,0,.49.5h6A.5.5,0,0,0,11.94,4.47Z" style="fill: currentColor"/>
                                                        <path d="M19,17.27H15a.75.75,0,0,0,0,1.5h4a.75.75,0,0,0,0-1.5Z" style="fill: currentColor"/>
                                                        <path d="M14.29,14.54a.76.76,0,0,0,.75.75h2.49a.75.75,0,0,0,0-1.5H15A.76.76,0,0,0,14.29,14.54Z" style="fill: currentColor"/>
                                                        <path d="M23.5,13.46a2,2,0,0,0-.58-1.41l-1.41-1.4a2,2,0,0,0-1.41-.59H12.49a2,2,0,0,0-2,2V22a2,2,0,0,0,2,2h9a2,2,0,0,0,2-2Zm-11-.4a1,1,0,0,1,1-1h6.19a1,1,0,0,1,.71.29l.82.82a1,1,0,0,1,.29.7V21a1,1,0,0,1-1,1h-7a1,1,0,0,1-1-1Z" style="fill: currentColor"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                   
                                    <td class="created" data-created="<?= $log->created_at ?? 0?>"><?=$log->created_at ?? 0 ?></td>
                                    <td class="status" data-status="<?=$log->status ?? '' ?>">
                                        <span class="legend-circle <?=$log->status ==='success' ? 'bg-success' : 'bg-danger'  ?>"></span>
                                        <?=$log->status ?? '' ?>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown float-end">
                                            <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                                    <g>
                                                        <circle cx="12" cy="3.25" r="3.25" style="fill: currentColor"/>
                                                        <circle cx="12" cy="12" r="3.25" style="fill: currentColor"/>
                                                        <circle cx="12" cy="20.75" r="3.25" style="fill: currentColor"/>
                                                    </g>
                                                </svg>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('get.user',$log->user_id)}}">View
                                                    </a>
                                                </li>
                                              
                                                                                       
                                            </ul>
                                        </div>
                                    </td>
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
<div class="modal fade viewLogModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Logs Details</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row mb-2" style="margin-top: -25px">
                    <div class="col">
                       <label for="">Name : </label>
                       <strong>Ryan Wong</strong>
                    </div>
                    <div class="col">
                        <label for="">Api Key : </label>
                        <strong>324354930as4349</strong>
                     </div>
                     <div class="col">
                        <label for="">IP address : </label>
                        <strong>3499.34.</strong>
                     </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                       
                        <label for="">Action : </label>
                        <textarea name="action" class="form-control" id="" cols="30" rows="10">
                        </textarea>
                        
                    </div>
                    <div class="col">
                       
                            <label for="">Request : </label>
                            <textarea name="request" class="form-control" id="" cols="30" rows="10">

                            </textarea>
                         
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                       
                            <label for="">Response : </label>
                            <textarea name="response" class="form-control"id="" cols="30" rows="10" style="height: 120px;">

                            </textarea>
                        
                    </div>
              
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <label for="">Date : </label>
                        <strong> January 5, 2025</strong>
                    </div>
                </div>
                
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    
               </div >
            </div>
        </div>
    </div>
</div>

@endSection