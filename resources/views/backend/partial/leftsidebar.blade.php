<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ URL::route('user.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('user.categories') }}">
                    <i class="fa fa-dashboard"></i> <span>Danh Mục</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('user.articles') }}">
                    <i class="fa fa-dashboard"></i> <span>Bài viết</span>
                </a>
            </li>

            <li>
                <a href="/lesson">
                    <i class="fa fa-dashboard"></i> <span>Bài giảng</span>
                </a>
            </li>
            @can('event.index')
            <li>
                <a href="{{ URL::route('event.index') }}">
                    <i class="fa fa-bullhorn"></i>
                    <span>Sự kiện</span>
                </a>
            </li>
            @endcan
            @can('student.index')
            <li>
                <a href="{{ URL::route('student.index') }}">
                    <i class="fa icon-student"></i> <span>Sinh viên</span>
                </a>
            </li>
            @endcan
            @can('teacher.index')
            <li>
                <a href="{{ URL::route('teacher.index') }}">
                    <i class="fa icon-teacher"></i> <span>Giáo viên</span>
                </a>
            </li>
            @endcan

            @canany(['student_attendance.index', 'employee_attendance.index'])
            <li class="treeview">
                <a href="#">
                    <i class="fa icon-attendance"></i>
                    <span>Điểm danh</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ URL::route('student_attendance.index') }}">
                            <i class="fa icon-student"></i> <span>Danh sách điểm danh</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('student_attendance.create') }}">
                            <i class="fa icon-student"></i> <span>Tạo điểm danh</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcanany

            <li class="treeview">
                <a href="#">
                    <i class="fa icon-academicmain"></i>
                    <span>Academic</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @notrole('Student')
                    @can('academic.class')
                    <li>
                        <a href="{{ URL::route('academic.class') }}">
                            <i class="fa fa-sitemap"></i> <span>Lớp</span>
                        </a>
                    </li>
                    @endcan

                    @endnotrole

                    @can('academic.subject')
                    <li>
                        <a href="{{ URL::route('academic.subject') }}">
                            <i class="fa icon-subject"></i> <span>Môn học</span>
                        </a>
                    </li>
                    @endcan

                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="fa fa-clock-o"></i><span>Routine</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                </ul>
            </li>

            <li>
                <a href="/report">
                    <i class="fa fa-dashboard"></i> <span>Thống kê</span>
                </a>
            </li>
            @role('Admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    <span>Administrator</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">


                    <li>
                        <a href="{{URL::route('administrator.user_index')}}">
                            <i class="fa fa-user-md"></i> <span>System Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('administrator.user_password_reset')}}">
                            <i class="fa fa-eye-slash"></i> <span>Đặt lại mật khẩu</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{URL::route('user.role_index')}}">
                            <i class="fa fa-users"></i> <span>Role</span>
                        </a>
                    </li> -->

                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="fa fa-download"></i> <span>Backup</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="fa fa-upload"></i> <span>Restore</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                </ul>
            </li>
            @endrole



            <!-- Frontend Website links and settings -->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>