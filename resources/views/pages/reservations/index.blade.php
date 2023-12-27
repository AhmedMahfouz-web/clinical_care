@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>طلبات اجراء الفحوصات</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المريض</th>
                                                <th>الفحص</th>
                                                <th>المستشفي</th>
                                                <th>التاريخ</th>
                                                <th>الحالة</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations as $index => $reservation)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><span>{{ $reservation->user->first_name . ' ' . $reservation->user->last_name }}</span>
                                                    </td>
                                                    <td><span>{{ $reservation->test->name }}</span></td>
                                                    <td><span>{{ $reservation->hospital->name }}</span></td>
                                                    <td><span>{{ $reservation->date == null ? 'لم يحدد بعد' : $reservation->date }}</span>
                                                    </td>
                                                    <td><span>{{ $reservation->date == null ? 'لم يحدد بعد' : $reservation->date }}</span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-md btn-secondary"
                                                            href="{{ Route('show one reservation', $reservation->id) }}">عرض</a>
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
