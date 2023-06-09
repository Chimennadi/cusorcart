@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6">{{translate('Partner Register')}}</h3>
    </div>
    <div class="card-body" style="overflow-x: scroll;">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Email')}}</th>
                    <th data-breakpoints="lg">{{translate('Password')}}</th>
                    <th data-breakpoints="lg">{{translate('Country')}}</th>
                    <th data-breakpoints="lg">{{translate('Address')}}</th>
                    <th data-breakpoints="lg">{{translate('Reg Num')}}</th>
                    <th data-breakpoints="lg">{{translate('Website')}}</th>
                    <th data-breakpoints="lg">{{translate('Person Phone')}}</th>
                    <th data-breakpoints="lg">{{translate('Person Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Years')}}</th>
                     <th data-breakpoints="lg">{{translate('Service Type')}}</th>
                    <th data-breakpoints="lg">{{translate('Status')}}</th>
                       <th data-breakpoints="lg">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regs as $reg)
                        <tr>
                            <td>#</td>
                            <td>{{$reg->name}}</td>
                            <td>{{$reg->email}}</td>
                            <td>{{$reg->password_text}}</td>
                            <td>{{$reg->reg_country }}</td>
                            <td>{{$reg->address}}</td>
                            <td>{{$reg->reg_num}}</td>
                            <td>{{$reg->website}}</td>
                            <td>{{$reg->per_phone}}</td>
                            <td>{{$reg->per_name}}</td>
                            <td>{{$reg->years}}</td>
                            <td>{{$reg->ser_type}}</td>
                           @if($reg->status == 'reject')
                             <td> <span class="badge badge-inline badge-danger">{{ $reg->status }}</span> </td>
                           @elseif($reg->status == 'ban')
                             <td> <span class="badge badge-inline badge-info">{{ $reg->status }}</span> </td>
                           @elseif($reg->status == 'suspend')
                             <td> <span class="badge badge-inline badge-warning">{{ $reg->status }}</span> </td>
                           @else
                            <td> <span class="badge badge-inline badge-success">{{ $reg->status }}</span> </td>
                            @endif
                           <td class="footable-last-visible" style="display: table-cell;">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-circle btn-soft-primary btn-icon dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                      <i class="las la-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                        <a href="{{route('logistic.profile',$reg->id)}}"  class="dropdown-item">
                                          Edit this Profile
                                        </a>
                                       
                                        <a href="#" onclick="document.getElementById('approve{{$reg->id}}').submit()" class="dropdown-item">
                                          Approve
                                        </a>
                                        <a href="#" onclick="document.getElementById('reject{{$reg->id}}').submit()" class="dropdown-item">
                                          Reject
                                        </a>
                                        <a href="#" onclick="document.getElementById('ban{{$reg->id}}').submit()" class="dropdown-item">
                                          Ban
                                        </a>
                                        <a href="#" onclick="document.getElementById('suspend{{$reg->id}}').submit()" class="dropdown-item">
                                          Suspend
                                        </a>
                                        
                                        <form action="{{ URL::to('partner-approve') }}" method="POST" id="approve{{$reg->id}}">
                                    @csrf
                                     <input type="hidden" name="id" value="{{ $reg->id }}">
                                     <input type="hidden" name="status" value="approve">
                                </form>
                                 <form action="{{ URL::to('partner-approve') }}" method="POST" id="reject{{$reg->id}}">
                                    @csrf
                                     <input type="hidden" name="id" value="{{ $reg->id }}">
                                     <input type="hidden" name="status" value="reject">
                                </form>
                                 <form action="{{ URL::to('partner-approve') }}" method="POST" id="ban{{$reg->id}}">
                                    @csrf
                                     <input type="hidden" name="id" value="{{ $reg->id }}">
                                     <input type="hidden" name="status" value="ban">
                                </form>
                                 <form action="{{ URL::to('partner-approve') }}" method="POST" id="suspend{{$reg->id}}">
                                    @csrf
                                     <input type="hidden" name="id" value="{{ $reg->id }}">
                                     <input type="hidden" name="status" value="suspend">
                                </form>
                                
                                    </div>
                                </div>
                            </td>
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
