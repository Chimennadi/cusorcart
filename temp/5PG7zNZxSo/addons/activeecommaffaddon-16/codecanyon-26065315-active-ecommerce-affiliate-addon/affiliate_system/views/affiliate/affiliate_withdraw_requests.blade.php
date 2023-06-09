@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Affiliate Withdraw Request')}}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th data-breakpoints="lg">{{translate('Date')}}</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Email')}}</th>
                    <th>{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{translate('Status')}}</th>
                    <th data-breakpoints="lg">{{translate('options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($affiliate_withdraw_requests as $key => $affiliate_withdraw_request)
                @php $status = $affiliate_withdraw_request->status ; @endphp
                    <tr>
                        <td>{{ ($key+1) + ($affiliate_withdraw_requests->currentPage() - 1)*$affiliate_withdraw_requests->perPage() }}</td>
                        <td>{{ $affiliate_withdraw_request->created_at}}</td>
                        <td>{{ $affiliate_withdraw_request->user->name}}</td>
                        <td>{{ $affiliate_withdraw_request->user->email}}</td>
                        <td>{{ single_price($affiliate_withdraw_request->amount)}}</td>
                        <td>
                            @if($status == 1)
                              <span class="badge badge-inline badge-success">{{translate('Approved')}}</span>
                            @elseif($status == 2)
                              <span class="badge badge-inline badge-danger">{{translate('Rejected')}}</span>
                            @else
                              <span class="badge badge-inline badge-info">{{translate('Pending')}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                          @if($status == 0)
                              <a href="#" class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="show_affiliate_withdraw_modal('{{$affiliate_withdraw_request->id}}');" title="{{ translate('Pay Now') }}">
                                  <i class="las la-money-bill"></i>
                              </a>
                              <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="affiliate_withdraw_reject_modal('{{route('affiliate.withdraw_request.reject', $affiliate_withdraw_request->id)}}');" title="{{ translate('Reject') }}">
                                  <i class="las la-trash"></i>
                              </a>
                            @else
                                {{ translate('No Action Available')}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $affiliate_withdraw_requests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

<div class="modal fade" id="affiliate_withdraw_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="affiliate_withdraw_reject_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title h6">{{ translate('Affiliate Withdraw Request Reject')}}</h5>
      <button type="button" class="close" data-dismiss="modal">
      </button>
    </div>
    <div class="modal-body">
      <p>{{translate('Are you sure, You want to reject this?')}}</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
      <a href="#" id="reject_link" class="btn btn-primary">{{ translate('Reject') }}</a>
    </div>
  </div>
  </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function show_affiliate_withdraw_modal(id){
            $.post('{{ route('affiliate_withdraw_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#affiliate_withdraw_modal #modal-content').html(data);
                $('#affiliate_withdraw_modal').modal('show', {backdrop: 'static'});
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }
        function affiliate_withdraw_reject_modal(reject_link){
            $('#affiliate_withdraw_reject_modal').modal('show');
            document.getElementById('reject_link').setAttribute('href' , reject_link);
        }

    </script>
@endsection
