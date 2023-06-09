@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Feedback')}}</h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Name')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th>{{translate('Subject')}}</th>
                    <th data-breakpoints="lg">{{ translate('Message') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $feedback->name }}</td>
                            <td>
                               {{$feedback->email}}
                            </td>
                            <td>
                                {{ $feedback->subject }}
                            </td>
                            <td>{{ $feedback->message }} </td>
                        </tr>
                   
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $feedbacks->links() }}
        </div>
    </div>
</div>

@endsection
