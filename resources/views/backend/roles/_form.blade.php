<div class="card-body">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">Nama Role</label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                <table class="table">
                    <tr>
                        <th><input type="checkbox" value="1" class="all"> Grant All</th>
                        <th>Module Name</th>
                        <th>Access</th>
                    </tr>
                    @forelse (config('menus') as $module)
                    <tr>
                        <td><input type="checkbox" value="1" name="checkModule[]" class="check-modules"> Select All</td>
                        <td>{{ $module['display_name'] }}</td>
                        <td>
                            @forelse ($module['action'] as $key => $permission)
                            <label class="permissions" for="{{ $permission }}">
                                {{ Form::checkbox('permissions[]', $permission.'-'.$module['name'], false, array('class' => 'name check-access '.$permission.'-'.$module['name'].'-key ')) }}
                                {{ $permission }}
                            </label>
                            @empty
                            There is no permission for this module
                            @endforelse
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">No Roles</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>