@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Переписка з пацієнтом: {{ $patient->name }}</h3>
    <div class="chat-container">
        @foreach($messages->groupBy(function($msg) {
            return $msg->created_at->format('Y-m-d');
        }) as $date => $dayMessages)
            <div class="chat-day">
                <h5>{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</h5>

                @foreach($dayMessages as $message)
                    <div class="message {{ $message->user_id ? 'outbound' : 'inbound' }}">
                        <strong>{{ $message->user_id ? $message->user->name : $patient->name }}</strong>:
                        <span>{{ $message->message_text }}</span>
                        <span class="time">{{ $message->created_at->format('H:i') }}</span>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
.chat-container {
    max-width: 600px;
    margin: auto;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
}
.chat-day {
    margin-bottom: 20px;
}
.message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    background-color: #f0f0f0;
}
.message.outbound {
    text-align: right;
    background-color: #d1e7dd;
}
.message.inbound {
    text-align: left;
    background-color: #f8d7da;
}
.time {
    font-size: 0.8em;
    color: #888;
}
</style>