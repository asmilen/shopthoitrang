@if ($currentUser->hasAccess('admin.rolePermissions.index'))
<a class="orange" href="{{ route('admin.rolePermissions.index', $id) }}"><i class="ace-icon fa fa-lock bigger-130"></i></a>
@endif
@if ($currentUser->hasAccess('admin.roles.edit'))
<a class="green" href="{{ route('admin.roles.edit', $id) }}"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
@endif
@if ($currentUser->hasAccess('admin.roles.destroy'))
<a class="red" id="btn-delete-{{ $id }}" data-url="{{ route('admin.roles.destroy', $id) }}" href="javascript:;"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
@endif
