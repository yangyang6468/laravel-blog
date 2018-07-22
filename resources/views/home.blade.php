
<script src="{{ asset('plug/artDialog/lib/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('plug/artDialog/dist/dialog.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var d = dialog({
        title: '欢迎',
        content: '欢迎使用 artDialog 对话框组件！'
    });
    d.show();
</script>