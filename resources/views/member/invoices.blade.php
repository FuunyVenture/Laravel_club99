{{--this view is not used--}}
@extends('layouts.frontend.app')

@section('title', 'Invoices')

@section('css')

@endsection

@section('content')
    {{--content header--}}
    <h2 class="page-head-line">Invoices</h2>
    {{--end content header--}}
    {{--main content--}}
    <div class="row">
        <div class="col-md-12">
            @if(count($invoices) > 0)
                    <table class="table">
                        <thead>
                        <th>Invoice Date</th>
                        <th>Invoice Amount</th>
                        <th>Download</th>
                        </thead>
                    
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td>{{ $invoice->total() }}</td>
                                <td>
                                    <a href="{{ URL::to('member/subscription/download-invoice/'.$invoice->id ) }}">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <h5>You don't have invoices.</h5>
            @endif
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
