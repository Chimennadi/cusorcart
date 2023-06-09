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
                    <th data-breakpoints="lg">{{translate('First Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Last Name')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th>{{translate('Order Code')}}</th>
                    <th>{{translate('Did the packaging protect your items adequately')}}</th>
                    <th>{{translate('ratio')}}</th>
                      <th>{{translate('Was the box size and packaging appropriate for the items?')}}</th>
                    <th>{{translate('How Would Rate Your Experience Shipping With Us?')}}</th>
                    <th data-breakpoints="lg">{{ translate('Message') }}</th>
                        <th>{{translate('Upload a photo')}}</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $feedback->first }}</td>
                            <td>
                               {{$feedback->last}}
                            </td>
                            
                            <td>
                               {{$feedback->email}}
                            </td>
                            
                            
                            <td>
                               {{$feedback->ordercode}}
                            </td>
                            
                             
                            <td>
                               {{$feedback->protect}}
                            </td>
                            
                             
                            <td>
                               {{$feedback->ratio}}
                            </td>
                            
                            <td>
                                {{ $feedback->item_radio }}
                            </td>
                            
                            
                               
                            <td>
                                {{ $feedback->package_select }}
                            </td>
                            
                            
                            
                            <td>{{ $feedback->message }} </td>
                            
                            
                              <td><img src="http://express.{{ route('home') }}/public/images/Feedback/{{$feedback->file_upload}}"  width=100 /></td>
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
