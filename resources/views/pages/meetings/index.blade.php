<!-- resources/views/meetings.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Meetings</h1>

        <div id="meetings-container">
            <!-- Display meetings here -->
        </div>
    </div>

    <script>
        // Initial data load using AJAX
        function loadData() {
            $.ajax({
                url: '/initial-meetings',
                method: 'GET',
                success: function(data) {
                    // Update the UI with initial meetings
                    console.log('Initial meetings:', data.meetings);
                    // You can use JavaScript to update the UI, e.g., appending initial meetings to the list
                },
                complete: function() {
                    // Start listening for real-time updates
                    listenForUpdates();
                }
            });
        }

        // Listen for real-time updates using Laravel Echo
        function listenForUpdates() {
            window.Echo.channel('meetings')
                .listen('MeetingScheduled', (event) => {
                    // Update the UI with new meetings
                    console.log('New meeting scheduled:', event.meeting);
                    // You can use JavaScript to update the UI, e.g., appending new meetings to the list
                });
        }

        $(document).ready(function() {
            // Start by loading initial data
            loadData();
        });
    </script>
@endsection
