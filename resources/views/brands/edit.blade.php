@if(auth()->user()->user_type != 2)
@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Brand</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brand List</a></li>
<li class="breadcrumb-item active">Edit Brand</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">
                    <div class="container">
                        <div class="d-flex flex-row-reverse">
                            <a class="p-1" href="{{ route('brands.index') }}"><button
                                    class="btn btn-primary">Back</button></a>
                        </div>
                        <form id="brand_form" class="needs-validation" action="{{route('brands.update',$brands->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- <img src="{{ asset('images/brand/'.$brands->image)}}"> -->
                                <div class="col-md-12 mb-3">
                                    <!--  -->
                                    @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible p-2">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                        <strong>Error!</strong> {{$error}}.
                                    </div>
                                    @endforeach
                                    @endif

                                    @if ($message = Session::get('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif

                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif
                                    <!--  -->
                                    <p class="text-center" p style="font-weight: bold;font-size: 15px;"><label
                                            class="text-center" for="validationCustom01">Brand Logo</label></p>
                                    <p class="text-center"><img
                                            src="{{ isset($brands->image) ? (file_exists(public_path('images/brand/'.$brands->image)) ? asset('images/brand/'.$brands->image) : asset('images/brand/thumbnail.png')) : asset('images/brand/thumbnail.png')   }}"
                                            id="img" class="mb-2" height="200" width="200"></p>
                                    <input class="form-control" id="img" onchange="readURL(this)" name="image"
                                        type="file" placeholder="Brand Logo" accept="image/*">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Company Name*</p>
                                    <input class="form-control" id="validationCustom02"
                                        value="{{$brands->company_name}}" name="company_name" type="text"
                                        placeholder="Company Name" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;">Country</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control"
                                        name="country">
                                        <option value="Afganistan"
                                            {{$brands->country == 'Afganistan' ? 'selected' : ''}}>Afghanistan</option>
                                        <option value="Albania" {{$brands->country == 'Albania' ? 'selected' : ''}}>
                                            Albania</option>
                                        <option value="Algeria" {{$brands->country == 'Algeria' ? 'selected' : ''}}>
                                            Algeria</option>
                                        <option value="American Samoa"
                                            {{$brands->country == 'American Samoa' ? 'selected' : ''}}>American Samoa
                                        </option>
                                        <option value="Andorra" {{$brands->country == 'Andorra' ? 'selected' : ''}}>
                                            Andorra</option>
                                        <option value="Angola" {{$brands->country == 'Angola' ? 'selected' : ''}}>Angola
                                        </option>
                                        <option value="Anguilla" {{$brands->country == 'Anguilla' ? 'selected' : ''}}>
                                            Anguilla</option>
                                        <option value="Antigua & Barbuda"
                                            {{$brands->country == 'Antigua & Barbuda' ? 'selected' : ''}}>Antigua &
                                            Barbuda</option>
                                        <option value="Argentina" {{$brands->country == 'Argentina' ? 'selected' : ''}}>
                                            Argentina</option>
                                        <option value="Armenia" {{$brands->country == 'Armenia' ? 'selected' : ''}}>
                                            Armenia</option>
                                        <option value="Aruba" {{$brands->country == 'Aruba' ? 'selected' : ''}}>Aruba
                                        </option>
                                        <option value="Australia" {{$brands->country == 'Australia' ? 'selected' : ''}}>
                                            Australia</option>
                                        <option value="Austria" {{$brands->country == 'Austria' ? 'selected' : ''}}>
                                            Austria</option>
                                        <option value="Azerbaijan"
                                            {{$brands->country == 'Azerbaijan' ? 'selected' : ''}}>Azerbaijan</option>
                                        <option value="Bahamas" {{$brands->country == 'Bahamas' ? 'selected' : ''}}>
                                            Bahamas</option>
                                        <option value="Bahrain" {{$brands->country == 'Bahrain' ? 'selected' : ''}}>
                                            Bahrain</option>
                                        <option value="Bangladesh"
                                            {{$brands->country == 'Bangladesh' ? 'selected' : ''}}>Bangladesh</option>
                                        <option value="Barbados" {{$brands->country == 'Barbados' ? 'selected' : ''}}>
                                            Barbados</option>
                                        <option value="Belarus" {{$brands->country == 'Belarus' ? 'selected' : ''}}>
                                            Belarus</option>
                                        <option value="Belgium" {{$brands->country == 'Belgium' ? 'selected' : ''}}>
                                            Belgium</option>
                                        <option value="Belize" {{$brands->country == 'Belize' ? 'selected' : ''}}>Belize
                                        </option>
                                        <option value="Benin" {{$brands->country == 'Benin' ? 'selected' : ''}}>Benin
                                        </option>
                                        <option value="Bermuda" {{$brands->country == 'Bermuda' ? 'selected' : ''}}>
                                            Bermuda</option>
                                        <option value="Bhutan" {{$brands->country == 'Bhutan' ? 'selected' : ''}}>Bhutan
                                        </option>
                                        <option value="Bolivia" {{$brands->country == 'Bolivia' ? 'selected' : ''}}>
                                            Bolivia</option>
                                        <option value="Bonaire" {{$brands->country == 'Bonaire' ? 'selected' : ''}}>
                                            Bonaire</option>
                                        <option value="Bosnia & Herzegovina"
                                            {{$brands->country == 'Bosnia & Herzegovina' ? 'selected' : ''}}>Bosnia &
                                            Herzegovina</option>
                                        <option value="Botswana" {{$brands->country == 'Fiji' ? 'selected' : ''}}>
                                            Botswana</option>
                                        <option value="Brazil" {{$brands->country == 'Brazil' ? 'selected' : ''}}>Brazil
                                        </option>
                                        <option value="British Indian Ocean Ter"
                                            {{$brands->country == 'British Indian Ocean Ter' ? 'selected' : ''}}>British
                                            Indian Ocean Ter</option>
                                        <option value="Brunei" {{$brands->country == 'Brunei' ? 'selected' : ''}}>Brunei
                                        </option>
                                        <option value="Bulgaria" {{$brands->country == 'Bulgaria' ? 'selected' : ''}}>
                                            Bulgaria</option>
                                        <option value="Burkina Faso"
                                            {{$brands->country == 'Burkina Faso' ? 'selected' : ''}}>Burkina Faso
                                        </option>
                                        <option value="Burundi" {{$brands->country == 'Burundi' ? 'selected' : ''}}>
                                            Burundi</option>
                                        <option value="Cambodia" {{$brands->country == 'Cambodia' ? 'selected' : ''}}>
                                            Cambodia</option>
                                        <option value="Cameroon" {{$brands->country == 'Cameroon' ? 'selected' : ''}}>
                                            Cameroon</option>
                                        <option value="Canada" {{$brands->country == 'Canada' ? 'selected' : ''}}>Canada
                                        </option>
                                        <option value="Canary Islands"
                                            {{$brands->country == 'Canary Islands' ? 'selected' : ''}}>Canary Islands
                                        </option>
                                        <option value="Cape Verde"
                                            {{$brands->country == 'Cape Verde' ? 'selected' : ''}}>Cape Verde</option>
                                        <option value="Cayman Islands"
                                            {{$brands->country == 'Cayman Islands' ? 'selected' : ''}}>Cayman Islands
                                        </option>
                                        <option value="Central African Republic"
                                            {{$brands->country == 'Fiji' ? 'selected' : ''}}>Central African Republic
                                        </option>
                                        <option value="Chad" {{$brands->country == 'Chad' ? 'selected' : ''}}>Chad
                                        </option>
                                        <option value="Channel Islands"
                                            {{$brands->country == 'Channel Islands' ? 'selected' : ''}}>Channel Islands
                                        </option>
                                        <option value="Chile" {{$brands->country == 'Chile' ? 'selected' : ''}}>Chile
                                        </option>
                                        <option value="China" {{$brands->country == 'China' ? 'selected' : ''}}>China
                                        </option>
                                        <option value="Christmas Island"
                                            {{$brands->country == 'Christmas Island' ? 'selected' : ''}}>Christmas
                                            Island</option>
                                        <option value="Cocos Island"
                                            {{$brands->country == 'Cocos Island' ? 'selected' : ''}}>Cocos Island
                                        </option>
                                        <option value="Colombia" {{$brands->country == 'Colombia' ? 'selected' : ''}}>
                                            Colombia</option>
                                        <option value="Comoros" {{$brands->country == 'Comoros' ? 'selected' : ''}}>
                                            Comoros</option>
                                        <option value="Congo" {{$brands->country == 'Congo' ? 'selected' : ''}}>Congo
                                        </option>
                                        <option value="Cook Islands"
                                            {{$brands->country == 'Cook Islands' ? 'selected' : ''}}>Cook Islands
                                        </option>
                                        <option value="Costa Rica"
                                            {{$brands->country == 'Costa Rica' ? 'selected' : ''}}>Costa Rica</option>
                                        <option value="Cote DIvoire"
                                            {{$brands->country == 'Cote DIvoire' ? 'selected' : ''}}>Cote DIvoire
                                        </option>
                                        <option value="Croatia" {{$brands->country == 'Croatia' ? 'selected' : ''}}>
                                            Croatia</option>
                                        <option value="Cuba" {{$brands->country == 'Cuba' ? 'selected' : ''}}>Cuba
                                        </option>
                                        <option value="Curaco" {{$brands->country == 'Curacao' ? 'selected' : ''}}>
                                            Curacao</option>
                                        <option value="Cyprus" {{$brands->country == 'Cyprus' ? 'selected' : ''}}>Cyprus
                                        </option>
                                        <option value="Czech Republic"
                                            {{$brands->country == 'Czech Republic' ? 'selected' : ''}}>Czech Republic
                                        </option>
                                        <option value="Denmark" {{$brands->country == 'Denmark' ? 'selected' : ''}}>
                                            Denmark</option>
                                        <option value="Djibouti" {{$brands->country == 'Djibouti' ? 'selected' : ''}}>
                                            Djibouti</option>
                                        <option value="Dominica" {{$brands->country == 'Dominica' ? 'selected' : ''}}>
                                            Dominica</option>
                                        <option value="Dominican Republic"
                                            {{$brands->country == 'Dominican Republic' ? 'selected' : ''}}>Dominican
                                            Republic</option>
                                        <option value="East Timor"
                                            {{$brands->country == 'East Timor' ? 'selected' : ''}}>East Timor</option>
                                        <option value="Ecuador" {{$brands->country == 'Ecuador' ? 'selected' : ''}}>
                                            Ecuador</option>
                                        <option value="Egypt" {{$brands->country == 'Egypt' ? 'selected' : ''}}>Egypt
                                        </option>
                                        <option value="El Salvador"
                                            {{$brands->country == 'El Salvador' ? 'selected' : ''}}>El Salvador</option>
                                        <option value="Equatorial Guinea"
                                            {{$brands->country == 'Equatorial Guinea' ? 'selected' : ''}}>Equatorial
                                            Guinea</option>
                                        <option value="Eritrea" {{$brands->country == 'Eritrea' ? 'selected' : ''}}>
                                            Eritrea</option>
                                        <option value="Estonia" {{$brands->country == 'Estonia' ? 'selected' : ''}}>
                                            Estonia</option>
                                        <option value="Ethiopia" {{$brands->country == 'Ethiopia' ? 'selected' : ''}}>
                                            Ethiopia</option>
                                        <option value="Falkland Islands"
                                            {{$brands->country == 'Falkland Islands' ? 'selected' : ''}}>Falkland
                                            Islands</option>
                                        <option value="Faroe Islands"
                                            {{$brands->country == 'Faroe Islands' ? 'selected' : ''}}>Faroe Islands
                                        </option>
                                        <option value="Fiji" {{$brands->country == 'Fiji' ? 'selected' : ''}}>Fiji
                                        </option>
                                        <option value="Finland" {{$brands->country == 'Finland' ? 'selected' : ''}}>
                                            Finland</option>
                                        <option value="France" {{$brands->country == 'France' ? 'selected' : ''}}>France
                                        </option>
                                        <option value="French Guiana"
                                            {{$brands->country == 'French Guiana' ? 'selected' : ''}}>French Guiana
                                        </option>
                                        <option value="French Polynesia"
                                            {{$brands->country == 'French Polynesia' ? 'selected' : ''}}>French
                                            Polynesia</option>
                                        <option value="French Southern Ter"
                                            {{$brands->country == 'French Southern Ter' ? 'selected' : ''}}>French
                                            Southern Ter</option>
                                        <option value="Gabon" {{$brands->country == 'Gabon' ? 'selected' : ''}}>Gabon
                                        </option>
                                        <option value="Gambia" {{$brands->country == 'Gambia' ? 'selected' : ''}}>Gambia
                                        </option>
                                        <option value="Georgia" {{$brands->country == 'Georgia' ? 'selected' : ''}}>
                                            Georgia</option>
                                        <option value="Germany" {{$brands->country == 'Germany' ? 'selected' : ''}}>
                                            Germany</option>
                                        <option value="Ghana" {{$brands->country == 'Ghana' ? 'selected' : ''}}>Ghana
                                        </option>
                                        <option value="Gibraltar" {{$brands->country == 'Gibraltar' ? 'selected' : ''}}>
                                            Gibraltar</option>
                                        <option value="Great Britain"
                                            {{$brands->country == 'Great Britain' ? 'selected' : ''}}>Great Britain
                                        </option>
                                        <option value="Greece" {{$brands->country == 'Greece' ? 'selected' : ''}}>Greece
                                        </option>
                                        <option value="Greenland" {{$brands->country == 'Greenland' ? 'selected' : ''}}>
                                            Greenland</option>
                                        <option value="Grenada" {{$brands->country == 'Grenada' ? 'selected' : ''}}>
                                            Grenada</option>
                                        <option value="Guadeloupe"
                                            {{$brands->country == 'Guadeloupe' ? 'selected' : ''}}>Guadeloupe</option>
                                        <option value="Guam" {{$brands->country == 'Guam' ? 'selected' : ''}}>Guam
                                        </option>
                                        <option value="Guatemala" {{$brands->country == 'Guatemala' ? 'selected' : ''}}>
                                            Guatemala</option>
                                        <option value="Guinea" {{$brands->country == 'Guinea' ? 'selected' : ''}}>Guinea
                                        </option>
                                        <option value="Guyana" {{$brands->country == 'Guyana' ? 'selected' : ''}}>Guyana
                                        </option>
                                        <option value="Haiti" {{$brands->country == 'Haiti' ? 'selected' : ''}}>Haiti
                                        </option>
                                        <option value="Hawaii" {{$brands->country == 'Hawaii' ? 'selected' : ''}}>Hawaii
                                        </option>
                                        <option value="Honduras" {{$brands->country == 'Honduras' ? 'selected' : ''}}>
                                            Honduras</option>
                                        <option value="Hong Kong" {{$brands->country == 'Hong Kong' ? 'selected' : ''}}>
                                            Hong Kong</option>
                                        <option value="Hungary" {{$brands->country == 'Hungary' ? 'selected' : ''}}>
                                            Hungary</option>
                                        <option value="Iceland" {{$brands->country == 'Iceland' ? 'selected' : ''}}>
                                            Iceland</option>
                                        <option value="Indonesia" {{$brands->country == 'Indonesia' ? 'selected' : ''}}>
                                            Indonesia</option>
                                        <option value="India" {{$brands->country == 'India' ? 'selected' : ''}}>India
                                        </option>
                                        <option value="Iran" {{$brands->country == 'Iran' ? 'selected' : ''}}>Iran
                                        </option>
                                        <option value="Iraq" {{$brands->country == 'Iraq' ? 'selected' : ''}}>Iraq
                                        </option>
                                        <option value="Ireland" {{$brands->country == 'Ireland' ? 'selected' : ''}}>
                                            Ireland</option>
                                        <option value="Isle of Man"
                                            {{$brands->country == 'Isle of Man' ? 'selected' : ''}}>Isle of Man</option>
                                        <option value="Israel" {{$brands->country == 'Israel' ? 'selected' : ''}}>Israel
                                        </option>
                                        <option value="Italy" {{$brands->country == 'Italy' ? 'selected' : ''}}>Italy
                                        </option>
                                        <option value="Jamaica" {{$brands->country == 'Jamaica' ? 'selected' : ''}}>
                                            Jamaica</option>
                                        <option value="Japan" {{$brands->country == 'Japan' ? 'selected' : ''}}>Japan
                                        </option>
                                        <option value="Jordan" {{$brands->country == 'Jordan' ? 'selected' : ''}}>Jordan
                                        </option>
                                        <option value="Kazakhstan"
                                            {{$brands->country == 'Kazakhstan' ? 'selected' : ''}}>Kazakhstan</option>
                                        <option value="Kenya" {{$brands->country == 'Kenya' ? 'selected' : ''}}>Kenya
                                        </option>
                                        <option value="Kiribati" {{$brands->country == 'Kiribati' ? 'selected' : ''}}>
                                            Kiribati</option>
                                        <option value="Korea North"
                                            {{$brands->country == 'Korea North' ? 'selected' : ''}}>Korea North</option>
                                        <option value="Korea Sout"
                                            {{$brands->country == 'Korea South' ? 'selected' : ''}}>Korea South</option>
                                        <option value="Kuwait" {{$brands->country == 'Kuwait' ? 'selected' : ''}}>Kuwait
                                        </option>
                                        <option value="Kyrgyzstan"
                                            {{$brands->country == 'Kyrgyzstan' ? 'selected' : ''}}>Kyrgyzstan</option>
                                        <option value="Laos" {{$brands->country == 'Laos' ? 'selected' : ''}}>Laos
                                        </option>
                                        <option value="Latvia" {{$brands->country == 'Latvia' ? 'selected' : ''}}>Latvia
                                        </option>
                                        <option value="Lebanon" {{$brands->country == 'Lebanon' ? 'selected' : ''}}>
                                            Lebanon</option>
                                        <option value="Lesotho" {{$brands->country == 'Lesotho' ? 'selected' : ''}}>
                                            Lesotho</option>
                                        <option value="Liberia" {{$brands->country == 'Liberia' ? 'selected' : ''}}>
                                            Liberia</option>
                                        <option value="Libya" {{$brands->country == 'Libya' ? 'selected' : ''}}>Libya
                                        </option>
                                        <option value="Liechtenstein" {{$brands->country == 'Fiji' ? 'selected' : ''}}>
                                            Liechtenstein</option>
                                        <option value="Lithuania" {{$brands->country == 'Fiji' ? 'selected' : ''}}>
                                            Lithuania</option>
                                        <option value="Luxembourg" {{$brands->country == 'Fiji' ? 'selected' : ''}}>
                                            Luxembourg</option>
                                        <option value="Macau" {{$brands->country == 'Macau' ? 'selected' : ''}}>Macau
                                        </option>
                                        <option value="Macedonia" {{$brands->country == 'Macedonia' ? 'selected' : ''}}>
                                            Macedonia</option>
                                        <option value="Madagascar"
                                            {{$brands->country == 'Madagascar' ? 'selected' : ''}}>Madagascar</option>
                                        <option value="Malaysia" {{$brands->country == 'Malaysia' ? 'selected' : ''}}>
                                            Malaysia</option>
                                        <option value="Malawi" {{$brands->country == 'Malawi' ? 'selected' : ''}}>Malawi
                                        </option>
                                        <option value="Maldives" {{$brands->country == 'Maldives' ? 'selected' : ''}}>
                                            Maldives</option>
                                        <option value="Mali" {{$brands->country == 'Mali' ? 'selected' : ''}}>Mali
                                        </option>
                                        <option value="Malta" {{$brands->country == 'Malta' ? 'selected' : ''}}>Malta
                                        </option>
                                        <option value="Marshall Islands"
                                            {{$brands->country == 'Marshall Islands' ? 'selected' : ''}}>Marshall
                                            Islands</option>
                                        <option value="Martinique"
                                            {{$brands->country == 'Martinique' ? 'selected' : ''}}>Martinique</option>
                                        <option value="Mauritania"
                                            {{$brands->country == 'Mauritania' ? 'selected' : ''}}>Mauritania</option>
                                        <option value="Mauritius" {{$brands->country == 'Mauritius' ? 'selected' : ''}}>
                                            Mauritius</option>
                                        <option value="Mayotte" {{$brands->country == 'Mayotte' ? 'selected' : ''}}>
                                            Mayotte</option>
                                        <option value="Mexico" {{$brands->country == 'Mexico' ? 'selected' : ''}}>Mexico
                                        </option>
                                        <option value="Midway Islands"
                                            {{$brands->country == 'Midway Islands' ? 'selected' : ''}}>Midway Islands
                                        </option>
                                        <option value="Moldova" {{$brands->country == 'Moldova' ? 'selected' : ''}}>
                                            Moldova</option>
                                        <option value="Monaco" {{$brands->country == 'Monaco' ? 'selected' : ''}}>Monaco
                                        </option>
                                        <option value="Mongolia" {{$brands->country == 'Mongolia' ? 'selected' : ''}}>
                                            Mongolia</option>
                                        <option value="Montserrat"
                                            {{$brands->country == 'Montserrat' ? 'selected' : ''}}>Montserrat</option>
                                        <option value="Morocco" {{$brands->country == 'Morocco' ? 'selected' : ''}}>
                                            Morocco</option>
                                        <option value="Mozambique"
                                            {{$brands->country == 'Mozambique' ? 'selected' : ''}}>Mozambique</option>
                                        <option value="Myanmar" {{$brands->country == 'Myanmar' ? 'selected' : ''}}>
                                            Myanmar</option>
                                        <option value="Nambia" {{$brands->country == 'Nambia' ? 'selected' : ''}}>Nambia
                                        </option>
                                        <option value="Nauru" {{$brands->country == 'Nauru' ? 'selected' : ''}}>Nauru
                                        </option>
                                        <option value="Nepal" {{$brands->country == 'Nepal' ? 'selected' : ''}}>Nepal
                                        </option>
                                        <option value="Netherland Antilles"
                                            {{$brands->country == 'Netherland Antilles' ? 'selected' : ''}}>Netherland
                                            Antilles</option>
                                        <option value="Netherlands"
                                            {{$brands->country == 'Netherlands (Holland, Europe)' ? 'selected' : ''}}>
                                            Netherlands (Holland, Europe)</option>
                                        <option value="Nevis" {{$brands->country == 'Nevis' ? 'selected' : ''}}>Nevis
                                        </option>
                                        <option value="New Caledonia"
                                            {{$brands->country == 'New Caledonia' ? 'selected' : ''}}>New Caledonia
                                        </option>
                                        <option value="New Zealand"
                                            {{$brands->country == 'New Zealand' ? 'selected' : ''}}>New Zealand</option>
                                        <option value="Nicaragua" {{$brands->country == 'Nicaragua' ? 'selected' : ''}}>
                                            Nicaragua</option>
                                        <option value="Niger" {{$brands->country == 'Niger' ? 'selected' : ''}}>Niger
                                        </option>
                                        <option value="Nigeria" {{$brands->country == 'Nigeria' ? 'selected' : ''}}>
                                            Nigeria</option>
                                        <option value="Niue" {{$brands->country == 'Niue' ? 'selected' : ''}}>Niue
                                        </option>
                                        <option value="Norfolk Island"
                                            {{$brands->country == 'Norfolk Island' ? 'selected' : ''}}>Norfolk Island
                                        </option>
                                        <option value="Norway" {{$brands->country == 'Norway' ? 'selected' : ''}}>Norway
                                        </option>
                                        <option value="Oman" {{$brands->country == 'Oman' ? 'selected' : ''}}>Oman
                                        </option>
                                        <option value="Pakistan" {{$brands->country == 'Pakistan' ? 'selected' : ''}}>
                                            Pakistan</option>
                                        <option value="Palau Island"
                                            {{$brands->country == 'Palau Island' ? 'selected' : ''}}>Palau Island
                                        </option>
                                        <option value="Palestine" {{$brands->country == 'Palestine' ? 'selected' : ''}}>
                                            Palestine</option>
                                        <option value="Panama" {{$brands->country == 'Panama' ? 'selected' : ''}}>Panama
                                        </option>
                                        <option value="Papua New Guinea"
                                            {{$brands->country == 'Papua New Guinea' ? 'selected' : ''}}>Papua New
                                            Guinea</option>
                                        <option value="Paraguay" {{$brands->country == 'Paraguay' ? 'selected' : ''}}>
                                            Paraguay</option>
                                        <option value="Peru" {{$brands->country == 'Peru' ? 'selected' : ''}}>Peru
                                        </option>
                                        <option value="Phillipines"
                                            {{$brands->country == 'Philippines' ? 'selected' : ''}}>Philippines</option>
                                        <option value="Pitcairn Island"
                                            {{$brands->country == 'Pitcairn Island' ? 'selected' : ''}}>Pitcairn Island
                                        </option>
                                        <option value="Poland" {{$brands->country == 'Poland' ? 'selected' : ''}}>Poland
                                        </option>
                                        <option value="Portugal" {{$brands->country == 'Portugal' ? 'selected' : ''}}>
                                            Portugal</option>
                                        <option value="Puerto Rico"
                                            {{$brands->country == 'Puerto Rico' ? 'selected' : ''}}>Puerto Rico</option>
                                        <option value="Qatar" {{$brands->country == 'Qatar' ? 'selected' : ''}}>Qatar
                                        </option>
                                        <option value="Republic of Montenegro"
                                            {{$brands->country == 'Republic of Montenegro' ? 'selected' : ''}}>Republic
                                            of Montenegro</option>
                                        <option value="Republic of Serbia"
                                            {{$brands->country == 'Republic of Serbia' ? 'selected' : ''}}>Republic of
                                            Serbia</option>
                                        <option value="Reunion" {{$brands->country == 'Reunion' ? 'selected' : ''}}>
                                            Reunion</option>
                                        <option value="Romania" {{$brands->country == 'Romania' ? 'selected' : ''}}>
                                            Romania</option>
                                        <option value="Russia" {{$brands->country == 'Russia' ? 'selected' : ''}}>Russia
                                        </option>
                                        <option value="Rwanda" {{$brands->country == 'Rwanda' ? 'selected' : ''}}>Rwanda
                                        </option>
                                        <option value="St Barthelemy"
                                            {{$brands->country == 'St Barthelemy' ? 'selected' : ''}}>St Barthelemy
                                        </option>
                                        <option value="St Eustatius"
                                            {{$brands->country == 'St Eustatius' ? 'selected' : ''}}>St Eustatius
                                        </option>
                                        <option value="St Helena" {{$brands->country == 'St Helena' ? 'selected' : ''}}>
                                            St Helena</option>
                                        <option value="St Kitts-Nevis"
                                            {{$brands->country == 'St Kitts-Nevis' ? 'selected' : ''}}>St Kitts-Nevis
                                        </option>
                                        <option value="St Lucia" {{$brands->country == 'St Lucia' ? 'selected' : ''}}>St
                                            Lucia</option>
                                        <option value="St Maarten"
                                            {{$brands->country == 'St Maarten' ? 'selected' : ''}}>St Maarten</option>
                                        <option value="St Pierre & Miquelon"
                                            {{$brands->country == 'St Pierre & Miquelon' ? 'selected' : ''}}>St Pierre &
                                            Miquelon</option>
                                        <option value="St Vincent & Grenadines"
                                            {{$brands->country == 'St Vincent & Grenadines' ? 'selected' : ''}}>St
                                            Vincent & Grenadines</option>
                                        <option value="Saipan" {{$brands->country == 'Saipan' ? 'selected' : ''}}>Saipan
                                        </option>
                                        <option value="Samoa" {{$brands->country == 'Samoa' ? 'selected' : ''}}>Samoa
                                        </option>
                                        <option value="Samoa American"
                                            {{$brands->country == 'Samoa American' ? 'selected' : ''}}>Samoa American
                                        </option>
                                        <option value="San Marino" {{$brands->country == 'Fiji' ? 'selected' : ''}}>San
                                            Marino</option>
                                        <option value="Sao Tome & Principe"
                                            {{$brands->country == 'Sao Tome & Principe' ? 'selected' : ''}}>Sao Tome &
                                            Principe</option>
                                        <option value="Saudi Arabia"
                                            {{$brands->country == 'Saudi Arabia' ? 'selected' : ''}}>Saudi Arabia
                                        </option>
                                        <option value="Senegal" {{$brands->country == 'Senegal' ? 'selected' : ''}}>
                                            Senegal</option>
                                        <option value="Seychelles"
                                            {{$brands->country == 'Seychelles' ? 'selected' : ''}}>Seychelles</option>
                                        <option value="Sierra Leone"
                                            {{$brands->country == 'Sierra Leone' ? 'selected' : ''}}>Sierra Leone
                                        </option>
                                        <option value="Singapore" {{$brands->country == 'Singapore' ? 'selected' : ''}}>
                                            Singapore</option>
                                        <option value="Slovakia" {{$brands->country == 'Slovakia' ? 'selected' : ''}}>
                                            Slovakia</option>
                                        <option value="Slovenia" {{$brands->country == 'Slovenia' ? 'selected' : ''}}>
                                            Slovenia</option>
                                        <option value="Solomon Islands"
                                            {{$brands->country == 'Solomon Islands' ? 'selected' : ''}}>Solomon Islands
                                        </option>
                                        <option value="Somalia" {{$brands->country == 'Somalia' ? 'selected' : ''}}>
                                            Somalia</option>
                                        <option value="South Africa"
                                            {{$brands->country == 'South Africa' ? 'selected' : ''}}>South Africa
                                        </option>
                                        <option value="Spain" {{$brands->country == 'Spain' ? 'selected' : ''}}>Spain
                                        </option>
                                        <option value="Sri Lanka" {{$brands->country == 'Sri Lanka' ? 'selected' : ''}}>
                                            Sri Lanka</option>
                                        <option value="Sudan" {{$brands->country == 'Sudan' ? 'selected' : ''}}>Sudan
                                        </option>
                                        <option value="Suriname" {{$brands->country == 'Suriname' ? 'selected' : ''}}>
                                            Suriname</option>
                                        <option value="Swaziland" {{$brands->country == 'Swaziland' ? 'selected' : ''}}>
                                            Swaziland</option>
                                        <option value="Sweden" {{$brands->country == 'Sweden' ? 'selected' : ''}}>Sweden
                                        </option>
                                        <option value="Switzerland"
                                            {{$brands->country == 'Switzerland' ? 'selected' : ''}}>Switzerland</option>
                                        <option value="Syria" {{$brands->country == 'Syria' ? 'selected' : ''}}>Syria
                                        </option>
                                        <option value="Tahiti" {{$brands->country == 'Tahiti' ? 'selected' : ''}}>Tahiti
                                        </option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan"
                                            {{$brands->country == 'Tajikistan' ? 'selected' : ''}}>Tajikistan</option>
                                        <option value="Tanzania" {{$brands->country == 'Tanzania' ? 'selected' : ''}}>
                                            Tanzania</option>
                                        <option value="Thailand" {{$brands->country == 'Thailand' ? 'selected' : ''}}>
                                            Thailand</option>
                                        <option value="Togo" {{$brands->country == 'Togo' ? 'selected' : ''}}>Togo
                                        </option>
                                        <option value="Tokelau" {{$brands->country == 'Tokelau' ? 'selected' : ''}}>
                                            Tokelau</option>
                                        <option value="Tonga" {{$brands->country == 'Tonga' ? 'selected' : ''}}>Tonga
                                        </option>
                                        <option value="Trinidad & Tobago"
                                            {{$brands->country == 'Trinidad & Tobago' ? 'selected' : ''}}>Trinidad &
                                            Tobago</option>
                                        <option value="Tunisia" {{$brands->country == 'Tunisia' ? 'selected' : ''}}>
                                            Tunisia</option>
                                        <option value="Turkey" {{$brands->country == 'Turkey' ? 'selected' : ''}}>Turkey
                                        </option>
                                        <option value="Turkmenistan"
                                            {{$brands->country == 'Turkmenistan' ? 'selected' : ''}}>Turkmenistan
                                        </option>
                                        <option value="Turks & Caicos Is"
                                            {{$brands->country == 'Turks & Caicos Is' ? 'selected' : ''}}>Turks & Caicos
                                            Is</option>
                                        <option value="Tuvalu" {{$brands->country == 'Tuvalu' ? 'selected' : ''}}>Tuvalu
                                        </option>
                                        <option value="Uganda" {{$brands->country == 'Uganda' ? 'selected' : ''}}>Uganda
                                        </option>
                                        <option value="United Kingdom"
                                            {{$brands->country == 'United Kingdom' ? 'selected' : ''}}>United Kingdom
                                        </option>
                                        <option value="Ukraine" {{$brands->country == 'Ukraine' ? 'selected' : ''}}>
                                            Ukraine</option>
                                        <option value="United Arab Erimates"
                                            {{$brands->country == 'United Arab Emirates' ? 'selected' : ''}}>United Arab
                                            Emirates</option>
                                        <option value="United States of America"
                                            {{$brands->country == 'United States of America' ? 'selected' : ''}}>United
                                            States of America</option>
                                        <option value="Uraguay" {{$brands->country == 'Uruguay' ? 'selected' : ''}}>
                                            Uruguay</option>
                                        <option value="Uzbekistan"
                                            {{$brands->country == 'Uzbekistan' ? 'selected' : ''}}>Uzbekistan</option>
                                        <option value="Vanuatu" {{$brands->country == 'Vanuatu' ? 'selected' : ''}}>
                                            Vanuatu</option>
                                        <option value="Vatican City State"
                                            {{$brands->country == 'Vatican City State' ? 'selected' : ''}}>Vatican City
                                            State</option>
                                        <option value="Venezuela" {{$brands->country == 'Venezuela' ? 'selected' : ''}}>
                                            Venezuela</option>
                                        <option value="Vietnam" {{$brands->country == 'Vietnam' ? 'selected' : ''}}>
                                            Vietnam</option>
                                        <option value="Virgin Islands (Brit)"
                                            {{$brands->country == 'Virgin Islands (Brit)' ? 'selected' : ''}}>Virgin
                                            Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)"
                                            {{$brands->country == 'Virgin Islands (USA)' ? 'selected' : ''}}>Virgin
                                            Islands (USA)</option>
                                        <option value="Wake Island"
                                            {{$brands->country == 'Wake Island' ? 'selected' : ''}}>Wake Island</option>
                                        <option value="Wallis & Futana Is"
                                            {{$brands->country == 'Wallis & Futana Is' ? 'selected' : ''}}>Wallis &
                                            Futana Is</option>
                                        <option value="Yemen" {{$brands->country == 'Yemen' ? 'selected' : ''}}>Yemen
                                        </option>
                                        <option value="Zaire" {{$brands->country == 'Zaire' ? 'selected' : ''}}>Zaire
                                        </option>
                                        <option value="Zambia" {{$brands->country == 'Zambia' ? 'selected' : ''}}>Zambia
                                        </option>
                                        <option value="Zimbabwe" {{$brands->country == 'Zimbabwe' ? 'selected' : ''}}>
                                            Zimbabwe</option>

                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p style="font-weight: bold;font-size: 15px;"> Status</p>
                                    <select class="js-example-placeholder-multiple col-sm-8 form-control" id="status"
                                        name="status" required="">
                                        <option value="1" {{$brands->status == 1 ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$brands->status == 0 ? 'selected' : ''}}>In Active</option>
                                    </select>
                                </div>
                            </div>
                            @if(isset($commission))
                            @if($commission->type == "fixed single")
                            <div class="row exsit_commission">
                                @foreach($singledata as $datasingle)
                                @foreach($datasingle as $datasng)
                                @if($datasng->id)
                                <div class="col-md-4">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Single Value:
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="single_value" name="single_value" type="number"
                                            step="any" value="{{$datasng->value}}">
                                    </div>
                                </div>
                            </div>
                                @endif
                                @endforeach
                                @endforeach
                                @endif
                                @if($commission->type == "Fixed  Dual")
                                <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Dual Value:
                                    </p>
                                @foreach($dualdata as $datadual)
                                @foreach($datadual as $datadl)
                                @if($datadl->id)
                                <div class="row exsit_commission mb-2">
                                    
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_min_value"
                                                name="dual_min_value[]" type="number" step="any"
                                                value="{{$datadl->min_value}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_max_value"
                                                name="dual_max_value[]" type="number" step="any"
                                                value="{{$datadl->max_value}}">
                                        </div>
                                    </div>
                                    <div class="col-md-1" align="center">
                                        <p style="font-weight: bold;font-size: 15px;">=</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_commission_value"
                                                name="dual_total_value[]" type="number" step="any"
                                                value="{{$datadl->total_value}}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                                @endif
                                @if($commission->type == "Fixed  Multiple")
                                @foreach($multipledata as $datamultiple)
                                @foreach($datamultiple as $datamulti)
                                @if($datamulti->id)
                                <div class="row exsit_commission">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Fixed Commission Multiple Value:
                                    </p>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="multiple_newuser_value"
                                                name="multiple_newuser_value" type="number" step="any"
                                                value="{{$datamulti->new_user}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="multiple_olduser_value"
                                                name="multiple_olduser_value" type="number" step="any"
                                                value="{{$datamulti->old_user}}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                            @endif
                            @if($commission->type == "Percentage Single")
                            
                                @foreach($singledata as $datasingle)
                                @foreach($datasingle as $datasng)
                                @if($datasng->id)
                                <div class="row exsit_commission">
                                    <div class="col-md-4">
                                        <label for="single_value">
                                            <p style="font-weight: bold;font-size: 15px;">Existing Percentage Commission
                                                Single Value:</p>
                                        </label>
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_single_value"
                                                name="percentage_updated_single_value" type="number" step="any"
                                                value="{{$datasng->value}}">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                                @endif
                                @if($commission->type == "Percentage Multiple")
                                @foreach($multipledata as $datamultiple)
                                @foreach($datamultiple as $datamulti)
                                @if($datamulti->id)
                                <div class="row exsit_commission">
                                    <p style="font-weight: bold;font-size: 15px;">Existing Percentage Commission Multiple Value:</p>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_multiple_newuser_value"
                                                name="percentage_updated_multiple_newuser_value" type="number" step="any"
                                                value="{{$datamulti->new_user}}">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" id="percentage_updated_multiple_olduser_value"
                                                name="percentage_updated_multiple_olduser_value" type="number" step="any"
                                                value="{{$datamulti->old_user}}">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                                @endif
                            
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <a class="btn btn-primary" id="change_commission" href="#">Change Commission</a>
                                </div>
                            </div>
                            @else
                            <div class="row exsit_commission ">
                                <div class="col-md-4 mt-3">
                                    <p style="font-weight: bold;font-size: 15px;"> No Existing Commission</p>
                                    <a class="btn btn-primary" id="add_change_commission" href="#">Add Commission</a>
                                </div>
                            </div>
                            @endif
                            <div class="row change_commission" style="display:none;">
                                <div class="col-md-4">
                                    @if(isset($commission))
                                    <p style="font-weight: bold;font-size: 15px;"> Change Commission</p>
                                    @endif
                                    @if(!isset($commission))
                                    <p style="font-weight: bold;font-size: 15px;"> Add Commission</p>
                                    @endif
                                    <div class="btn-group dropend com_drop">
                                        <button type="button" class="btn dropdown-toggle dropdown_main"
                                            aria-expanded="false">
                                            Commission
                                        </button>
                                        <ul class="dropdown-menu main_dropmenu ">
                                            <li>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn dropdown-toggle dropdown_fix"
                                                        aria-expanded="false">
                                                        Fixed
                                                    </button>
                                                    <ul class="dropdown-menu fix_dropmenu">
                                                        @if(isset($commission))
                                                        @if($commission->type != 'fixed single')
                                                        <li><a class="dropdown-item" href="" id="fixed_single" >Single</a></li>
                                                        @endif
                                                        @if($commission->type != 'Fixed  Dual')
                                                        <li><a class="dropdown-item" href="" id="fixed_dual">Dual</a></li>
                                                        @endif
                                                        @if($commission->type != 'Fixed  Multiple')
                                                        <li><a class="dropdown-item" href="" id="fixed_multiple">Multiple</a></li>
                                                        @endif
                                                        @else
                                                        <li><a class="dropdown-item" href="" id="fixed_single" >Single</a></li>
                                                        <li><a class="dropdown-item" href="" id="fixed_dual">Dual</a></li>
                                                        <li><a class="dropdown-item" href="" id="fixed_multiple">Multiple</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group dropend">
                                                    <button type="button"
                                                        class="btn dropdown-toggle dropdown_percentage"
                                                        aria-expanded="false">
                                                        Percentage
                                                    </button>
                                                    <ul class="dropdown-menu percentage_dropmenu">
                                                    @if(isset($commission))
                                                        @if($commission->type != 'Percentage Single' )
                                                        <li><a class="dropdown-item" href="" id="percentage_single">Single</a></li>
                                                        @endif
                                                        @if($commission->type != 'Percentage Multiple')
                                                        <li><a class="dropdown-item" href="" id="percentage_multiple">Multiple</a></li>
                                                        @endif
                                                        @else
                                                        <li><a class="dropdown-item" href="" id="percentage_single">Single</a></li>
                                                        <li><a class="dropdown-item" href="" id="percentage_multiple">Multiple</a></li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fixed_single_value_show" style="display:none;">
                                <div class="col-md-4">
                                    <label for="fixed_single_value">
                                        <p style="font-weight: bold;font-size: 15px;">Fixed Commission Single Value:</p>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_single_value" name="fixed_single_value"
                                            type="number" step="any" placeholder="Fixed Single Commission Value">
                                    </div>
                                </div>
                            </div>
                            <div id="fixed_dual_value_show" style="display:none;">
                                <div class="row" style="">
                                    <div class="col-md-11">
                                        <p style="font-weight: bold;font-size: 15px;">Fixed Commission Dual Value:</p>
                                    </div>
                                    <div class="col-md-1 mb-2" align="right">
                                        <a class="btn btn-primary" href="" id="add_row">
                                            <p style="font-weight: bold;font-size: 15px;">+</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-3" id="dual_data">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_min_value"
                                                name="fixed_dual_min_value[]" type="number" step="any"
                                                placeholder="Minimum Value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_max_value"
                                                name="fixed_dual_max_value[]" type="number" step="any"
                                                placeholder="Maximum Value">
                                        </div>
                                    </div>
                                    <div class="col-md-1" align="center">
                                        <p style="font-weight: bold;font-size: 15px;">=</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" id="fixed_dual_commission_value"
                                                name="fixed_dual_total_value[]" type="number" step="any"
                                                placeholder="Commission Value">
                                        </div>
                                    </div>
                                    <div class="col-md-1 offset-1" align="right">
                                        <a class="btn btn-danger" href="" id="removeRow">
                                            <p style="font-weight: bold;font-size: 15px;">-</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fixed_multiple_value_show" style="display:none;">
                                <p style="font-weight: bold;font-size: 15px;">Fixed Commission Multiple Value:</p>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_multiple_newuser_value"
                                            name="fixed_multiple_newuser_value" type="number" step="any"
                                            placeholder="Fixed Multiple New User Commission Value">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" id="fixed_multiple_olduser_value"
                                            name="fixed_multiple_olduser_value" type="number" step="any"
                                            placeholder="Fixed Multiple Old User Commission Value">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="percentage_single_value_show" style="display:none;">
                                <div class="col-md-4">
                                    <p style="font-weight: bold;font-size: 15px;">Percentage Commission Single Value:</p>
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_single_value"
                                            name="percentage_single_value" type="number" step="any"
                                            placeholder="Percentage Single Commission Value">
                                        <span class="input-group-text">%</span>

                                    </div>
                                </div>
                            </div>
                            <div class="row" id="percentage_multiple_value_show" style="display:none;">
                                <p style="font-weight: bold;font-size: 15px;">Percentage Commission Multiple Value:</p>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_multiple_newuser_value"
                                            name="percentage_multiple_newuser_value" type="number" step="any"
                                            placeholder="Percentage Multiple New User Commission Value">
                                        <span class="input-group-text">%</span>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input class="form-control" id="percentage_multiple_olduser_value"
                                            name="percentage_multiple_olduser_value" type="number" step="any"
                                            placeholder="Percentage Multiple Old User Commission Value">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-5 col-md-2">
                                    <button class="btn btn-success" id="update" type="button">Update</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('#update').click(async function(event) {
    Swal.fire({
        title: 'Are you sure to Update the brand?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#brand_form").submit();
        }
    })
});
</script>
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#img").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
    $('#removeRow').css('display','none');
