<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="{{ (request()->is("profile/*") || request()->is("user/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">ผู้ใช้งาน</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('profile') }}" class="{{ (request()->is("profile/*") ? 'active' : '') }}">โปรไฟล์</a></li>
                        <li><a href="{{ route('user') }}" class="{{ (request()->is("user/*") ? 'active' : '') }}">พนักงาน</a></li>
                    </ul>
                </li>
                <li class="{{ (request()->is("package/*") || request()->is("status_manage_task/*") || request()->is("setting_system/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">ตารางอ้างอิง</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('package') }}" class="{{ (request()->is("package/*") ? 'active' : '') }}">แพ็คเกจ</a></li>
                        <li><a href="{{ route('status_manage_task') }}" class="{{ (request()->is("status_manage_task/*") ? 'active' : '') }}">สถานะจัดการงาน</a></li>
                        <li><a href="{{ route('setting_system') }}" class="{{ (request()->is("setting_system/*") ? 'active' : '') }}">ตั้งค่าชื่อฟรีแลนซ์</a></li>
                    </ul>
                </li>  
                <li class="{{ (request()->is("manage_task/*") || request()->is("customer_google_adses/*") || request()->is("receipt/*") || request()->is("receipt_company/*") ? 'active' : '') }}">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">ระบบการทำงาน</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('manage_task') }}" class="{{ (request()->is("manage_task/*") ? 'active' : '') }}">จัดการงาน</a></li>
                        <li><a href="{{ route('customer_google_adses') }}" class="{{ (request()->is("customer_google_ads/*") ? 'active' : '') }}">ลูกค้า google ads</a></li>
                        <li><a href="{{ route('receipt') }}" class="{{ (request()->is("receipt/*") ? 'active' : '') }}">จัดเก็บใบเสร็จลูกค้า</a></li>
                        <li><a href="{{ route('receipt_company') }}" class="{{ (request()->is("receipt_company/*") ? 'active' : '') }}">จัดเก็บใบเสร็จบริษัท</a></li>
                    </ul>
                </li>  
                <!--                <li class="{{ (request()->is("report_manage_task/*") || request()->is("report_customer_google_ads/*")  ? 'active' : '') }}">
                                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">รายงาน</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="{{ route('report_manage_task') }}" class="{{ (request()->is("report_manage_task/*") ? 'active' : '') }}">ตารางจัดการงาน </a></li>
                                        <li><a href="{{ route('report_customer_google_ads') }}" class="{{ (request()->is("report_customer_google_ads/*") ? 'active' : '') }}">ตารางลูกค้า google ads </a></li>
                                    </ul>
                                </li>-->
            </ul>
        </nav>
    </div>
    <div class="sidebar-footer">
        <a href="{{ route('profile') }}" class="link" data-toggle="tooltip" title="โปรไฟล์"><i class="ti-user"></i></a>
        <a class="link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" 
           data-toggle="tooltip" title="ล้อกเอ้า">
            <i class="mdi mdi-power"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</aside>