@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> اضافة مشفي او معمل</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('store hospital') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label for="name" class="mr-1 control-label">اسم المشفي</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="اسم المشفي" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="type" class="mr-1 control-label"> النوع</label>
                                    <select name="type" class="selectpicker" title="اختر النوع">
                                        <option value="مشفي">
                                            مشفي</option>
                                        <option value="معمل">
                                            معمل
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="phone" class="mr-1 control-label">رقم الهاتف</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        placeholder="رقم الهاتف" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="bio" class="mr-1 control-label">نبذة</label>
                                    <input type="text" id="bio" name="bio" class="form-control"
                                        placeholder="نبذة" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="address" class="mr-1 control-label">العنوان</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="العنوان" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="city" class="mr-1 control-label">المدينة</label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        placeholder="المدينة" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show hospitals') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
