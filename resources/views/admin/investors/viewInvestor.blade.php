@extends('layouts.dash-app')

@section('title','Profile | Account')

@section('content')

<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Investor Account Details
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
                        <h3 class="mb-0">Marko</h3>
                        <span class="small text-secondary fw-semibold">Investor</span>
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
                    <div class="row">
                        <label for="" class="mb-2">Acount Number</label>
                        <input id="key-01" class="form-control w-350px me-3" value="34434327" >
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
                    <div class="row mb-2">
                        <div class="col text-start">
                            <label for="label">Shares : </label>
                            <strong class="text-primary">(2%)</strong>
                        </div>                      
                    </div>
                    <div class="row mb-2">
                        <div class="col text-start">
                            <label for="label">Amount : </label>
                            <strong class="text-primary"> ₱2000</strong>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col text-start">
                            <label for="label">Total Balance : </label>
                            <strong class="text-primary"> ₱2020</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary">Transfer</button>
                        </div>
                    </div>
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
                                        }' data-option-template='<span class="d-flex align-items-center py-2"><span class="avatar avatar-circle avatar-xxs"><img class="avatar-img shadow-sm" src="./assets/images/flags/1x1/[[value]].svg" /></span><span class="text-truncate ms-2">[[text]]</span></span>' data-item-template='<span class="d-flex align-items-center"><span class="avatar avatar-circle avatar-xxs"><img class="avatar-img shadow-sm" src="" /></span><span class="text-truncate ms-2">[[text]]</span></span>'>
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
                <!-- Username -->

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


                <!-- Password -->
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
      
                <!--Logs-->
                <div class="card border-0 scroll-mt-3" id="passwordSection">
                    <div class="card-header">
                        <h2 class="h3 mb-0">Logs</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover table-nowrap mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        
                                        <th>
                                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Transaction Type
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="key">Amount
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
                                       
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr>
                                       
                                        <td>
                                           Transfer Fund
                                        </td>
                                        <td class="key" >
                                            1000
                                        </td>
                                       
                                        <td class="status" data-status="Active">
                                            <span class="legend-circle bg-success"></span>
                                            Active
                                        </td>
                                        <td class="created" data-created="1642550400">01.19.22</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <!-- / .row -->
</div>

@endsection