@extends('layouts.dash-app')

@section('title','Dashboard  | Api Keys')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Users Api Keys
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Users Api Keys</li>
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
                        <h2 class="card-header-title h4 text-uppercase">Api Keys
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
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">#
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Api Key
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" >Role
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status
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
                        foreach ($apiUsers as $user) { ?>
                          <tr>
                            <td><?=$i ?? 0 ?></td>
                            <td>
                               <?=$user->name ?? '' ?>
                            </td>
                            <td class="key" data-key="">
                                <div class="d-flex">
                                    <input id="key-01" class="form-control w-350px me-3" value="<?=$user->api_key ?? '' ?>">
                                    <!-- Button -->
                                </div>
                            </td>
                            <td>
                               <?=$user->role ?? '' ?>
                             </td>
                            <td class="status" data-status="Active">
                                <span class="legend-circle <?=$user->status === "active" ? "bg-success": "bg-danger" ?>"></span>
                                <?=$user->status ?? '' ?>
                            </td>
                            <td class="created" data-created="<?=$user->created_at ?? '' ?>"><?=$user->date_created ?? '' ?></td>
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
                                            {{-- api key _id --}}
                                            <a class="dropdown-item" id="disabled-btn" data-status ="<?=$user->status === "active" ? "Disable" : "Enable" ?>" data-name="<?=$user->name ?? '' ?>" data-id="<?=$user->id ?? 0 ?>" href="javascript: void(0);">
                                                <?=$user->status === "active" ? "Disable" : "Enable" ?>
                                               
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
<script src="{{asset('assets/js/admin/keys/key.js')}}"></script>

@endsection