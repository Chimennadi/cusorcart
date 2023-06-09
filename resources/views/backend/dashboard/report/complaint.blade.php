@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Complaints')}}</h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Name')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th>{{translate('Subject')}}</th>
                    <th data-breakpoints="lg">{{ translate('Reason') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $complaint->name }}</td>
                            <td>
                               {{$complaint->email}}
                            </td>
                            <td>
                                {{ $complaint->subject }}
                            </td>
                            <td>{{ $complaint->reason }} </td>
                        </tr>
                   
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $complaints->links() }}
        </div>
    </div>
</div>

@endsection
