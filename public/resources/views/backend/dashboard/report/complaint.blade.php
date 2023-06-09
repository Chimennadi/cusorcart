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
                    <th data-breakpoints="lg">{{translate('Country Name')}}</th>
                      <th>{{translate('Full Name')}}</th>
                    <th>{{translate('Email')}}</th>
                     <th>{{translate('Order Code')}}</th>
                     <th>{{translate('Message')}}</th>
                    <th>{{translate('OutCome')}}</th>
                    <th>{{translate('File Upload')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                   
                        <tr>
                            <td>#</td>
                            <td>{{ $complaint->country }}</td>
                            
                            
                            <td>
                               {{$complaint->full_name}}
                            </td>
                            
                            <td>
                               {{$complaint->email}}
                            </td>
                            <td>
                               {{$complaint->order_code}}
                            </td>
                            
                             <td>
                               {{$complaint->message}}
                            </td>
                            
                            <td>
                                {{ $complaint->outcome }}
                            </td>
                          
                              <td><img src="http://express.{{ route('home') }}/public/images/Feedback/{{$complaint->file_upload}}"  width=100 /></td>
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
