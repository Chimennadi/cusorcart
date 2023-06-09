@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" id="sort_support" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Support Desk') }}</h5>
            </div>
                        <a  class="btn btn-primary" href="/admin/support_ticket/create/">New Ticket</a>
            <div class="col-md-2">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type ticket code & Enter') }}">
                </div>
            </div>
        </div>
    </form>
    <div class="card-body">
        <table class="aiz-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th data-breakpoints="lg">{{ translate('Ticket ID') }}</th>
                    <th data-breakpoints="lg">{{ translate('Sending Date') }}</th>
                    <th>{{ translate('Subject') }}</th>
                    <th data-breakpoints="lg">{{ translate('User') }}</th>
                    <th data-breakpoints="lg">{{ translate('Status') }}</th>
                    <th data-breakpoints="lg">{{ translate('Last reply') }}</th>
                    <th class="text-right">
                        <!-- {{ translate('Options') }} -->
                    </th>
                    <th class="text-right">
                        <!-- {{ translate('Actions') }} -->
                    </th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($tickets as $key => $ticket)
                    @if ($ticket->user != null)
                            <tr>
                                    <td>#{{ $ticket->code }}</td>
                                    <td>{{ $ticket->created_at }} @if($ticket->viewed == 0) <span class="badge badge-inline badge-info">{{ translate('New') }}</span> @endif</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>
                                        @if ($ticket->status == 'pending')
                                            <span class="badge badge-inline badge-danger">{{ translate('Pending') }}</span>
                                        @elseif ($ticket->status == 'open')
                                            <span class="badge badge-inline badge-secondary">{{ translate('Open') }}</span>
                                        @else
                                            <span class="badge badge-inline badge-success">{{ translate('Solved') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($ticket->ticketreplies) > 0)
                                            {{ $ticket->ticketreplies->last()->created_at }}
                                        @else
                                            {{ $ticket->created_at }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('support_ticket.admin_show', encrypt($ticket->id))}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('View Details') }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                    </td>
                                    
                                    <td class="text-right">
                                        <a href="{{route('support_ticket.admin_delete', $ticket->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm " onclick="document.getElementById('ship_del229').submit()" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                         
                            

                                    
                     

                        
                            </tr>
             
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $tickets->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