$(document).ready(function() {
    $("#change_commission").click(function() {
        event.preventDefault();
        $(".change_commission").show();
        $(this).hide();
        $(".exsit_commission").hide();

    });
    $("#add_change_commission").click(function() {
        event.preventDefault();
        $(".change_commission").show();
        $(this).hide();
        $(".exsit_commission").hide();

    });
    $(".dropdown_main").click(function() {
        $(".main_dropmenu").show();
    });
    $(".dropdown_fix").click(function() {
        $(".fix_dropmenu").show();
        $(".percentage_dropmenu").hide();
    });
    $(".dropdown_percentage").click(function() {
        $(".percentage_dropmenu").show();
        $(".fix_dropmenu").hide();

    });
    $("#fixed_single").click(function() {
        event.preventDefault();
        $("#fixed_single_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");

    });

    $("#fixed_dual").click(function() {
        event.preventDefault();
        $("#fixed_dual_value_show").show();
        $("#fixed_single_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_single_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");

    });

    $("#fixed_multiple").click(function() {
        event.preventDefault();
        $("#fixed_multiple_value_show").show();
        $("#fixed_single_value_show, #fixed_dual_value_show, #percentage_multiple_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_single_value_show, #fixed_dual_value_show, #percentage_multiple_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#percentage_single").click(function() {
        event.preventDefault();
        $("#percentage_single_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #fixed_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #percentage_multiple_value_show, #fixed_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#percentage_multiple").click(function() {
        event.preventDefault();
        $("#percentage_multiple_value_show").show();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #fixed_single_value_show, #percentage_single_value_show, .dropdown-menu")
            .hide();
        $("#fixed_dual_value_show, #fixed_multiple_value_show, #fixed_single_value_show, #percentage_single_value_show")
            .find("input[type=number]").val("");
    });

    $("#add_row").click(function() {
        event.preventDefault();
        var form = $("#dual_data").eq(0).clone();
        form.find("input[type=number]").val("");
        form.show().insertBefore("#dual_data");
        $('#removeRow').css('display','block');

        // var $input = $('<input type="button" value="new button" />');
        // $input.appendTo("#removebutton");
    });
    $(document).on('click', '#removeRow', function () {
        event.preventDefault();
            $(this).closest('#dual_data').remove();
        });
});
</script>
@endsection
@else
<script>
window.location.href = "{{route('notfound')}}";
</script>
@endif