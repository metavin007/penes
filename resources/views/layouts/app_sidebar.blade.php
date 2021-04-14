<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            @can('isCEO')
            <ul id="sidebarnav">
                
                <li class="{{ (request()->is("manage_task/*") || request()->is("customer_google_adses/*") || request()->is("receipt/*") || request()->is("receipt_company/*") ? 'active' : '') }}">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-microsoft"></i><span class="hide-menu">ระบบการทำงาน</span></a>
                    <ul aria-expanded="false" class="collapse">
                         <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('note') }}" class="{{ (request()->is("note/*") ? 'active' : '') }}" aria-expanded="false">
                       <i class="me-2 mdi mdi-pencil"></i> จดบันทึกข้อมูล</a>
                    </li>
                     <!--  <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('textbox') }}" class="{{ (request()->is("textbox/*") ? 'active' : '') }}" aria-expanded="false">
                      <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path> กล่องเปล่าๆ</a>
                    </li> -->

                        <li><a href="{{ route('manage_task') }}" class="{{ (request()->is("manage_task/*") ? 'active' : '') }}"> <i class="me-2 mdi mdi-account-circle"></i> วางแผนการทำงาน</a></li>
                        <li><a href="{{ route('customer_google_adses') }}" class="{{ (request()->is("customer_google_ads/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-github-circle"></i> ตารางงานโฆษณา</a></li>
                        <li><a href="{{ route('receipt') }}" class="{{ (request()->is("receipt/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-buffer"></i> ตารางสลิปเปิดงาน</a></li>
                        <li><a href="{{ route('receipt_company') }}" class="{{ (request()->is("receipt_company/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-buffer"></i> ตารางใบเสร็จบริษัท</a></li>
                    </ul>
                </li>
                <li class="{{ (request()->is("package/*") || request()->is("freelance/*") || request()->is("setting_system/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">เพิ่มข้อมูล</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('package') }}" class="{{ (request()->is("package/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> แพ็คเกจ</a></li>
                        <li><a href="{{ route('freelance') }}" class="{{ (request()->is("freelance/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> ฟรีแลนซ์</a></li>
                    </ul>
                </li>  
                <li class="{{ (request()->is("profile/*") || request()->is("user/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">ผู้ใช้งาน</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('profile') }}" class="{{ (request()->is("profile/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> โปรไฟล์</a></li>
                        <li><a href="{{ route('user') }}" class="{{ (request()->is("user/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> พนักงาน</a></li>
                    </ul>
                </li>                          
            </ul>
            @elsecan('isAdmin')
            </li>
                 <ul id="sidebarnav">
                
                <li class="{{ (request()->is("manage_task/*") || request()->is("customer_google_adses/*") || request()->is("receipt/*") || request()->is("receipt_company/*") ? 'active' : '') }}">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-microsoft"></i><span class="hide-menu">ระบบการทำงาน</span></a>
                    <ul aria-expanded="false" class="collapse">
                         <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('note') }}" class="{{ (request()->is("note/*") ? 'active' : '') }}" aria-expanded="false">
                       <i class="me-2 mdi mdi-pencil"></i> จดบันทึกข้อมูล</a>
                    </li>


                        <li><a href="{{ route('manage_task') }}" class="{{ (request()->is("manage_task/*") ? 'active' : '') }}"> <i class="me-2 mdi mdi-account-circle"></i> วางแผนการทำงาน</a></li>
                        <li><a href="{{ route('customer_google_adses') }}" class="{{ (request()->is("customer_google_ads/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-github-circle"></i> ตารางงานโฆษณา</a></li>
                        <li><a href="{{ route('receipt') }}" class="{{ (request()->is("receipt/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-buffer"></i> ตารางสลิปเปิดงาน</a></li>
                        
                    </ul>
                </li>
                <li class="{{ (request()->is("package/*") || request()->is("freelance/*") || request()->is("setting_system/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">เพิ่มข้อมูล</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('package') }}" class="{{ (request()->is("package/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> แพ็คเกจ</a></li>
                        <li><a href="{{ route('freelance') }}" class="{{ (request()->is("freelance/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> ฟรีแลนซ์</a></li>
                    </ul>
                </li>  
                <li class="{{ (request()->is("profile/*") || request()->is("user/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">ผู้ใช้งาน</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('profile') }}" class="{{ (request()->is("profile/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> โปรไฟล์</a></li>
                        
                    </ul>
                </li>                          
            </ul>
            @elsecan('isUser')
             <ul id="sidebarnav">
                
                <li class="{{ (request()->is("manage_task/*") || request()->is("customer_google_adses/*") || request()->is("receipt/*") || request()->is("receipt_company/*") ? 'active' : '') }}">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-microsoft"></i><span class="hide-menu">ระบบการทำงาน</span></a>
                    <ul aria-expanded="false" class="collapse">
                         
                        <li><a href="{{ route('manage_task') }}" class="{{ (request()->is("manage_task/*") ? 'active' : '') }}"> <i class="me-2 mdi mdi-account-circle"></i> วางแผนการทำงาน</a></li>
                        
                    </ul>
                </li>  
                <li class="{{ (request()->is("profile/*") || request()->is("user/*")  ? 'active' : '') }}">
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">ผู้ใช้งาน</span></a>
                    <ul aria-expanded="false" class="collapse">     
                        <li><a href="{{ route('profile') }}" class="{{ (request()->is("profile/*") ? 'active' : '') }}"><i class="me-2 mdi mdi-panorama-fisheye"></i> โปรไฟล์</a></li>
                        
                    </ul>
                </li>                          
            </ul>
            @endcan
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