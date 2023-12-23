<div class="left_sidebar">
    <nav class="sidebar">
        <div class="user-info">
            <div class="image"><a href="javascript:void(0);"><img src="{{ asset('images/user.png') }}" alt="User"></a>
            </div>
            <div class="detail mt-3">
                <h5 class="mb-0">{{ auth()->guard('admin')->user('admin')->name }}</h5>
                <small>{{ auth()->guard('admin')->user('admin')->role }}</small>
            </div>
            <div class="social">
                <a href="javascript:void(0);" title="facebook"><i class="ti-twitter-alt"></i></a>
                <a href="javascript:void(0);" title="twitter"><i class="ti-linkedin"></i></a>
                <a href="javascript:void(0);" title="instagram"><i class="ti-facebook"></i></a>
            </div>
        </div>
        <ul id="main-menu" class="metismenu">
            <li class="g_heading">Main</li>
            <li {{ Request::is('dashboard') ? 'class=active' : '' }}><a href="{{ route('dashboard') }}"><i
                        class="ti-home"></i><span>الرئيسية</span></a></li>

            <li {{ Request::is('dashboard/report/*', 'dashboard/report') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>طلبات التقارير</span>
                </a>
                <ul>
                    <li><a href="{{ route('show reports') }}">عرض طلبات التقارير</a></li>
                    <li><a href="{{ route('show answered reports') }}">عرض التقارير </a></li>
                </ul>
            </li>
            <li {{ Request::is('dashboard/hospital/*', 'dashboard/hospital') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>المستشفيات و المعامل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show hospitals') }}">عرض المستشفيات و المعامل</a></li>
                    <li><a href="{{ route('create hospital') }}">اضافة مستشفي او معمل</a></li>
                </ul>
            </li>
            <li {{ Request::is('dashboard/test/*', 'dashboard/test') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>الاشاعات و التحاليل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show tests') }}">عرض الاشاعات و التحاليل</a></li>
                    <li><a href="{{ route('create test') }}">اضافة اشعة او تحليل</a></li>
                </ul>
            </li>
            <li {{ Request::is('dashboard/profession/*', 'dashboard/profession') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>التخصصات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show professions') }}">عرض التخصصات</a></li>
                    <li><a href="{{ route('create profession') }}">اضافة تخصص</a></li>
                </ul>
            </li>
            <li {{ Request::is('dashboard/admin/*', 'dashboard/admin') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>الاداريون</span>
                </a>
                <ul>
                    <li><a href="{{ route('show admins') }}">عرض الاداريين</a></li>
                    <li><a href="{{ route('create admin') }}">اضافة اداري</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
