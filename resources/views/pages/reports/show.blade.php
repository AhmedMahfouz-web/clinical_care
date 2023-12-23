@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="header">
                        <h2>طلب تقرير</h2>
                    </div>
                    <div class="body row">
                        <div class="col-md-6">
                            <small class="text-muted">الاسم: </small>
                            <p>{{ $report->user->first_name . ' ' . $report->user->last_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">البريد الاليكترونى: </small>
                            <p>{{ $report->user->email }}</p>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <small class="text-muted">الهاتف: </small>
                            <p>{{ $report->user->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">الجنس: </small>
                            <p>{{ $report->user->gender }}</p>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <small class="text-muted">هل تمتلك عائلته مرض مزمن: </small>
                            <p>{{ $report->family_related }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">هل تم تنويمه في المشفي من قبل: </small>
                            <p>{{ $report->sleep_on_hospital }}</p>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <small class="text-muted">هل قام بعم احدي العمليات من قبل: </small>
                            <p>{{ $report->surgery }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">ملاحظات: </small>
                            <p>{{ $report->notes }}</p>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <small class="text-muted">الحالة: </small>
                            <h2>{{ $report->title }}</h2>
                            <p>{!! $report->desc !!}</p>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <small class="text-muted">التقارير و الفحوصات: </small>
                            @foreach ($report->files as $file)
                                <a class="btn" href="{{ asset('files/' . $file->path) }}"
                                    download="{{ $file->name }}">تحميل {{ $file->name }}</a>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <img style="width: 300px" src="{{ $report->transaction }}" alt="">
                        </div>
                        <form action="{{ route('assign doctor', $report->id) }}" id="assign_doctor" method="post">
                            @csrf
                            <div class="col-lg-12">
                                <small class="text-muted">تعيين دكتور:</small>
                                <select class="status-select" name="doctor_id" class="selectpicker" title="تعيين دكتور">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">
                                            {{ $doctor->first_name . ' ' . $doctor->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-md btn-primary" form="assign_doctor">حفظ</button>
                        <a href="{{ route('show reports') }}" class="btn btn-md btn-secondary">الغاء</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
