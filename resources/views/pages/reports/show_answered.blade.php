@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="header">
                        <h2>طلب تقرير</h2>
                    </div>
                    <div class="body flex">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الاسم: </h6>
                                <h6>{{ $report->user->first_name . ' ' . $report->user->last_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">البريد الاليكترونى: </h6>
                                <h6>{{ $report->user->email }}</h6>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الهاتف: </h6>
                                <h6>{{ $report->user->phone }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">الجنس: </h6>
                                <h6>{{ $report->user->gender }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">هل تمتلك عائلته مرض مزمن: </h6>
                                <h6>{{ $report->family_related }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">هل تم تنويمه في المشفي من قبل: </h6>
                                <h6>{{ $report->sleep_on_hospital }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">هل قام بعم احدي العمليات من قبل: </h6>
                                <h6>{{ $report->surgery }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">ملاحظات: </h6>
                                <h6>{{ $report->notes }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">التخصص: </h6>
                                <h6>{{ $report->profession }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">الحالة: </h6>
                                <h2>{{ $report->title }}</h2>
                                <div>{!! $report->desc !!}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">التقارير و الفحوصات: </h6>
                                @foreach ($report->files as $file)
                                    <a class="btn" href="{{ asset('files/' . $file->path) }}"
                                        download="{{ $file->name }}">تحميل {{ $file->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">اثبات التحويل :</h6>
                                <img style="width: 300px" src="{{ $report->transaction }}" alt="">
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-5">
                            <div class="col-lg-6">
                                <h6 class="text-muted">الدكتور:</h6>
                                <h6>{{ $report->doctor->first_name . ' ' . $report->doctor->last_name }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">رد الدكتور: </h6>
                                <div>{!! $report->doctor_comment !!}</div>
                            </div>
                        </div>
                        <div class="text-left">
                            <a href="{{ route('show answered reports') }}" class="btn btn-md btn-secondary">رجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
