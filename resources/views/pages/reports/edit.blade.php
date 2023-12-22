@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>تعديل الاشعة او التحليل</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('update test', $test->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label for="name" class="mr-1 control-label">اسم الاشعة او التحليل</label>
                                    <input type="text" value="{{ $test->name }}" id="name" name="name"
                                        class="form-control" placeholder="اسم التخصص" aria-label="name"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="type" class="mr-1 control-label">النوع</label>
                                    <select name="type" class="selectpicker" title="اختر النوع">
                                        <option value="اشعة" {{ $test->type == 'اشعة' ? 'selected' : '' }}>
                                            اشعة
                                        </option>
                                        <option value="تحليل" {{ $test->type == 'تحليل' ? 'selected' : '' }}>
                                            تحليل
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show tests') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
