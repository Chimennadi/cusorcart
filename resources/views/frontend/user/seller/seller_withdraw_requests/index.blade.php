@extends('frontend.layouts.user_panel')

@section('panel_content')

    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Money Withdraw') }}</h1>
        </div>
      </div>
    </div>

    <div class="row gutters-10">
        <div class="col-md-4 mb-3 ml-auto" >
            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
              <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                  <i class="las la-dollar-sign la-2x text-white"></i>
              </span>
              <div class="px-3 pt-3 pb-3">
                  <div class="h4 fw-700 text-center">{{ single_price(Auth::user()->seller->admin_to_pay) }}</div>
                  <div class="opacity-50 text-center">{{ translate('Pending Balance') }}</div>
              </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mr-auto" >
          <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_request_modal()">
              <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                  <i class="las la-plus la-3x text-white"></i>
              </span>
              <div class="fs-18 text-primary">{{ translate('Send Withdraw Request') }}</div>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Withdraw Request history')}}</h5>
        </div>
          <div class="card-body">
              <table class="table aiz-table mb-0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>{{ translate('Date') }}</th>
                          <th>{{ translate('Amount')}}</th>
                          <th data-breakpoints="lg">{{ translate('Status')}}</th>
                          <th data-breakpoints="lg">{{ translate('Message')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($seller_withdraw_requests as $key => $seller_withdraw_request)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ date('d-m-Y', strtotime($seller_withdraw_request->created_at)) }}</td>
                              <td>{{ single_price($seller_withdraw_request->amount) }}</td>
                              <td>
                                  @if ($seller_withdraw_request->status == 1)
                                      <span class=" badge badge-inline badge-success" >{{ translate('Paid')}}</span>
                                  @else
                                      <span class=" badge badge-inline badge-info" >{{ translate('Pending')}}</span>
                                  @endif
                              </td>
                              <td>
                                  {{ $seller_withdraw_request->message }}
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="aiz-pagination">
                  {{ $seller_withdraw_requests->links() }}
              </div>
          </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Send A Withdraw Request') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (Auth::user()->seller->admin_to_pay > 5)
                    <form class="" action="{{ route('withdraw_requests.store') }}" method="post">
                        @csrf
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ translate('Amount')}} <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" lang="en" class="form-control mb-3" name="amount" min="1" max="{{ Auth::user()->seller->admin_to_pay }}" placeholder="{{ translate('Amount') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{ translate('Message')}}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="message" rows="8" class="form-control mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Send')}}</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="p-5 heading-3">
                            {{ translate('You do not have enough balance to send withdraw request') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function show_request_modal(){
            $('#request_modal').modal('show');
        }

        function show_message_modal(id){
            $.post('{{ route('withdraw_request.message_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#message_modal .modal-content').html(data);
                $('#message_modal').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endsection
