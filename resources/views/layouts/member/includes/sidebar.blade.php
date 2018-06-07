<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ Request::is('member/dashboard') || Request::is('member/dashboard/*') ? 'active': '' }}">
                <a href="{{ url('member/dashboard') }}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('member/profile') || Request::is('member/profile/*') ? 'active': '' }}">
                <a href="{{ url('member/profile/') }}">
                    <span>My profile</span>
                </a>
            </li>
            <li class="{{ Request::is('member/shop') || Request::is('member/shop/*')? 'active': '' }}">
                <a href="{{ url('member/shop') }}">
                    <span>Shop</span>
                </a>
            </li>
            <li class="{{ Request::is('member/shipments') || Request::is('member/shipments/*') ? 'active': '' }}">
                <a href="{{ url('member/shipments') }}">
                    <span>Shipments</span>
                </a>
            </li>
            <li class="{{ Request::is('member/invoices') || Request::is('member/invoices/*') ? 'active': '' }}">
                <a href="{{ url('member/invoices') }}">
                    <span>Invoices</span>
                </a>
            </li>
            <li class="{{ Request::is('member/senders') || Request::is('admin/sender/*') ? 'active': '' }}">
                <a href="{{ url('member/senders') }}">
                    <span>Senders</span>
                </a>
            </li>
            <li class="{{ Request::is('member/help') || Request::is('member/help/*') ? 'active': '' }}">
                <a href="{{ url('member/help') }}">
                    <span>Help</span>
                </a>
            </li>
            <li class="{{ Request::is('member/notifications') || Request::is('member/notifications/*') ? 'active': '' }}">
                <a href="{{ url('member/notifications') }}">
                    <span>Notifications</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->