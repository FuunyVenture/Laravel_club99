{{--notifications are messages generated by the system automatically for member
This view generates a GUI with a list of notifications in the member dashboard--}}
@extends('layouts.member.app')

@section('title', 'Notifications')

@section('css')
@endsection

@section('content')
    {{--open section--}}
    <section class="content">
        {{--content header--}}
        <div class="row">
            <div class="col-xs-9 col-md-6 col-lg-9 page-head-line">Notifications</div>
            <div class="col-xs-12 col-md-6 col-lg-3 filter-search">
                <div class="col-xs-4 text-right" style="top:8px;">Search</div>
                <div class="col-xs-8 padding0">
                    <input type="text" class="search" id="notificationsInput" style="width:100%">
                </div>
            </div>
        </div>
        {{--end content header--}}
        {{--main content--}}
        @if($notifications->count() == 0)
            <p class="size50 os-regular">You don't have any notifications.</p>
        @else
            <div id="items" class="new-box notification-table">
                <ul class="border-bottom list">
                    @foreach($notifications as $notification)
                        <li>
                            <a class="item" href="{{url('member/notifications/'.$notification->id)}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($notification->read == 0)
                                            <span class="label label-danger">New</span>
                                        @endif
                                        <div class="dark-grey">
                                            {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                        </div>
                                        <div class="notification">
                                            @if(isset(json_decode($notification->extra, true)['message']))
                                                {{json_decode($notification->extra, true)['message']}}
                                            @else
                                                Unknown notification
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--end main content--}}
        @endif
    </section>
    {{--end section--}}
@endsection

@section('js')


    <script type="text/javascript">
        /* Handle notifications' search. */
        $(document).ready(function () {
            var options = {
                valueNames: ['item']
            };

            var notificationsSearch = new List('items', options);
            $('#notificationsInput').keyup(function () {
                notificationsSearch.search($(this).val());
            })
        });
    </script>
@endsection