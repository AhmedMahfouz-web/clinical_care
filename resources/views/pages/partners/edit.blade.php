@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> اضافة شريك</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('update partner', $partner->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12 mb-3">
                                    <img style="width: 60%; margin: auto"
                                        src="{{ asset('images/partners/' . $partner->image) }}" alt="">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                            id="inputGroupFile02">
                                        <label class="custom-file-label" for="inputGroupFile02">اختر الصورة</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">اختر</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show partners') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
