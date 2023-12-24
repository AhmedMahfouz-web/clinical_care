@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>التقارير المرفقة</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العنوان</th>
                                                <th>المريض</th>
                                                <th>الطبيب</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $index => $report)
                                                <a href="{{ Route('show one report', $report->id) }}">
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td><span>{{ $report->title }}</span></td>
                                                        <td><span>{{ $report->user->first_name . ' ' . $report->user->last_name }}</span>
                                                        </td>
                                                        <td><span>{{ $report->doctor->first_name . ' ' . $report->doctor->last_name }}</span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-md btn-secondary"
                                                                href="{{ Route('show answered report', $report->id) }}">عرض</a>
                                                        </td>
                                                    </tr>
                                                </a>
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
