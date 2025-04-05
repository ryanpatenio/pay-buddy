@extends('layouts.dash-app')

@section('title','Profile | Account')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Account Details
        </h1>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 col-xxl-3">
            <!-- Card -->
            <div class="card border-0 sticky-md-top top-10px">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <div class="avatar avatar-xxl avatar-circle mb-5">
                            <label class="d-block cursor-pointer">
                                <span class="position-absolute bottom-0 end-0 m-0 text-bg-primary w-30px h-30px rounded-circle d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                        <g>
                                            <path d="M2.65,16.4a.5.5,0,0,0-.49-.13.52.52,0,0,0-.35.38L.39,23a.51.51,0,0,0,.6.6l6.36-1.42a.52.52,0,0,0,.38-.35.5.5,0,0,0-.13-.49Z" style="fill: currentColor"/>
                                            <path d="M17.85,7.21l-11,11a.24.24,0,0,0,0,.35l1.77,1.77a.5.5,0,0,0,.71,0L20,9.68A.48.48,0,0,0,20,9L18.21,7.21A.25.25,0,0,0,17.85,7.21Z" style="fill: currentColor"/>
                                            <path d="M16.79,5.79,15,4a.48.48,0,0,0-.7,0L3.71,14.63a.51.51,0,0,0,0,.71l1.77,1.77a.24.24,0,0,0,.35,0l11-11A.25.25,0,0,0,16.79,5.79Z" style="fill: currentColor"/>
                                            <path d="M22.45,1.55a4,4,0,0,0-5.66,0l-.71.71a.51.51,0,0,0,0,.71l5,4.95a.52.52,0,0,0,.71,0l.71-.71A4,4,0,0,0,22.45,1.55Z" style="fill: currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                                <form action="" enctype="multipart/form-data" method="POST">
                                    <input type="file" name="avatar" id="avatar-input" class="d-none">
                                </form>
                                
                            </label>
                            <?php
                            $avatar_img = $avatar ? 'storage/'.$avatar : 'assets/img/avatar/default.jpg';
                            
                            ?>
                            <img src="{{asset($avatar_img)}}" alt="Profile picture" class="avatar-img" width="112" height="112">
                            <div class="loading-indicator">Loading...</div>
                            <button id="save-button" class="btn btn-primary mt-3 mb-5" style="display: none;">Save</button>
                        </div>
                        

                        <h3 class="mb-0" id="side-name"></h3>
                        <span class="small text-secondary fw-semibold" id="role">Admin</span>
                    </div>
                    <!-- Divider -->
                    <hr class="mb-0">
                </div>
                <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>
                    <li class="active">
                        <a href="#basicInformationSection" class="d-flex align-items-center py-3">
                            <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.750 6.000 A5.250 5.250 0 1 0 17.250 6.000 A5.250 5.250 0 1 0 6.750 6.000 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M2.25,23.25a9.75,9.75,0,0,1,19.5,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                            Basic information
                        
                        </a>
                    </li>
                    <li>
                        <a href="#usernameSection" class="d-flex align-items-center py-3">
                            <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.25,12A5.25,5.25,0,1,1,12,6.75,5.25,5.25,0,0,1,17.25,12Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M17.25,12v2.25a3,3,0,0,0,6,0V12a11.249,11.249,0,1,0-4.5,9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                            Username
                        
                        </a>
                    </li>
                    <li>
                        <a href="#passwordSection" class="d-flex align-items-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="14" width="14" class="me-3">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.75 9.75H5.25C4.42157 9.75 3.75 10.4216 3.75 11.25V21.75C3.75 22.5784 4.42157 23.25 5.25 23.25H18.75C19.5784 23.25 20.25 22.5784 20.25 21.75V11.25C20.25 10.4216 19.5784 9.75 18.75 9.75Z"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 9.75V6C6.75 4.60761 7.30312 3.27226 8.28769 2.28769C9.27226 1.30312 10.6076 0.75 12 0.75C13.3924 0.75 14.7277 1.30312 15.7123 2.28769C16.6969 3.27226 17.25 4.60761 17.25 6V9.75"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M8.625 15C8.41789 15 8.25 14.8321 8.25 14.625C8.25 14.4179 8.41789 14.25 8.625 14.25"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M8.625 15C8.83211 15 9 14.8321 9 14.625C9 14.4179 8.83211 14.25 8.625 14.25"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M8.625 18.75C8.41789 18.75 8.25 18.5821 8.25 18.375C8.25 18.1679 8.41789 18 8.625 18"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M8.625 18.75C8.83211 18.75 9 18.5821 9 18.375C9 18.1679 8.83211 18 8.625 18"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 15C11.7929 15 11.625 14.8321 11.625 14.625C11.625 14.4179 11.7929 14.25 12 14.25"/>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 15C12.2071 15 12.375 14.8321 12.375 14.625C12.375 14.4179 12.2071 14.25 12 14.25"/>
                                <g>
                                    <path stroke="currentColor" stroke-width="1.5" d="M12 18.75C11.7929 18.75 11.625 18.5821 11.625 18.375C11.625 18.1679 11.7929 18 12 18"/>
                                    <path stroke="currentColor" stroke-width="1.5" d="M12 18.75C12.2071 18.75 12.375 18.5821 12.375 18.375C12.375 18.1679 12.2071 18 12 18"/>
                                </g>
                                <g>
                                    <path stroke="currentColor" stroke-width="1.5" d="M15.375 15C15.1679 15 15 14.8321 15 14.625C15 14.4179 15.1679 14.25 15.375 14.25"/>
                                    <path stroke="currentColor" stroke-width="1.5" d="M15.375 15C15.5821 15 15.75 14.8321 15.75 14.625C15.75 14.4179 15.5821 14.25 15.375 14.25"/>
                                </g>
                                <g>
                                    <path stroke="currentColor" stroke-width="1.5" d="M15.375 18.75C15.1679 18.75 15 18.5821 15 18.375C15 18.1679 15.1679 18 15.375 18"/>
                                    <path stroke="currentColor" stroke-width="1.5" d="M15.375 18.75C15.5821 18.75 15.75 18.5821 15.75 18.375C15.75 18.1679 15.5821 18 15.375 18"/>
                                </g>
                            </svg>
                            Password
                        
                        </a>
                    </li>

                    
                </ul>
                <div class="card-footer text-center">
                    
                </div>
            </div>
        </div>
        <div class="col">
           
                <!-- Card Basic Info -->
                <div class="card border-0 scroll-mt-3" id="basicInformationSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Basic information</h2>
                    </div>
                    <div class="card-body">
                        <form id="basicForm" method="POST">
                            @csrf
                           
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="fullName" class="col-form-label">Full Name</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" id="fullName" required  value="">
                                <div class="invalid-feedback">Please add your full name</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="phone" class="col-form-label">Phone Number</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="phone_number" maxlength="11" class="form-control" id="phoneNumber" required placeholder="(+63) 934 349 232" value="">
                                <div class="invalid-feedback">Please add your phone number</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="country" class="col-form-label">Location</label>
                            </div>
                            <div class="col-lg">
                                <div class="mb-4">
                                    <select class="form-select " name="country" id="country" required autocomplete="off" style="cursor: pointer">
                                        {{-- <option value="" label="country placeholder"></option> --}}
                                        <option value="Philippines">Philippines</option>
                                        
                                    </select>
                                    <div class="invalid-feedback">Please select a country</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="city" class="form-control" placeholder="City" id="city" required value="">
                                    <div class="invalid-feedback">Please add a city</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="brgy" class="form-control" placeholder="Brgy" id="brgy" required value="">
                                    <div class="invalid-feedback">Please add a Brgy</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="province" class="form-control" id="province" placeholder="Province" required value="">
                                    <div class="invalid-feedback">Please add a state or Province</div>
                                </div>
                            </div>
                        </div>

                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="zipCode" class="col-form-label">Zip code</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" name="zip_code" class="form-control" id="zip-code" placeholder="6110" required value="">
                                <div class="invalid-feedback">Please add a zip code</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="overview" class="col-form-label">Overview</label>
                            </div>
                            <div class="col-lg">
                                <textarea class="form-control" name="overview" id="overview" required rows="4">
                                     
                                </textarea>
                                <div class="invalid-feedback">Please tell something about yourself</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>

                <!-- Username -->
                <div class="card border-0 scroll-mt-3" id="usernameSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Username</h2>
                    </div>
                    <div class="card-body">
                        <form id="form-user-email" method="POST">
                            @csrf
                        <p class="small text-muted mb-3">
                            Your current username is <strong id="user-email-head"></strong>
                        </p>
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-lg">
                                <div class="input-group">
                                    <span class="input-group-text" id="username-addon">
                                        <svg viewBox="0 0 24 24" height="10" width="10" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.25,12A5.25,5.25,0,1,1,12,6.75,5.25,5.25,0,0,1,17.25,12Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                            <path d="M17.25,12v2.25a3,3,0,0,0,6,0V12a11.249,11.249,0,1,0-4.5,9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="user-email-input" name="user_email" placeholder="username" value="" aria-describedby="username-addon">
                                </div>
                                <div class="invalid-feedback">Please add a new username</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>


                <!-- Password -->
                <div class="card border-0 scroll-mt-3" id="passwordSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Password</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="passwordForm">
                            @csrf
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="currentPassword" class="col-form-label">Current password</label>
                            </div>
                            <div class="col-lg">
                                <input type="password" name="current_password" class="form-control" id="currentPassword" required>
                                <div class="invalid-feedback curr-password">Please add your current password</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="newPassword" class="col-form-label">New password</label>
                            </div>
                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" name="newPassword" class="form-control" id="newPassword" autocomplete="off" data-toggle-password-input placeholder="Your new password">
                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>
                                <div class="invalid-feedback new-pass-invalid-feedback">Please add a new password</div>
                                <!---Progress Bar-->
                                <div class="d-flex justify-content-between align-items-center mt-3 h-15px">
                                    <div class="progress d-flex flex-grow-1 h-7px">
                                        <div data-zxcvbn='{"input": "#newPassword", "text": "#progressText"}' class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted fs-6" id="progressText"></span>
                                </div>
                                <!--End of Progress Bar--->

                            </div>
                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="newPasswordAgain" autocomplete="off" data-toggle-password-input placeholder="Confirm your new password">
                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>
                                <div class="invalid-feedback confirm-pass-invalid">Please confirm your new password again</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row">
                            <div class="col-lg offset-lg-3">
                                <div class="alert alert-light mw-450px" role="alert">
                                    <h4 class="mb-3">Password requirements:</h4>
                                    <ul class="p-3 mb-0">
                                        <li>Minimum 8 characters long - the more, the better</li>
                                        <li>At least one lowercase character</li>
                                        <li>At least one uppercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                    </div>
                </div>

               
        </div>
    </div>
    <!-- / .row -->
</div>
<script src="{{asset('assets/js/admin/users/zxcvbn.js')}}"></script>
<script src="{{asset('assets/js/admin/profile/profile.js')}}"></script>

@endSection