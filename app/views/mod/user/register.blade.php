@extends( 'layout/frontpage-blank-layout' )

@section('main_content')
<div class="block block-drop-shadow">
    <div class="col-md-6 col-md-offset-3 form-register">
        @if (Session::has('message'))
        <div class="message-info alert alert-info">{{ Session::get('message') }}</div>
        <?php Session::forget('info_message'); ?>
        @endif
        <div class="form-data-input">
            {{ Form::open(array('action' => 'UserController@userStore', 'method' => 'post')) }}
            <div class="margin-bottom-20 head bg-default bg-light-ltr">
                <h2>
                    Đăng kí tài khoản
                </h2>
            </div>

            <!-- will be used to show any messages -->
            <div style="clear:both"></div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="inputName">Họ và tên:</label>
                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Họ và tên">
            </div>

            <div class="form-group">
                <label for="inputEmail">Email:</label>
                <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="inputUserName">Tên tài khoản:</label>
                <input type="text" class="form-control" id="inputUserName" name="inputUserName" placeholder="User name">
            </div>

            <div class="form-group">
                <label for="inputPassword">Password:</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Đăng kí</button>

            <div style="clear:both"></div>
            {{ Form::close() }}

        </div>
    </div>
</div>
@stop
