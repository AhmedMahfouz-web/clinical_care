<div class="left_sidebar">
    <nav class="sidebar">
        <div class="user-info pb-3" style="margin-top:-50px">
            <div class="image"><a href="javascript:void(0);"><img src="{{ asset('images/user.png') }}" alt="User"></a>
            </div>
            <div class="detail mt-3">
                <h5 class="mb-0">{{ auth()->guard('admin')->user()->name }}</h5>
                <small>{{ auth()->guard('admin')->user()->role }}</small>
            </div>
        </div>
        <ul id="main-menu" class="metismenu">
            <li class="g_heading">Main</li>
            <li {{ Request::is('dashboard') ? 'class=active' : '' }}><a href="{{ route('dashboard') }}"><i
                        class="ti-home"></i><span>الرئيسية</span></a></li>

            <li {{ Request::is('dashboard/meeting/*', 'dashboard/meeting') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>طلبات المقابلات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show meetings') }}">عرض طلبات المقابلات</a></li>
                </ul>
            </li>

            <li {{ Request::is('dashboard/report/*', 'dashboard/report') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>طلبات التقارير</span>
                </a>
                <ul>
                    <li><a href="{{ route('show reports') }}">عرض طلبات التقارير</a></li>
                    <li><a href="{{ route('show answered reports') }}">عرض التقارير </a></li>
                </ul>
            </li>
            <li {{ Request::is('dashboard/reservation/*', 'dashboard/reservation') ? 'class=active' : '' }}>
                <a href="{{ route('show reservations') }}" class="has-arrow"><i class="ti-user "></i><span>حجوزات
                        الاشعة
                        و التحاليل</span>
                </a>
                {{-- <ul>
                    <li><a href="{{ route('show reports') }}">عرض حجوزات الاشعة و
                            التحاليل</a></li>
                </ul> --}}
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
            <li {{ Request::is('dashboard/partner/*', 'dashboard/partner') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>الشركاء</span>
                </a>
                <ul>
                    <li><a href="{{ route('show partners') }}">عرض الشركاء</a></li>
                    <li><a href="{{ route('create partner') }}">اضافة شريك</a></li>
                </ul>
            </li>
            @if (auth()->guard('admin')->user()->role == 'صاحب منشأة')
                <li {{ Request::is('dashboard/admin/*', 'dashboard/admin') ? 'class=active' : '' }}>
                    <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>الاداريون</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('show admins') }}">عرض الاداريين</a></li>
                        <li><a href="{{ route('create admin') }}">اضافة اداري</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>
