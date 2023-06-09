@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Partner Register')}}</h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg">{{translate('Name')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th>{{translate('Country')}}</th>
                    <th data-breakpoints="lg">{{ translate('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regs as $reg)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $reg->name }}</td>
                            <td>
                               {{$reg->email}}
                            </td>
                            <td>
                                {{ $reg->country }}
                            </td>
                           @if($reg->status == 'Pending')
                            <td> <span class="badge badge-inline badge-danger">{{ $reg->status }}</span> </td>
                            @else
                            <td> <span class="badge badge-inline badge-success">{{ $reg->status }}</span> </td>
                            @endif
                        </tr>
                   
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
              {{ $regs->links() }}
        </div>
    </div>
</div>

@endsection
