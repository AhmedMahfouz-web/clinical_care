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
                                <h6>{{ $meeting->user->first_name . ' ' . $meeting->user->last_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">البريد الاليكترونى: </h6>
                                <h6>{{ $meeting->user->email }}</h6>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الهاتف: </h6>
                                <h6>{{ $meeting->user->phone }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">الجنس: </h6>
                                <h6>{{ $meeting->user->gender }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">التخصص: </h6>
                                <h6>{{ $meeting->profession }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">ملاحظات: </h6>
                                <h6>{{ $meeting->notes }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">التقارير و الفحوصات: </h6>
                                @foreach ($meeting->files as $file)
                                    <a class="btn" href="{{ asset('files/' . $file->path) }}"
                                        download="{{ $file->name }}">تحميل {{ $file->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">اثبات التحويل :</h6>
                                <img style="width: 300px" src="{{ $meeting->transaction }}" alt="">
                            </div>
                        </div>
                        <hr>
                        @if ($meeting->doctor == null)
                            <div class="row mb-5">
                                <form class="display-block w-100"
                                    action="{{ route('assign doctor meeting', $meeting->id) }}" id="assign_doctor"
                                    method="post">
                                    @csrf
                                    <div class="col-lg-6">
                                        <h6 class="text-muted">تعيين دكتور:</h6>
                                        <select name="doctor_id" id="doctor_id" class="form-control show-tick ms select2"
                                            data-placeholder="تعيين دكتور">
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->first_name . ' ' . $doctor->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="text-muted">تحديد المعاد :</h6>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="datetime-local" name="start_at" class="form-control datetime"
                                                placeholder="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <h6 class="text-muted">الدكتور:</h6>
                                    <h6>{{ $meeting->doctor->first_name . ' ' . $meeting->doctor->last_name }}</h6>
                                </div>
                            </div>
                        @endif
                        <div class="text-left">
                            <a href="{{ route('show meetings') }}" class="btn btn-md btn-secondary">رجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
