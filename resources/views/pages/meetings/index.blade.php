<!-- resources/views/meetings.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="modal fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title_6">صورة التحويل</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <img style="max-width:100%;" src="" id="modal_image" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md " data-dismiss="modal">الغاء</button>
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
                                <h2>قائمة المواعيد</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>المستخدم</th>
                                                <th>الدكتور</th>
                                                <th>صورة التحويل</th>
                                                <th>المبلغ</th>
                                                <th>الحالة</th>
                                                <th>الوقت</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($meetings as $index => $meeting)
                                                <tr>
                                                    <td><span>{{ $meeting->user->first_name . ' ' . $meeting->user->last_name }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($meeting->doctor_id == null)
                                                            <span class="muted-text">لم يحدد بعد</span>
                                                        @else
                                                            <span>{{ $meeting->doctor->first_name . ' ' . $meeting->doctor->last_name }}</span>
                                                        @endif
                                                    </td>
                                                    <td><span><img data-toggle="modal" data-target="#modal_5"
                                                                class="meeting_transaction"
                                                                style="max-height: 100px; max-width: 100px"
                                                                src="{{ asset('images/transaction/' . $meeting->image) }}"
                                                                alt=""></span>
                                                    </td>
                                                    <td><span>{{ $meeting->price }}</span></td>
                                                    <td>
                                                        <form class="status-form"
                                                            action="{{ route('update status', $meeting->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <select class="status-select" name="status"
                                                                class="selectpicker" title="حالة الميتينج">
                                                                <option value="pending"
                                                                    {{ $meeting->status == 'pending' ? 'selected' : '' }}>
                                                                    قيد
                                                                    الانتظار</option>
                                                                <option value="approve"
                                                                    {{ $meeting->status == 'approve' ? 'selected' : '' }}>
                                                                    سماح
                                                                </option>
                                                                <option value="cancelled"
                                                                    {{ $meeting->status == 'cancelled' ? 'selected' : '' }}>
                                                                    رفض</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td><span>{{ $meeting->start_at }}</span></td>

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
        let image = document.getElementsByClassName('meeting_transaction');
        const modal_image = document.getElementById('modal_image');
        for (let i = 0; i < image.length; i++) {
            image[i].addEventListener('click', function() {
                console.log('clicked')
                modal_image.setAttribute('src', image[i].getAttribute('src'));
            })

        };

        let select = document.getElementsByClassName('status-select');
        let form = document.getElementsByClassName('status-form');
        for (let i = 0; i < select.length; i++) {
            select[i].addEventListener('change', function() {
                console.log('clicked')
                form[i].submit();
            })

        };
    </script>
@endsection


{{-- @section('script')
    <script type="module">
        import Echo from "laravel-echo"
        import Pusher from 'pusher-js';
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: import.meta.env.VITE_PUSHER_APP_KEY,
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
            wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST :
                `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
            wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
            wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
            forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
            enabledTransports: ['ws', 'wss'],
        });
    </script>
    <script defer>
        // // Initial data load using AJAX
        // function loadData() {
        //     $.ajax({
        //         url: '/initial-meetings',
        //         method: 'GET',
        //         success: function(data) {
        //             // Update the UI with initial meetings
        //             console.log('Initial meetings:', data.meetings);
        //             // You can use JavaScript to update the UI, e.g., appending initial meetings to the list
        //         },
        //         complete: function() {
        //             // Start listening for real-time updates
        //             listenForUpdates();
        //         }
        //     });
        // }

        // // Listen for real-time updates using Laravel Echo
        // function listenForUpdates() {
        //     window.Echo.channel('meetings')
        //         .listen('MeetingScheduled', (event) => {
        //             // Update the UI with new meetings
        //             console.log('New meeting scheduled:', event.meeting);
        //             // You can use JavaScript to update the UI, e.g., appending new meetings to the list
        //         });
        // }

        // $(document).ready(function() {
        //     // Start by loading initial data
        //     loadData();
        // });
        Echo.channel('meetings')
            .listen('MeetingScheduled', (e) => console.log('RealTimeMessage: ' + e.meeting));
    </script>
@endsection --}}
