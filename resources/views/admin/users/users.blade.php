@extends('layouts.dash-app')

@section('title','Dashboard  | Users')

@section('content')


<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Users
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
   
    <div class="row">
        <div class="col d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100"
             data-list=
             '{
                "valueNames": [
                    "num",
                    {"name": "name", "attr": "data-name"},
                    "role", 
                    {"name": "status", "attr": "data-status"}, 
                    {"name": "created", "attr": "data-created"}
                ],
                "page": 10,
                "fuzzySearch": {
                    "searchClass": "list-fuzzy-search",
                    "location": 0,
                    "distance": 100,
                    "threshold": 0.4,
                    "multiSearch": true
                }
             }' 
              id="keysTable">
                <div class="card-header border-0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-end">
                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">Users
                        </h2>
                        <input class="form-control list-fuzzy-search mw-md-300px ms-md-auto mt-5 mt-md-0 mb-3 mb-md-0" type="search" placeholder="Search">
                        <!-- Button -->
                        <button type="button" class="btn btn-primary ms-md-4" data-bs-toggle="modal" data-bs-target=".userModal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14" class="me-1">
                                <path d="M0,12a1.5,1.5,0,0,0,1.5,1.5h8.75a.25.25,0,0,1,.25.25V22.5a1.5,1.5,0,0,0,3,0V13.75a.25.25,0,0,1,.25-.25H22.5a1.5,1.5,0,0,0,0-3H13.75a.25.25,0,0,1-.25-.25V1.5a1.5,1.5,0,0,0-3,0v8.75a.25.25,0,0,1-.25.25H1.5A1.5,1.5,0,0,0,0,12Z" style="fill: currentColor"/>
                            </svg>
                            Create Users
                        
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="num">#
                                    </a>
                                </th>
                                
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="role" >Role
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
                            $i =1 ;
                            foreach ($users as $user) { ?>
                              <tr>   
                                <td class="num" data-num="<?=$i ?? 0 ?>"><?=$i ?? 0 ?></td>                           
                                <td class="name" data-name="<?=$user->name ?? '' ?>">
                                   <?=$user->name ?? '' ?>
                                </td>
                                <td class="role" data-role=" <?=$user->role ?? '' ?>">
                                    <?=$user->role ?? '' ?>
                                 </td>
                                <td class="status" data-status="<?=$user->user_status ?? '' ?>">
                                    <span class="legend-circle <?=$user->status == "0" ? 'bg-success' : 'bg-danger' ?>"></span>
                                    <?=$user->user_status ?? '' ?>
                                </td>
                                <td class="created" data-created="<?=$user->date_created ?? '' ?>"><?=$user->date_created ?? '' ?></td>
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
                                                <a class="dropdown-item" href="/Dashboard-viewUser?user_id=<?=$user->id ?? 0 ?>">View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-name="<?=$user->name ?? '' ?>" id="action-status-btn" data-id="<?=$user->id ?? 0 ?>" data-status= <?= $user->user_status === "deactivated" ? 'enable' : 'disable' ?> href="javascript: void(0);"><?= $user->user_status === "deactivated" ? 'enable' : 'Disable' ?>
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
<div class="modal fade userModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Create</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="userForm">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" class="form-control"  placeholder="Name" name="name" required>
                    </div>
                    <div class="col">
                        <label for="">Email | Username</label>
                        <input type="email" class="form-control"  placeholder="Email"  name="email" required>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password"  required>
                    </div>
                    <div class="col">
                        <label for="">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                      </div>
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    <button type="submit" class="btn btn-primary">Save </button >
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/admin/users/user.js')}}"></script>

@endSection