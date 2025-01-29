@extends('layouts.app')

@section('title','Profile')

@section('content')

<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Account
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
                                <input type="file" name="avatar" class="d-none">
                            </label>
                            <img src="https://d33wubrfki0l68.cloudfront.net/053f2dfd0df2f52c41e903a21d177b0b44abc9b1/1282c/assets/images/profiles/profile-06.jpeg" alt="Profile picture" class="avatar-img" width="112" height="112">
                        </div>
                        <h3 class="mb-0">Ellie Tucker</h3>
                        <span class="small text-secondary fw-semibold">Assistant Manager</span>
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
                    <li>
                        <a href="#privacyAndSafetySection" class="d-flex align-items-center py-3">
                            <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.749,9a8.25,8.25,0,0,1,13.5-6.364" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M19.687,6a8.23,8.23,0,0,1,.562,3v6A8.25,8.25,0,0,1,12,23.25a8.336,8.336,0,0,1-1.5-.136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M6.751,21.365a8.234,8.234,0,0,1-3-6.365V12.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M15.749,15V9a3.75,3.75,0,0,0-6-3" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M8.249,9v6A3.753,3.753,0,0,0,13.5,18.438" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M11.999 9.75L11.999 14.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                            Privacy and Safety
                        
                        </a>
                    </li>
                    <li>
                        <a href="#paymentMethodsSection" class="d-flex align-items-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14" class="me-3">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                            stroke: currentColor;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }
                                    </style>
                                </defs>
                                <title>credit-card-1</title>
                                <rect class="a" x="0.75" y="3.75" width="22.5" height="16.5" rx="1.5" ry="1.5"/>
                                <line class="a" x1="0.75" y1="8.25" x2="23.25" y2="8.25"/>
                                <line class="a" x1="5.25" y1="12.75" x2="13.5" y2="12.75"/>
                                <line class="a" x1="5.25" y1="15.75" x2="10.5" y2="15.75"/>
                            </svg>
                            Payment methods
                        
                        </a>
                    </li>
                    <li>
                        <a href="#notificationsSection" class="d-flex align-items-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14" class="me-3">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                            stroke: currentColor;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 1.5px;
                                        }
                                    </style>
                                </defs>
                                <title>alert-bell-notification-2</title>
                                <circle class="a" cx="18.875" cy="5.827" r="3"/>
                                <path class="a" d="M9.125,21.75a2.087,2.087,0,0,0,4.005,0"/>
                                <line class="a" x1="11.125" y1="3" x2="11.125" y2="0.75"/>
                                <path class="a" d="M18.648,11.961c.189,5.756,1.477,6.789,1.477,6.789h-18s1.5-1.916,1.5-8.25a7.507,7.507,0,0,1,9.724-7.165"/>
                            </svg>
                            Notifications
                        
                        </a>
                    </li>
                    <li>
                        <a href="#connectedAccountsSection" class="d-flex align-items-center py-3">
                            <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.750 10.498 A3.750 3.750 0 1 0 17.250 10.498 A3.750 3.750 0 1 0 9.750 10.498 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M18.750 2.998 A2.250 2.250 0 1 0 23.250 2.998 A2.250 2.250 0 1 0 18.750 2.998 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M18.750 15.748 A2.250 2.250 0 1 0 23.250 15.748 A2.250 2.250 0 1 0 18.750 15.748 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M11.250 20.998 A2.250 2.250 0 1 0 15.750 20.998 A2.250 2.250 0 1 0 11.250 20.998 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M0.750 20.998 A2.250 2.250 0 1 0 5.250 20.998 A2.250 2.250 0 1 0 0.750 20.998 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M1.500 5.248 A2.250 2.250 0 1 0 6.000 5.248 A2.250 2.250 0 1 0 1.500 5.248 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M16.151 7.848L19.411 4.588" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M16.794 12.292L19.079 14.577" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M13.5 14.248L13.5 18.748" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M10.851 13.147L4.59 19.408" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M10.001 9.149L5.61 6.514" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                            Connected accounts
                        
                        </a>
                    </li>
                    <li>
                        <a href="#deleteAccountSection" class="d-flex align-items-center py-3">
                            <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.177,23.25H7.677a1.5,1.5,0,0,1-1.5-1.5V8.25h13.5v13.5A1.5,1.5,0,0,1,18.177,23.25Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M10.677 18.75L10.677 12.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M15.177 18.75L15.177 12.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M2.427 6.212L21.501 2.158" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                <path d="M13.541.783l-4.4.935A1.5,1.5,0,0,0,7.984,3.5L8.3,4.965l7.336-1.56L15.32,1.938A1.5,1.5,0,0,0,13.541.783Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            </svg>
                            Delete account
                        
                        </a>
                    </li>
                </ul>
                <div class="card-footer text-center">
                    <!-- Button -->
                    <a href="./user.html" class="btn btn-secondary">View Public Profile</a>
                </div>
            </div>
        </div>
        <div class="col">
            <form novalidate>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="basicInformationSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Basic information</h2>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="fullName" class="col-form-label">Full Name</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="fullName" value="Ellie K. Tucker">
                                <div class="invalid-feedback">Please add your full name</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="phone" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="phone" value="+1(119)980-03-11">
                                <div class="invalid-feedback">Please add your phone number</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="emailAddress" class="col-form-label">Email address</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="emailAddress" value="ellie.tucker@dashly.com">
                                <div class="invalid-feedback">Please add your email address</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="country" class="col-form-label">Location</label>
                            </div>
                            <div class="col-lg">
                                <div class="mb-4">
                                    <select class="form-select" id="country" required autocomplete="off" data-select='{
                                            "placeholder": "Country"
                                        }' data-option-template='<span class="d-flex align-items-center py-2"><span class="avatar avatar-circle avatar-xxs"><img class="avatar-img shadow-sm" src="./assets/images/flags/1x1/[[value]].svg" /></span><span class="text-truncate ms-2">[[text]]</span></span>' data-item-template='<span class="d-flex align-items-center"><span class="avatar avatar-circle avatar-xxs"><img class="avatar-img shadow-sm" src="./assets/images/flags/1x1/[[value]].svg" /></span><span class="text-truncate ms-2">[[text]]</span></span>'>
                                        <option value="" label="country placeholder"></option>
                                        <option value="af">Afghanistan</option>
                                        <option value="ax">Aland Islands</option>
                                        <option value="al">Albania</option>
                                        <option value="dz">Algeria</option>
                                        <option value="as">American Samoa</option>
                                        <option value="ad">Andorra</option>
                                        <option value="ao">Angola</option>
                                        <option value="ai">Anguilla</option>
                                        <option value="aq">Antarctica</option>
                                        <option value="ag">Antigua and Barbuda</option>
                                        <option value="ar">Argentina</option>
                                        <option value="am">Armenia</option>
                                        <option value="aw">Aruba</option>
                                        <option value="au">Australia</option>
                                        <option value="at">Austria</option>
                                        <option value="az">Azerbaijian</option>
                                        <option value="bs">Bahamas</option>
                                        <option value="bh">Bahrain</option>
                                        <option value="bd">Bangladesh</option>
                                        <option value="bb">Barbados</option>
                                        <option value="by">Belarus</option>
                                        <option value="be">Belgium</option>
                                        <option value="bz">Belize</option>
                                        <option value="bj">Benin</option>
                                        <option value="bm">Bermuda</option>
                                        <option value="bt">Bhutan</option>
                                        <option value="bo">Bolivia (Plurinational State of)</option>
                                        <option value="bq">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="ba">Bosnia and Herzegovina</option>
                                        <option value="bw">Botswana</option>
                                        <option value="br">Brazil</option>
                                        <option value="io">British Indian Ocean Territory</option>
                                        <option value="bn">Brunei Darussalam</option>
                                        <option value="bg">Bulgaria</option>
                                        <option value="bf">Burkina Faso</option>
                                        <option value="bi">Burundi</option>
                                        <option value="cv">Cabo Verde</option>
                                        <option value="kh">Cambodia</option>
                                        <option value="cm">Cameroon</option>
                                        <option value="ca">Canada</option>
                                        <option value="ky">Cayman Islands</option>
                                        <option value="cf">Central African Republic</option>
                                        <option value="td">Chad</option>
                                        <option value="cl">Chile</option>
                                        <option value="cn">China</option>
                                        <option value="cx">Christmas Island</option>
                                        <option value="cc">Cocos (Keeling) Islands</option>
                                        <option value="co">Colombia</option>
                                        <option value="km">Comoros</option>
                                        <option value="cg">Congo</option>
                                        <option value="cd">Congo (the Democratic Republic of the)</option>
                                        <option value="ck">Cook Islands</option>
                                        <option value="cr">Costa Rica</option>
                                        <option value="ci">Cote D'ivoire</option>
                                        <option value="hr">Croatia</option>
                                        <option value="cu">Cuba</option>
                                        <option value="cw">Curacao</option>
                                        <option value="cy">Cyprus</option>
                                        <option value="cz">Czechia</option>
                                        <option value="dk">Denmark</option>
                                        <option value="dj">Djibouti</option>
                                        <option value="dm">Dominica</option>
                                        <option value="do">Dominican Republic</option>
                                        <option value="ec">Ecuador</option>
                                        <option value="eg">Egypt</option>
                                        <option value="sv">El Salvador</option>
                                        <option value="gq">Equatorial Guinea</option>
                                        <option value="er">Eritrea</option>
                                        <option value="ee">Estonia</option>
                                        <option value="et">Ethiopia</option>
                                        <option value="fk">Falkland Islands (Malvinas)</option>
                                        <option value="fo">Faroe Islands</option>
                                        <option value="fj">Fiji</option>
                                        <option value="fi">Finland</option>
                                        <option value="fr">France</option>
                                        <option value="gf">French Guiana</option>
                                        <option value="pf">French Polynesia</option>
                                        <option value="tf">French Southern Territories</option>
                                        <option value="ga">Gabon</option>
                                        <option value="gm">Gambia</option>
                                        <option value="ge">Georgia</option>
                                        <option value="de">Germany</option>
                                        <option value="gh">Ghana</option>
                                        <option value="gi">Gibraltar</option>
                                        <option value="gr">Greece</option>
                                        <option value="gl">Greenland</option>
                                        <option value="gd">Grenada</option>
                                        <option value="gp">Guadeloupe</option>
                                        <option value="gu">Guam</option>
                                        <option value="gt">Guatemala</option>
                                        <option value="gg">Guernsey</option>
                                        <option value="gn">Guinea</option>
                                        <option value="gw">Guinea-Bissau</option>
                                        <option value="gy">Guyana</option>
                                        <option value="ht">Haiti</option>
                                        <option value="va">Holy See</option>
                                        <option value="hn">Honduras</option>
                                        <option value="hk">Hong Kong</option>
                                        <option value="hu">Hungary</option>
                                        <option value="is">Iceland</option>
                                        <option value="in">India</option>
                                        <option value="id">Indonesia</option>
                                        <option value="ir">Iran (Islamic Republic of)</option>
                                        <option value="iq">Iraq</option>
                                        <option value="ie">Ireland</option>
                                        <option value="im">Isle of Man</option>
                                        <option value="il">Israel</option>
                                        <option value="it">Italy</option>
                                        <option value="jm">Jamaica</option>
                                        <option value="jp">Japan</option>
                                        <option value="je">Jersey</option>
                                        <option value="jo">Jordan</option>
                                        <option value="kz">Kazakhstan</option>
                                        <option value="ke">Kenya</option>
                                        <option value="ki">Kiribati</option>
                                        <option value="kp">Korea (the Democratic People's Republic of)</option>
                                        <option value="kr">Korea (the Republic of)</option>
                                        <option value="kw">Kuwait</option>
                                        <option value="kg">Kyrgyzstan</option>
                                        <option value="la">Lao People's Democratic Republic</option>
                                        <option value="lv">Latvia</option>
                                        <option value="lb">Lebanon</option>
                                        <option value="ls">Lesotho</option>
                                        <option value="lr">Liberia</option>
                                        <option value="ly">Libya</option>
                                        <option value="li">Liechtenstein</option>
                                        <option value="lt">Lithuania</option>
                                        <option value="lu">Luxembourg</option>
                                        <option value="mo">Macao</option>
                                        <option value="mk">North Macedonia</option>
                                        <option value="mg">Madagascar</option>
                                        <option value="mw">Malawi</option>
                                        <option value="my">Malaysia</option>
                                        <option value="mv">Maldives</option>
                                        <option value="ml">Mali</option>
                                        <option value="mt">Malta</option>
                                        <option value="mh">Marshall Islands</option>
                                        <option value="mq">Martinique</option>
                                        <option value="mr">Mauritania</option>
                                        <option value="mu">Mauritius</option>
                                        <option value="yt">Mayotte</option>
                                        <option value="mx">Mexico</option>
                                        <option value="fm">Micronesia (Federated States of)</option>
                                        <option value="md">Moldova (the Republic of)</option>
                                        <option value="mc">Monaco</option>
                                        <option value="mn">Mongolia</option>
                                        <option value="me">Montenegro</option>
                                        <option value="ms">Montserrat</option>
                                        <option value="ma">Morocco</option>
                                        <option value="mz">Mozambique</option>
                                        <option value="mm">Myanmar</option>
                                        <option value="na">Namibia</option>
                                        <option value="nr">Nauru</option>
                                        <option value="np">Nepal</option>
                                        <option value="nl">Netherlands</option>
                                        <option value="nc">New Caledonia</option>
                                        <option value="nz">New Zealand</option>
                                        <option value="ni">Nicaragua</option>
                                        <option value="ne">Niger</option>
                                        <option value="ng">Nigeria</option>
                                        <option value="nu">Niue</option>
                                        <option value="nf">Norfolk Island</option>
                                        <option value="mp">Northern Mariana Islands</option>
                                        <option value="no">Norway</option>
                                        <option value="om">Oman</option>
                                        <option value="pk">Pakistan</option>
                                        <option value="pw">Palau</option>
                                        <option value="ps">Palestine, State of</option>
                                        <option value="pa">Panama</option>
                                        <option value="pg">Papua New Guinea</option>
                                        <option value="py">Paraguay</option>
                                        <option value="pe">Peru</option>
                                        <option value="ph">Philippines</option>
                                        <option value="pn">Pitcairn</option>
                                        <option value="pl">Poland</option>
                                        <option value="pt">Portugal</option>
                                        <option value="pr">Puerto Rico</option>
                                        <option value="qa">Qatar</option>
                                        <option value="re">Reunion</option>
                                        <option value="ro">Romania</option>
                                        <option value="ru">Russian Federation</option>
                                        <option value="rw">Rwanda</option>
                                        <option value="bl">Saint Barthelemy</option>
                                        <option value="sh">Saint Helena, Ascension and Tristan Da Cunha</option>
                                        <option value="kn">Saint Kitts and Nevis</option>
                                        <option value="lc">Saint Lucia</option>
                                        <option value="mf">Saint Martin (French Part)</option>
                                        <option value="pm">Saint Pierre and Miquelon</option>
                                        <option value="vc">Saint Vincent and The Grenadines</option>
                                        <option value="ws">Samoa</option>
                                        <option value="sm">San Marino</option>
                                        <option value="st">Sao Tome and Principe</option>
                                        <option value="sa">Saudi Arabia</option>
                                        <option value="sn">Senegal</option>
                                        <option value="rs">Serbia</option>
                                        <option value="sc">Seychelles</option>
                                        <option value="sl">Sierra Leone</option>
                                        <option value="sg">Singapore</option>
                                        <option value="sx">Sint Maarten (Dutch Part)</option>
                                        <option value="sk">Slovakia</option>
                                        <option value="si">Slovenia</option>
                                        <option value="sb">Solomon Islands</option>
                                        <option value="so">Somalia</option>
                                        <option value="za">South Africa</option>
                                        <option value="gs">South Georgia and The South Sandwich Islands</option>
                                        <option value="ss">South Sudan</option>
                                        <option value="es">Spain</option>
                                        <option value="lk">Sri Lanka</option>
                                        <option value="sd">Sudan</option>
                                        <option value="sr">Suriname</option>
                                        <option value="sj">Svalbard and Jan Mayen</option>
                                        <option value="sz">Eswatini</option>
                                        <option value="se">Sweden</option>
                                        <option value="ch">Switzerland</option>
                                        <option value="sy">Syrian Arab Republic</option>
                                        <option value="tw">Taiwan (Province of China)</option>
                                        <option value="tj">Tajikistan</option>
                                        <option value="tz">Tanzania, United Republic of</option>
                                        <option value="th">Thailand</option>
                                        <option value="tl">Timor-Leste</option>
                                        <option value="tg">Togo</option>
                                        <option value="tk">Tokelau</option>
                                        <option value="to">Tonga</option>
                                        <option value="tt">Trinidad and Tobago</option>
                                        <option value="tn">Tunisia</option>
                                        <option value="tr">Turkey</option>
                                        <option value="tm">Turkmenistan</option>
                                        <option value="tc">Turks and Caicos Islands</option>
                                        <option value="tv">Tuvalu</option>
                                        <option value="ug">Uganda</option>
                                        <option value="ua">Ukraine</option>
                                        <option value="ae">United Arab Emirates</option>
                                        <option value="gb">United Kingdom of Great Britain and Northern Ireland</option>
                                        <option value="us" selected>United States of America</option>
                                        <option value="um">United States Minor Outlying Islands</option>
                                        <option value="uy">Uruguay</option>
                                        <option value="uz">Uzbekistan</option>
                                        <option value="vu">Vanuatu</option>
                                        <option value="ve">Venezuela (Bolivarian Republic of)</option>
                                        <option value="vn">Viet Nam</option>
                                        <option value="vg">Virgin Islands (British)</option>
                                        <option value="vi">Virgin Islands (U.S.)</option>
                                        <option value="wf">Wallis and Futuna</option>
                                        <option value="eh">Western Sahara</option>
                                        <option value="ye">Yemen</option>
                                        <option value="zm">Zambia</option>
                                        <option value="zw">Zimbabwe</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a country</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control" id="city" value="Houston">
                                    <div class="invalid-feedback">Please add a city</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control" id="state" value="Texas">
                                    <div class="invalid-feedback">Please add a state or county</div>
                                </div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="addressLine1" class="col-form-label">Address Line 1</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="addressLine1" value="3227 Wines Lane">
                                <div class="invalid-feedback">Please add an address</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="addressLine2" class="col-form-label">
                                    Address Line 2
                                    <span class="text-muted fw-normal">(Optional)</span>
                                </label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="addressLine2">
                                <div class="invalid-feedback">Please add an address</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="zipCode" class="col-form-label">Zip code</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="zipCode" value="77032">
                                <div class="invalid-feedback">Please add a zip code</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="overview" class="col-form-label">Overview</label>
                            </div>
                            <div class="col-lg">
                                <textarea class="form-control" id="overview" rows="4">Gamer. Certified entrepreneur. Introvert. Zombie geek. Friendly coffee guru. Vegan.</textarea>
                                <div class="invalid-feedback">Please tell something about yourself</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="usernameSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Username</h2>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">
                            Your current username is <strong>@ellietucker</strong>
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
                                    <input type="text" class="form-control" id="username" placeholder="username" value="ellietucker" aria-describedby="username-addon">
                                </div>
                                <div class="invalid-feedback">Please add a new username</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="passwordSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Password</h2>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="currentPassword" class="col-form-label">Current password</label>
                            </div>
                            <div class="col-lg">
                                <input type="password" class="form-control" id="currentPassword">
                                <div class="invalid-feedback">Please add your current password</div>
                            </div>
                        </div>
                        <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="newPassword" class="col-form-label">New password</label>
                            </div>
                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="newPassword" autocomplete="off" data-toggle-password-input placeholder="Your new password">
                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>
                                <div class="invalid-feedback">Please add a new password</div>
                                <div class="d-flex justify-content-between align-items-center mt-3 h-15px">
                                    <div class="progress d-flex flex-grow-1 h-7px">
                                        <div data-zxcvbn='{"input": "#newPassword", "text": "#progressText"}' class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted fs-6" id="progressText"></span>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="newPasswordAgain" autocomplete="off" data-toggle-password-input placeholder="Confirm your new password">
                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>
                                <div class="invalid-feedback">Please confirm your new password again</div>
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
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="privacyAndSafetySection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Privacy and Safety</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="me-2">
                                    <h3 class="h4 mb-0">Use 2-Step Verification</h3>
                                    <p class="small text-muted mb-0">Ut vel lectus vel sem pretium pharetra</p>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="twoStepVerification">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="me-2">
                                    <h3 class="h4 mb-0">Search History</h3>
                                    <p class="small text-muted mb-0">Nunc suscipit est quis tincidunt lobortis</p>
                                </div>
                                <!-- Button -->
                                <button type="button" class="btn btn-sm text-bg-info-soft border-0">View
                                </button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="me-2">
                                    <h3 class="h4 mb-0">Login activity</h3>
                                    <p class="small text-muted mb-0">Nunc eget libero posuere, cursus mi tincidunt, mattis nisi</p>
                                </div>
                                <!-- Button -->
                                <button type="button" class="btn btn-sm text-bg-info-soft border-0">View
                                </button>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="paymentMethodsSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Payment methods</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg width="40" height="14" viewBox="0 0 81 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>visa</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-87.000000, -72.000000)">
                                                <g id="visa" transform="translate(75.000000, 50.000000)">
                                                    <rect id="Rectangle-26" fill-opacity="0" fill="#FFFFFF" x="0" y="0" width="110" height="70"></rect>
                                                    <g transform="translate(12.000000, 21.000000)" id="g4155-Clipped" fill-rule="nonzero" fill="#1A1F71">
                                                        <g transform="translate(41.000000, 14.345679) scale(1, -1) translate(-41.000000, -14.345679) translate(0.000000, 0.345679)">
                                                            <g id="g4155">
                                                                <g id="g4161" transform="translate(0.054676, 0.096245)">
                                                                    <path d="M39.9238261,26.5122639 L34.5652696,0.772857503 L28.0839773,0.772857503 L33.4430206,26.5122639 L39.9238261,26.5122639 L39.9238261,26.5122639 Z M67.1908255,9.89157558 L70.602852,19.558047 L72.5654489,9.89157558 L67.1908255,9.89157558 L67.1908255,9.89157558 Z M74.4253149,0.772857503 L80.4182707,0.772857503 L75.182407,26.5122639 L69.6539308,26.5122639 C68.4080154,26.5122639 67.3583109,25.7699205 66.8933443,24.6253911 L57.1679977,0.772857503 L63.9745232,0.772857503 L65.3260907,4.61663553 L73.6399841,4.61663553 L74.4253149,0.772857503 L74.4253149,0.772857503 Z M57.5054027,9.17624469 C57.5341284,15.9688868 48.3662547,16.345561 48.4271142,19.3804649 C48.4470761,20.3028916 49.3030039,21.285346 51.1750419,21.5364622 C52.1035143,21.6595191 54.6639948,21.7585649 57.5672359,20.3844293 L58.7026306,25.8449552 C57.143167,26.4242231 55.1367513,26.9824814 52.6405384,26.9824814 C46.2332512,26.9824814 41.7257539,23.4858639 41.6897251,18.4745458 C41.6488275,14.7688317 44.9094356,12.702876 47.3608559,11.4688052 C49.8887157,10.2072216 50.7358798,9.3978472 50.7237079,8.27082587 C50.7061804,6.54402709 48.7075547,5.77967352 46.8476886,5.7506601 C43.5865937,5.69863604 41.6975151,6.65607893 40.191121,7.3774126 L39.0148287,1.73480247 C40.5314472,1.02147251 43.3261151,0.400685346 46.2201056,0.368670537 C53.0314998,0.368670537 57.4854408,3.82476924 57.5054027,9.17624469 L57.5054027,9.17624469 Z M30.6629591,26.5122639 L20.1615322,0.772857503 L13.3111879,0.772857503 L8.14299989,21.3148597 C7.82993867,22.577944 7.55680127,23.0421587 6.60398508,23.5759056 C5.04549524,24.445808 2.47235596,25.2591842 0.210330401,25.7654184 L0.363209442,26.5122639 L11.391923,26.5122639 C12.79656,26.5122639 14.0604899,25.5518196 14.381828,23.8895507 L17.1117414,8.99366023 L23.8539992,26.5122639 L30.6629591,26.5122639 L30.6629591,26.5122639 Z" id="path4163"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="ms-4">
                                        <h3 class="h4 mb-0">Visa ending in 4321</h3>
                                        <p class="small text-muted mb-0">Expires 9/2024</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge text-bg-light p-2 fs-6 me-2">Default</span>
                                    <!-- Dropdown -->
                                    <div class="dropdown">
                                        <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex mx-2 text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                                <g>
                                                    <circle cx="12" cy="3.25" r="3.25" style="fill: currentColor"/>
                                                    <circle cx="12" cy="12" r="3.25" style="fill: currentColor"/>
                                                    <circle cx="12" cy="20.75" r="3.25" style="fill: currentColor"/>
                                                </g>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="javascript: void(0);" class="dropdown-item">Action
                                            </a>
                                            <a href="javascript: void(0);" class="dropdown-item">Another action
                                            </a>
                                            <a href="javascript: void(0);" class="dropdown-item">Something else here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg width="40" height="31" viewBox="0 0 72 56" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>mastercard</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-94.000000, -152.000000)">
                                                <g id="mastercard" transform="translate(75.000000, 145.000000)">
                                                    <rect id="Rectangle-26-Copy" fill-opacity="0" fill="#FFFFFF" x="0" y="0" width="110" height="70"></rect>
                                                    <g id="Group" transform="translate(19.000000, 7.000000)" fill-rule="nonzero">
                                                        <path d="M13.3627119,55.4521739 L13.3627119,51.8 C13.3627119,50.4 12.5084746,49.4869565 11.0440678,49.4869565 C10.3118644,49.4869565 9.51864407,49.7304348 8.96949153,50.5217391 C8.54237288,49.8521739 7.93220339,49.4869565 7.01694915,49.4869565 C6.40677966,49.4869565 5.79661017,49.6695652 5.30847458,50.3391304 L5.30847458,49.6086957 L4.02711864,49.6086957 L4.02711864,55.4521739 L5.30847458,55.4521739 L5.30847458,52.226087 C5.30847458,51.1913043 5.85762712,50.7043478 6.71186441,50.7043478 C7.56610169,50.7043478 7.99322034,51.2521739 7.99322034,52.226087 L7.99322034,55.4521739 L9.27457627,55.4521739 L9.27457627,52.226087 C9.27457627,51.1913043 9.88474576,50.7043478 10.6779661,50.7043478 C11.5322034,50.7043478 11.959322,51.2521739 11.959322,52.226087 L11.959322,55.4521739 L13.3627119,55.4521739 Z M32.3389831,49.6086957 L30.2644068,49.6086957 L30.2644068,47.8434783 L28.9830508,47.8434783 L28.9830508,49.6086957 L27.8237288,49.6086957 L27.8237288,50.7652174 L28.9830508,50.7652174 L28.9830508,53.4434783 C28.9830508,54.7826087 29.5322034,55.573913 30.9966102,55.573913 C31.5457627,55.573913 32.1559322,55.3913043 32.5830508,55.1478261 L32.2169492,54.0521739 C31.8508475,54.2956522 31.4237288,54.3565217 31.1186441,54.3565217 C30.5084746,54.3565217 30.2644068,53.9913043 30.2644068,53.3826087 L30.2644068,50.7652174 L32.3389831,50.7652174 L32.3389831,49.6086957 Z M43.2,49.4869565 C42.4677966,49.4869565 41.979661,49.8521739 41.6745763,50.3391304 L41.6745763,49.6086957 L40.3932203,49.6086957 L40.3932203,55.4521739 L41.6745763,55.4521739 L41.6745763,52.1652174 C41.6745763,51.1913043 42.1016949,50.6434783 42.8949153,50.6434783 C43.1389831,50.6434783 43.4440678,50.7043478 43.6881356,50.7652174 L44.0542373,49.5478261 C43.8101695,49.4869565 43.4440678,49.4869565 43.2,49.4869565 L43.2,49.4869565 Z M26.7864407,50.0956522 C26.1762712,49.6695652 25.3220339,49.4869565 24.4067797,49.4869565 C22.9423729,49.4869565 21.9661017,50.2173913 21.9661017,51.373913 C21.9661017,52.3478261 22.6983051,52.8956522 23.979661,53.0782609 L24.5898305,53.1391304 C25.2610169,53.2608696 25.6271186,53.4434783 25.6271186,53.7478261 C25.6271186,54.173913 25.1389831,54.4782609 24.2847458,54.4782609 C23.4305085,54.4782609 22.759322,54.173913 22.3322034,53.8695652 L21.7220339,54.8434783 C22.3932203,55.3304348 23.3084746,55.573913 24.2237288,55.573913 C25.9322034,55.573913 26.9084746,54.7826087 26.9084746,53.6869565 C26.9084746,52.6521739 26.1152542,52.1043478 24.8949153,51.9217391 L24.2847458,51.8608696 C23.7355932,51.8 23.3084746,51.6782609 23.3084746,51.3130435 C23.3084746,50.8869565 23.7355932,50.6434783 24.4067797,50.6434783 C25.1389831,50.6434783 25.8711864,50.9478261 26.2372881,51.1304348 L26.7864407,50.0956522 Z M60.8338983,49.4869565 C60.1016949,49.4869565 59.6135593,49.8521739 59.3084746,50.3391304 L59.3084746,49.6086957 L58.0271186,49.6086957 L58.0271186,55.4521739 L59.3084746,55.4521739 L59.3084746,52.1652174 C59.3084746,51.1913043 59.7355932,50.6434783 60.5288136,50.6434783 C60.7728814,50.6434783 61.0779661,50.7043478 61.3220339,50.7652174 L61.6881356,49.5478261 C61.4440678,49.4869565 61.0779661,49.4869565 60.8338983,49.4869565 L60.8338983,49.4869565 Z M44.4813559,52.5304348 C44.4813559,54.2956522 45.7016949,55.573913 47.5932203,55.573913 C48.4474576,55.573913 49.0576271,55.3913043 49.6677966,54.9043478 L49.0576271,53.8695652 C48.5694915,54.2347826 48.0813559,54.4173913 47.5322034,54.4173913 C46.4949153,54.4173913 45.7627119,53.6869565 45.7627119,52.5304348 C45.7627119,51.4347826 46.4949153,50.7043478 47.5322034,50.6434783 C48.0813559,50.6434783 48.5694915,50.826087 49.0576271,51.1913043 L49.6677966,50.1565217 C49.0576271,49.6695652 48.4474576,49.4869565 47.5932203,49.4869565 C45.7016949,49.4869565 44.4813559,50.7652174 44.4813559,52.5304348 L44.4813559,52.5304348 Z M56.3186441,52.5304348 L56.3186441,49.6086957 L55.0372881,49.6086957 L55.0372881,50.3391304 C54.6101695,49.7913043 54,49.4869565 53.2067797,49.4869565 C51.559322,49.4869565 50.2779661,50.7652174 50.2779661,52.5304348 C50.2779661,54.2956522 51.559322,55.573913 53.2067797,55.573913 C54.0610169,55.573913 54.6711864,55.2695652 55.0372881,54.7217391 L55.0372881,55.4521739 L56.3186441,55.4521739 L56.3186441,52.5304348 Z M51.620339,52.5304348 C51.620339,51.4956522 52.2915254,50.6434783 53.3898305,50.6434783 C54.4271186,50.6434783 55.159322,51.4347826 55.159322,52.5304348 C55.159322,53.5652174 54.4271186,54.4173913 53.3898305,54.4173913 C52.2915254,54.3565217 51.620339,53.5652174 51.620339,52.5304348 L51.620339,52.5304348 Z M36.3050847,49.4869565 C34.5966102,49.4869565 33.3762712,50.7043478 33.3762712,52.5304348 C33.3762712,54.3565217 34.5966102,55.573913 36.3661017,55.573913 C37.220339,55.573913 38.0745763,55.3304348 38.7457627,54.7826087 L38.1355932,53.8695652 C37.6474576,54.2347826 37.0372881,54.4782609 36.4271186,54.4782609 C35.6338983,54.4782609 34.840678,54.1130435 34.6576271,53.0782609 L38.9898305,53.0782609 C38.9898305,52.8956522 38.9898305,52.773913 38.9898305,52.5913043 C39.0508475,50.7043478 37.9525424,49.4869565 36.3050847,49.4869565 L36.3050847,49.4869565 Z M36.3050847,50.5826087 C37.0983051,50.5826087 37.6474576,51.0695652 37.7694915,51.9826087 L34.7186441,51.9826087 C34.840678,51.1913043 35.3898305,50.5826087 36.3050847,50.5826087 L36.3050847,50.5826087 Z M68.0949153,52.5304348 L68.0949153,47.2956522 L66.8135593,47.2956522 L66.8135593,50.3391304 C66.3864407,49.7913043 65.7762712,49.4869565 64.9830508,49.4869565 C63.3355932,49.4869565 62.0542373,50.7652174 62.0542373,52.5304348 C62.0542373,54.2956522 63.3355932,55.573913 64.9830508,55.573913 C65.8372881,55.573913 66.4474576,55.2695652 66.8135593,54.7217391 L66.8135593,55.4521739 L68.0949153,55.4521739 L68.0949153,52.5304348 Z M63.3966102,52.5304348 C63.3966102,51.4956522 64.0677966,50.6434783 65.1661017,50.6434783 C66.2033898,50.6434783 66.9355932,51.4347826 66.9355932,52.5304348 C66.9355932,53.5652174 66.2033898,54.4173913 65.1661017,54.4173913 C64.0677966,54.3565217 63.3966102,53.5652174 63.3966102,52.5304348 L63.3966102,52.5304348 Z M20.5627119,52.5304348 L20.5627119,49.6086957 L19.2813559,49.6086957 L19.2813559,50.3391304 C18.8542373,49.7913043 18.2440678,49.4869565 17.4508475,49.4869565 C15.8033898,49.4869565 14.5220339,50.7652174 14.5220339,52.5304348 C14.5220339,54.2956522 15.8033898,55.573913 17.4508475,55.573913 C18.3050847,55.573913 18.9152542,55.2695652 19.2813559,54.7217391 L19.2813559,55.4521739 L20.5627119,55.4521739 L20.5627119,52.5304348 Z M15.8033898,52.5304348 C15.8033898,51.4956522 16.4745763,50.6434783 17.5728814,50.6434783 C18.6101695,50.6434783 19.3423729,51.4347826 19.3423729,52.5304348 C19.3423729,53.5652174 18.6101695,54.4173913 17.5728814,54.4173913 C16.4745763,54.3565217 15.8033898,53.5652174 15.8033898,52.5304348 Z" id="XMLID_1775_" fill="currentColor"></path>
                                                        <g id="XMLID_328_">
                                                            <rect id="Rectangle-path" fill="#FF5F00" x="26.359322" y="5.23478261" width="19.220339" height="34.4521739"></rect>
                                                            <path d="M27.579661,22.4608696 C27.579661,15.4608696 30.8745763,9.25217391 35.9389831,5.23478261 C32.2169492,2.31304348 27.5186441,0.547826087 22.3932203,0.547826087 C10.2508475,0.547826087 0.427118644,10.3478261 0.427118644,22.4608696 C0.427118644,34.573913 10.2508475,44.373913 22.3932203,44.373913 C27.5186441,44.373913 32.2169492,42.6086957 35.9389831,39.6869565 C30.8745763,35.7304348 27.579661,29.4608696 27.579661,22.4608696 Z" id="XMLID_330_" fill="#EB001B"></path>
                                                            <path d="M71.5118644,22.4608696 C71.5118644,34.573913 61.6881356,44.373913 49.5457627,44.373913 C44.420339,44.373913 39.7220339,42.6086957 36,39.6869565 C41.1254237,35.6695652 44.359322,29.4608696 44.359322,22.4608696 C44.359322,15.4608696 41.0644068,9.25217391 36,5.23478261 C39.7220339,2.31304348 44.420339,0.547826087 49.5457627,0.547826087 C61.6881356,0.547826087 71.5118644,10.4086957 71.5118644,22.4608696 Z" fill="#F79E1B"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="ms-4">
                                        <h3 class="h4 mb-0">Mastercard ending in 1234</h3>
                                        <p class="small text-muted mb-0">Expires 7/2025</p>
                                    </div>
                                </div>
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex mx-2 text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                            <g>
                                                <circle cx="12" cy="3.25" r="3.25" style="fill: currentColor"/>
                                                <circle cx="12" cy="12" r="3.25" style="fill: currentColor"/>
                                                <circle cx="12" cy="20.75" r="3.25" style="fill: currentColor"/>
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="javascript: void(0);" class="dropdown-item">Action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">Another action
                                        </a>
                                        <a href="javascript: void(0);" class="dropdown-item">Something else here
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="notificationsSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Notifications</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">In this setcion you will be able to configure the behaviour of notifications in Dashly</p>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table id="notificationsTable" class="table align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase py-4 align-middle min-w-300px min-w-md-auto">Type</th>
                                        <th class="text-center text-uppercase py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24" width="24" class="d-block mx-auto mb-1">
                                                <g>
                                                    <g>
                                                        <path d="M13.5,13a4.38,4.38,0,0,1-1.5.26,4.5,4.5,0,1,1,4.5-4.5" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px"/>
                                                        <circle cx="12" cy="8.75" r="1.5" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px"/>
                                                        <path d="M13.5,8.75a1.5,1.5,0,0,0,3,0" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px"/>
                                                    </g>
                                                    <g>
                                                        <path d="M20.25,12.75V2.25a1.5,1.5,0,0,0-1.5-1.5H5.25a1.5,1.5,0,0,0-1.5,1.5v10.5" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px"/>
                                                        <path d="M22,11.46a.77.77,0,0,1,.8-.08.73.73,0,0,1,.42.67v9.7a1.5,1.5,0,0,1-1.5,1.5H2.25a1.5,1.5,0,0,1-1.5-1.5v-9.7a.73.73,0,0,1,.42-.67.77.77,0,0,1,.8.08l8.18,5.9a3,3,0,0,0,3.7,0Z" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 1.5px"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            Email
                                        
                                        </th>
                                        <th class="text-center text-uppercase py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24" width="24" class="d-block mx-auto mb-1">
                                                <defs>
                                                    <style>
                                                        .a {
                                                            fill: none;
                                                            stroke: currentColor;
                                                            stroke-linecap: round;
                                                            stroke-linejoin: round;
                                                            stroke-width: 1.5px;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>alert-notification-bars-2</title>
                                                <rect class="a" x="0.75" y="0.75" width="22.5" height="9.5" rx="1"/>
                                                <line class="a" x1="0.75" y1="3.75" x2="23.25" y2="3.75"/>
                                                <rect class="a" x="0.75" y="13.75" width="22.5" height="9.5" rx="1"/>
                                                <line class="a" x1="0.75" y1="16.75" x2="23.25" y2="16.75"/>
                                            </svg>
                                            Browser
                                        
                                        </th>
                                        <th class="text-center text-uppercase py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24" width="24" class="d-block mx-auto mb-1">
                                                <defs>
                                                    <style>
                                                        .a {
                                                            fill: none;
                                                            stroke: currentColor;
                                                            stroke-linecap: round;
                                                            stroke-linejoin: round;
                                                            stroke-width: 1.5px;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>alert-clear-notification</title>
                                                <rect class="a" x="3.876" y="5.75" width="11.5" height="3.5" rx="0.5"/>
                                                <rect class="a" x="5.374" y="12" width="11.5" height="3.5" rx="0.5"/>
                                                <line class="a" x1="18.374" y1="5.75" x2="21.374" y2="5.75"/>
                                                <line class="a" x1="19.124" y1="10.75" x2="22.124" y2="10.75"/>
                                                <line class="a" x1="20.124" y1="15.5" x2="23.124" y2="15.5"/>
                                                <path class="a" d="M14.376,18.75v2a2.5,2.5,0,0,1-2.5,2.5h-8.5a2.5,2.5,0,0,1-2.5-2.5V3.25a2.5,2.5,0,0,1,2.5-2.5h8.5a2.5,2.5,0,0,1,2.487,2.244"/>
                                                <line class="a" x1="0.876" y1="18.75" x2="14.376" y2="18.75"/>
                                            </svg>
                                            App
                                        
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="h4 mb-0">Enable E-mail notification</h3>
                                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="h4 mb-0">Enable New Friend Notifications</h3>
                                            <p class="small text-muted mb-0">Nunc suscipit est quis tincidunt lobortis</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="h4 mb-0">Enable New Comment Notifications</h3>
                                            <p class="small text-muted mb-0">Nunc eget libero posuere, cursus mi tincidunt, mattis nisi</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="h4 mb-0">
                                                Enable System Notifications
                                        
                                                
                                                <!-- Icon -->
                                                <a href="javascript: void(0);" data-bs-toggle="tooltip" title="Maecenas sit amet lectus et orci facilisis venenatis" class="ms-1 text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14">
                                                        <path d="M12,0A12,12,0,1,0,24,12,12,12,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,0,1,0,2Z" style="fill: currentColor"/>
                                                    </svg>
                                                </a>
                                            </h3>
                                            <p class="small text-muted mb-0">In dapibus magna ac tellus lacinia, tempus pretium mauris scelerisque</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="h4 mb-0">Status changes</h3>
                                            <p class="small text-muted mb-0">Ut viverra sapien ut purus ultricies, et euismod enim viverra</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- / .table-responsive -->
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="connectedAccountsSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Connected Accounts</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg viewBox="0 0 24 24" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                                        <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                            <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/>
                                            <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/>
                                            <path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/>
                                            <path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/>
                                        </g>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">Google</h3>
                                        <p class="small text-muted mb-0">Etiam rhoncus leo et ex volutpat eleifend</p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked id="connectGoogle">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg width="32" height="32" viewBox="0 0 256 249" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet">
                                        <g fill="#161614">
                                            <path d="M127.505 0C57.095 0 0 57.085 0 127.505c0 56.336 36.534 104.13 87.196 120.99 6.372 1.18 8.712-2.766 8.712-6.134 0-3.04-.119-13.085-.173-23.739-35.473 7.713-42.958-15.044-42.958-15.044-5.8-14.738-14.157-18.656-14.157-18.656-11.568-7.914.872-7.752.872-7.752 12.804.9 19.546 13.14 19.546 13.14 11.372 19.493 29.828 13.857 37.104 10.6 1.144-8.242 4.449-13.866 8.095-17.05-28.32-3.225-58.092-14.158-58.092-63.014 0-13.92 4.981-25.295 13.138-34.224-1.324-3.212-5.688-16.18 1.235-33.743 0 0 10.707-3.427 35.073 13.07 10.17-2.826 21.078-4.242 31.914-4.29 10.836.048 21.752 1.464 31.942 4.29 24.337-16.497 35.029-13.07 35.029-13.07 6.94 17.563 2.574 30.531 1.25 33.743 8.175 8.929 13.122 20.303 13.122 34.224 0 48.972-29.828 59.756-58.22 62.912 4.573 3.957 8.648 11.717 8.648 23.612 0 17.06-.148 30.791-.148 34.991 0 3.393 2.295 7.369 8.759 6.117 50.634-16.879 87.122-64.656 87.122-120.973C255.009 57.085 197.922 0 127.505 0"/>
                                            <path d="M47.755 181.634c-.28.633-1.278.823-2.185.389-.925-.416-1.445-1.28-1.145-1.916.275-.652 1.273-.834 2.196-.396.927.415 1.455 1.287 1.134 1.923M54.027 187.23c-.608.564-1.797.302-2.604-.589-.834-.889-.99-2.077-.373-2.65.627-.563 1.78-.3 2.616.59.834.899.996 2.08.36 2.65M58.33 194.39c-.782.543-2.06.034-2.849-1.1-.781-1.133-.781-2.493.017-3.038.792-.545 2.05-.055 2.85 1.07.78 1.153.78 2.513-.019 3.069M65.606 202.683c-.699.77-2.187.564-3.277-.488-1.114-1.028-1.425-2.487-.724-3.258.707-.772 2.204-.555 3.302.488 1.107 1.026 1.445 2.496.7 3.258M75.01 205.483c-.307.998-1.741 1.452-3.185 1.028-1.442-.437-2.386-1.607-2.095-2.616.3-1.005 1.74-1.478 3.195-1.024 1.44.435 2.386 1.596 2.086 2.612M85.714 206.67c.036 1.052-1.189 1.924-2.705 1.943-1.525.033-2.758-.818-2.774-1.852 0-1.062 1.197-1.926 2.721-1.951 1.516-.03 2.758.815 2.758 1.86M96.228 206.267c.182 1.026-.872 2.08-2.377 2.36-1.48.27-2.85-.363-3.039-1.38-.184-1.052.89-2.105 2.367-2.378 1.508-.262 2.857.355 3.049 1.398"/>
                                        </g>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">Github</h3>
                                        <p class="small text-muted mb-0">Vestibulum egestas erat nec nisl commodo egestas</p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked id="connectGithub">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg height="32" viewBox="2.59 0 214.09101008 224" width="32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <linearGradient gradientTransform="matrix(1 0 0 -1 0 264)" gradientUnits="userSpaceOnUse" x1="102.4" x2="56.15" y1="218.63" y2="172.39">
                                            <stop offset=".18" stop-color="#0052cc"/>
                                            <stop offset="1" stop-color="#2684ff"/>
                                        </linearGradient>
                                        <linearGradient x1="114.65" x2="160.81" xlink:href="#a" y1="85.77" y2="131.92"/>
                                        <path d="m214.06 105.73-96.39-96.39-9.34-9.34-72.56 72.56-33.18 33.17a8.89 8.89 0 0 0 0 12.54l66.29 66.29 39.45 39.44 72.55-72.56 1.13-1.12 32.05-32a8.87 8.87 0 0 0 0-12.59zm-105.73 39.39-33.12-33.12 33.12-33.12 33.11 33.12z" fill="#2684ff"/>
                                        <path d="m108.33 78.88a55.75 55.75 0 0 1 -.24-78.61l-72.47 72.44 39.44 39.44z" fill="url(#a)"/>
                                        <path d="m141.53 111.91-33.2 33.21a55.77 55.77 0 0 1 0 78.86l72.67-72.63z" fill="url(#b)"/>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">JIRA</h3>
                                        <p class="small text-muted mb-0">
                                            Maecenas sit amet nibh iaculis, <a href="javascript: void(0);">commodo</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="connectJIRA">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg height="32" viewBox="-.1 1.1 304.9 179.8" width="32" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m86.4 66.4c0 3.7.4 6.7 1.1 8.9.8 2.2 1.8 4.6 3.2 7.2.5.8.7 1.6.7 2.3 0 1-.6 2-1.9 3l-6.3 4.2c-.9.6-1.8.9-2.6.9-1 0-2-.5-3-1.4-1.4-1.5-2.6-3.1-3.6-4.7-1-1.7-2-3.6-3.1-5.9-7.8 9.2-17.6 13.8-29.4 13.8-8.4 0-15.1-2.4-20-7.2s-7.4-11.2-7.4-19.2c0-8.5 3-15.4 9.1-20.6s14.2-7.8 24.5-7.8c3.4 0 6.9.3 10.6.8s7.5 1.3 11.5 2.2v-7.3c0-7.6-1.6-12.9-4.7-16-3.2-3.1-8.6-4.6-16.3-4.6-3.5 0-7.1.4-10.8 1.3s-7.3 2-10.8 3.4c-1.6.7-2.8 1.1-3.5 1.3s-1.2.3-1.6.3c-1.4 0-2.1-1-2.1-3.1v-4.9c0-1.6.2-2.8.7-3.5s1.4-1.4 2.8-2.1c3.5-1.8 7.7-3.3 12.6-4.5 4.9-1.3 10.1-1.9 15.6-1.9 11.9 0 20.6 2.7 26.2 8.1 5.5 5.4 8.3 13.6 8.3 24.6v32.4zm-40.6 15.2c3.3 0 6.7-.6 10.3-1.8s6.8-3.4 9.5-6.4c1.6-1.9 2.8-4 3.4-6.4s1-5.3 1-8.7v-4.2c-2.9-.7-6-1.3-9.2-1.7s-6.3-.6-9.4-.6c-6.7 0-11.6 1.3-14.9 4s-4.9 6.5-4.9 11.5c0 4.7 1.2 8.2 3.7 10.6 2.4 2.5 5.9 3.7 10.5 3.7zm80.3 10.8c-1.8 0-3-.3-3.8-1-.8-.6-1.5-2-2.1-3.9l-23.5-77.3c-.6-2-.9-3.3-.9-4 0-1.6.8-2.5 2.4-2.5h9.8c1.9 0 3.2.3 3.9 1 .8.6 1.4 2 2 3.9l16.8 66.2 15.6-66.2c.5-2 1.1-3.3 1.9-3.9s2.2-1 4-1h8c1.9 0 3.2.3 4 1 .8.6 1.5 2 1.9 3.9l15.8 67 17.3-67c.6-2 1.3-3.3 2-3.9.8-.6 2.1-1 3.9-1h9.3c1.6 0 2.5.8 2.5 2.5 0 .5-.1 1-.2 1.6s-.3 1.4-.7 2.5l-24.1 77.3c-.6 2-1.3 3.3-2.1 3.9s-2.1 1-3.8 1h-8.6c-1.9 0-3.2-.3-4-1s-1.5-2-1.9-4l-15.5-64.5-15.4 64.4c-.5 2-1.1 3.3-1.9 4s-2.2 1-4 1zm128.5 2.7c-5.2 0-10.4-.6-15.4-1.8s-8.9-2.5-11.5-4c-1.6-.9-2.7-1.9-3.1-2.8s-.6-1.9-.6-2.8v-5.1c0-2.1.8-3.1 2.3-3.1.6 0 1.2.1 1.8.3s1.5.6 2.5 1c3.4 1.5 7.1 2.7 11 3.5 4 .8 7.9 1.2 11.9 1.2 6.3 0 11.2-1.1 14.6-3.3s5.2-5.4 5.2-9.5c0-2.8-.9-5.1-2.7-7s-5.2-3.6-10.1-5.2l-14.5-4.5c-7.3-2.3-12.7-5.7-16-10.2-3.3-4.4-5-9.3-5-14.5 0-4.2.9-7.9 2.7-11.1s4.2-6 7.2-8.2c3-2.3 6.4-4 10.4-5.2s8.2-1.7 12.6-1.7c2.2 0 4.5.1 6.7.4 2.3.3 4.4.7 6.5 1.1 2 .5 3.9 1 5.7 1.6s3.2 1.2 4.2 1.8c1.4.8 2.4 1.6 3 2.5.6.8.9 1.9.9 3.3v4.7c0 2.1-.8 3.2-2.3 3.2-.8 0-2.1-.4-3.8-1.2-5.7-2.6-12.1-3.9-19.2-3.9-5.7 0-10.2.9-13.3 2.8s-4.7 4.8-4.7 8.9c0 2.8 1 5.2 3 7.1s5.7 3.8 11 5.5l14.2 4.5c7.2 2.3 12.4 5.5 15.5 9.6s4.6 8.8 4.6 14c0 4.3-.9 8.2-2.6 11.6-1.8 3.4-4.2 6.4-7.3 8.8-3.1 2.5-6.8 4.3-11.1 5.6-4.5 1.4-9.2 2.1-14.3 2.1z" fill="#252f3e"/>
                                        <g clip-rule="evenodd" fill="#f90" fill-rule="evenodd">
                                            <path d="m273.5 143.7c-32.9 24.3-80.7 37.2-121.8 37.2-57.6 0-109.5-21.3-148.7-56.7-3.1-2.8-.3-6.6 3.4-4.4 42.4 24.6 94.7 39.5 148.8 39.5 36.5 0 76.6-7.6 113.5-23.2 5.5-2.5 10.2 3.6 4.8 7.6z"/>
                                            <path d="m287.2 128.1c-4.2-5.4-27.8-2.6-38.5-1.3-3.2.4-3.7-2.4-.8-4.5 18.8-13.2 49.7-9.4 53.3-5 3.6 4.5-1 35.4-18.6 50.2-2.7 2.3-5.3 1.1-4.1-1.9 4-9.9 12.9-32.2 8.7-37.5z"/>
                                        </g>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">AWS</h3>
                                        <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="connectAWS">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg height="30" preserveAspectRatio="xMidYMid" width="30" xmlns="http://www.w3.org/2000/svg" viewBox="-0.9662264221278978 -0.5824607696358868 257.93281329857973 230.8324730411935">
                                        <linearGradient x1="108.633%" x2="46.927%" y1="13.818%" y2="78.776%">
                                            <stop offset=".18" stop-color="#0052cc"/>
                                            <stop offset="1" stop-color="#2684ff"/>
                                        </linearGradient>
                                        <g fill="none">
                                            <path d="M101.272 152.561h53.449l12.901-75.32H87.06z"/>
                                            <path d="M8.308 0A8.202 8.202 0 0 0 .106 9.516l34.819 211.373a11.155 11.155 0 0 0 10.909 9.31h167.04a8.202 8.202 0 0 0 8.201-6.89l34.82-213.752a8.202 8.202 0 0 0-8.203-9.514zm146.616 152.768h-53.315l-14.436-75.42h80.67z" fill="#2684ff"/>
                                            <path d="M244.61 77.242h-76.916l-12.909 75.36h-53.272l-62.902 74.663a11.105 11.105 0 0 0 7.171 2.704H212.73a8.196 8.196 0 0 0 8.196-6.884z" fill="url(#a)"/>
                                        </g>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">Bitbucket</h3>
                                        <p class="small text-muted mb-0">Fusce at sem viverra, scelerisque justo ac, dapibus libero</p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="connectBitbucket">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div class="d-flex align-items-center">
                                    <svg width="30" height="30" enable-background="new 0 0 2447.6 2452.5" viewBox="0 0 2447.6 2452.5" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-rule="evenodd" fill-rule="evenodd">
                                            <path d="m897.4 0c-135.3.1-244.8 109.9-244.7 245.2-.1 135.3 109.5 245.1 244.8 245.2h244.8v-245.1c.1-135.3-109.5-245.1-244.9-245.3.1 0 .1 0 0 0m0 654h-652.6c-135.3.1-244.9 109.9-244.8 245.2-.2 135.3 109.4 245.1 244.7 245.3h652.7c135.3-.1 244.9-109.9 244.8-245.2.1-135.4-109.5-245.2-244.8-245.3z" fill="#36c5f0"/>
                                            <path d="m2447.6 899.2c.1-135.3-109.5-245.1-244.8-245.2-135.3.1-244.9 109.9-244.8 245.2v245.3h244.8c135.3-.1 244.9-109.9 244.8-245.3zm-652.7 0v-654c.1-135.2-109.4-245-244.7-245.2-135.3.1-244.9 109.9-244.8 245.2v654c-.2 135.3 109.4 245.1 244.7 245.3 135.3-.1 244.9-109.9 244.8-245.3z" fill="#2eb67d"/>
                                            <path d="m1550.1 2452.5c135.3-.1 244.9-109.9 244.8-245.2.1-135.3-109.5-245.1-244.8-245.2h-244.8v245.2c-.1 135.2 109.5 245 244.8 245.2zm0-654.1h652.7c135.3-.1 244.9-109.9 244.8-245.2.2-135.3-109.4-245.1-244.7-245.3h-652.7c-135.3.1-244.9 109.9-244.8 245.2-.1 135.4 109.4 245.2 244.7 245.3z" fill="#ecb22e"/>
                                            <path d="m0 1553.2c-.1 135.3 109.5 245.1 244.8 245.2 135.3-.1 244.9-109.9 244.8-245.2v-245.2h-244.8c-135.3.1-244.9 109.9-244.8 245.2zm652.7 0v654c-.2 135.3 109.4 245.1 244.7 245.3 135.3-.1 244.9-109.9 244.8-245.2v-653.9c.2-135.3-109.4-245.1-244.7-245.3-135.4 0-244.9 109.8-244.8 245.1 0 0 0 .1 0 0" fill="#e01e5a"/>
                                        </g>
                                    </svg>
                                    <div class="ms-3">
                                        <h3 class="h4 mb-0">Slack</h3>
                                        <p class="small text-muted mb-0">
                                            Sed dapibus sapien <a href="javascript: void(0);">vel bibendum</a>
                                            egestas
                                        </p>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked id="connectSlack">
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card border-0 scroll-mt-3" id="deleteAccountSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Delete Account</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert text-bg-danger-soft d-flex align-items-center" role="alert">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="32" width="32" class="me-3">
                                    <path d="M23.39,10.53,13.46.6a2.07,2.07,0,0,0-2.92,0L.61,10.54a2.06,2.06,0,0,0,0,2.92h0l9.93,9.92A2,2,0,0,0,12,24a2.07,2.07,0,0,0,1.47-.61l9.92-9.92A2.08,2.08,0,0,0,23.39,10.53ZM11,6.42a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h0a1.54,1.54,0,0,1-1.52-1.47A1.47,1.47,0,0,1,12,14.93h0A1.53,1.53,0,0,1,13.5,16.4,1.48,1.48,0,0,1,12.05,17.93Z" style="fill: currentColor"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="mb-0">If you delete your account, you will lose all your data</h4>
                                Take a backup of your data
                            
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <!-- Input -->
                                <input type="checkbox" class="form-check-input" id="deleteAccount">
                                <!-- Label -->
                                <label class="form-check-label" for="deleteAccount">I confirm that I'd like to delete my account
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-5">
                            <!-- Button -->
                            <button type="button" class="btn btn-danger">Delete account</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- / .row -->
</div>

@endsection