@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>المستخدمين</h6>
                        <h2>{{ $users_count }}</h2>
                        <small>اجمالي عدد المستخدمين</small>
                        <div class="progress mb-0">
                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <a href="{{ route('show hospitals') }}">
                        <div class="body">
                            <h6>المستشفيات</h6>
                            <h2>{{ $hospitals_count }} </h2>
                            <small>اجمالي عدد المستشفيات</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>الاطباء</h6>
                        <h2>{{ $doctors_count }} </h2>
                        <small>اجمالي عدد الاطباء</small>
                        <div class="progress mb-0">
                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0"
                                aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <a href="{{ route('show tests') }}">
                        <div class="body">
                            <h6>التحاليل و الاشعات</h6>
                            <h2>{{ $tests_count }}</h2>
                            <small>اجمالي عدد التحاليل و الاشعات المتاحة</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>المستخدمين</h6>
                        <h2>{{ $users_count }}</h2>
                        <small>اجمالي عدد المستخدمين</small>
                        <div class="progress mb-0">
                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <a href="{{ route('show hospitals') }}">
                        <div class="body">
                            <h6>المستشفيات</h6>
                            <h2>{{ $hospitals_count }} </h2>
                            <small>اجمالي عدد المستشفيات</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>الاطباء</h6>
                        <h2>{{ $doctors_count }} </h2>
                        <small>اجمالي عدد الاطباء</small>
                        <div class="progress mb-0">
                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0"
                                aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <a href="{{ route('show tests') }}">
                        <div class="body">
                            <h6>التحاليل و الاشعات</h6>
                            <h2>{{ $tests_count }}</h2>
                            <small>اجمالي عدد التحاليل و الاشعات المتاحة</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
