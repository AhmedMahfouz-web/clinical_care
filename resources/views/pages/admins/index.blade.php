@extends('layouts.dashboard')

@section('content')
    <div class="modal modal-danger fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title_6">احترس !</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="fa fa-exclamation-circle fa-4x"></i>
                        <h4 class="heading mt-4">هل انت متأكد من حذف الاداري ؟</h4>
                        <p>سيتم حذف الاداري للموافقة اضغط "حذف"</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md " data-dismiss="modal">الغاء</button>
                    <button type="submit" form="" id="delete_btn" class="btn btn-md btn-secondary">حذف</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>قائمة الاداريين</h2>
                                <div class="text-left">
                                    <a href="{{ route('create admin') }}" class="btn btn-md btn-primary ">اضافة اداري</a>
                                </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>البريد الالكتروني</th>
                                                <th>الوظيفة</th>
                                                <th>تاريخ الانضمام</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $index => $admin)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><span>{{ $admin->name }}</span></td>
                                                    <td><span class="text-info">{{ $admin->email }}</span></td>
                                                    <td>
                                                        @if ($admin->role == 'admin')
                                                            اداري
                                                        @else
                                                            صاحب المنشأة
                                                        @endif
                                                    </td>
                                                    <td>{{ $admin->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('edit admin', $admin->id) }}"
                                                            class="btn btn-warning btn-md"><i
                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                        <form class="d-inline" id="form-{{ $admin->id }}"
                                                            action="{{ route('delete admin', $admin) }}" method="post">
                                                            @csrf
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#modal_5" data-form="form-{{ $admin->id }}"
                                                                class="btn btn-danger btn-md delete_btn"><i
                                                                    class="fa-regular fa-trash-can"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            let delete_btn = document.getElementsByClassName('delete_btn');
            const submit_btn = document.getElementById('delete_btn');
            for (let i = 0; i < delete_btn.length; i++) {
                delete_btn[i].addEventListener('click', function() {
                    console.log(delete_btn[i].getAttribute('data-form'))
                    submit_btn.setAttribute('form', delete_btn[i].getAttribute('data-form'));
                })

            };
        </script>
    @endsection
