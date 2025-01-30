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
                            <tr style="cursor: pointer" data-bs-toggle="modal" data-bs-target=".notifModal">
                        
                                <td class="name">Pay Buddy</td>
                                
                                <td class="name">Lorem ipsum dolor sit amet...</td>
                                <td class="created" data-created="1642550400">01.19.22</td>
                               
                            </tr>

                           
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
                <div class="row">
                    <div class="col">
                        <label for="" class="h4">Name :  </label>
                        <strong>Pay Buddy</strong>
                        <hr style="margin-top: -16px">
       
                    </div>                
                </div>
                <div class="row">
                    <div class="col">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti iure maiores ex quod error, laboriosam est accusantium facere, esse aliquid a odio officiis consequatur ducimus eveniet laudantium, incidunt alias recusandae?
                    </div>
                </div>
                <hr>
                <div class="row">
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


@endsection