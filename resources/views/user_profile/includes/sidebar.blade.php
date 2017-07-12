<ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
    <li class="{{ active('user.dashboard') }}">
        <a href="{{ route('user.dashboard') }}"><i class="fa fa-inbox"></i> Dashboard</a>
    </li>

    <li class="">
        <a href="#"><i class="fa fa-certificate"></i> Избранные</a>
    </li>
    <li class="{{ active(['user.requests', 'user.request', 'user.request.find']) }}">
        <a href="{{ route('user.requests') }}">
            <i class="fa fa-file-text-o"></i> Заявки <span class="label label-info pull-right inbox-notification">{{ $count_request }}</span>
        </a>
    </li>
</ul><!-- /.nav -->

<h5 class="nav-email-subtitle"></h5>
<ul class="nav nav-pills nav-stacked nav-email mb-20 rounded shadow">
    <li class="{{ active('user.profile') }}">
        <a href="{{ route('user.profile') }}"><i class="fa fa-user"></i> Профиль</a>
    </li>
    <li class="{{ active('user.setting') }}">
        <a href="{{ route('user.setting') }}"><i class="fa fa-cogs"></i> Настройки </a>
    </li>
</ul><!-- /.nav -->