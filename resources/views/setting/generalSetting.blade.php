@extends('layouts.app')

@section('content')
    <div class="container">
        <x-breadcrumb :breadcrumbs="[['title' => 'Settings', 'url' => route('setting.index')], ['title' => 'General Settings']]" />


        <div class="card shadow mt-3 main-card">

            <div class="card-body">
                <form method="post" action="{{ route('doctorino_settings.store') }}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="system_name">{{ __('System Name') }}
                                    (Full)</label>
                                <input type="text" class="form-control" id="system_name" name="system_name"
                                    value="{{ get_option('system_name') }}" required>
                                {{ csrf_field() }}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="system_name">{{ __('System Name') }}
                                    (Short)</label>
                                <input type="text" class="form-control" id="system_name" name="system_name_short"
                                    value="{{ get_option('system_name_short') }}" required>
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="Title">{{ __('Docteur Name') }}</label>
                                <input type="title" class="form-control" id="Title" name="title"
                                    value="{{ get_option('title') }}" required>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="Address">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="Address" name="address"
                                    value="{{ get_option('address') }}" required>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="Phone">{{ __('Phone') }} </label>
                                <input type="text" class="form-control" id="Phone" name="phone"
                                    value="{{ get_option('phone') }}" required>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="hospital_email">{{ __('Hospital Email') }}</label>
                                <input type="text" class="form-control" id="hospital_email" name="hospital_email"
                                    value="{{ get_option('hospital_email') }}" required>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="logo">{{ __('Logo') }}</label>
                                <small>Max width:300 / Max height:100</small>
                                <label for="file-upload" class="custom-file-upload w-100">
                                    <i class="fa fa-cloud-upload"></i> Select Logo to Upload
                                </label>
                                <input type="file" class="form-control" id="file-upload" name="logo">

                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            {{-- <div class="form-group"> --}}

                                <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                            {{-- </div> --}}
                        </div>
                    </div>






                    {{-- <div class="form-group">
                        <label for="Language" class="col-sm-3 col-form-label">{{ __('Language') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="language" id="Language" required>
                                <option value="{{ get_option('language') }}">
                                    {{ $language[get_option('language')] }}</option>
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">Dutch</option>
                                <option value="it">Italian</option>
                                <option value="pt">Portuguese</option>
                                <option value="in">Hindi</option>
                                <option value="bn">Bengali</option>
                                <option value="id">Indonesian</option>
                                <option value="tr">Turkish</option>
                                <option value="ru">Russian</option>
                                <option value="ar">Arabic</option>
                            </select>
                        </div>
                    </div> --}}


                </form>
            </div>
        </div>
    </div>
@endsection
