@if ($currentUser->hasAccess('admin.userPermissions.index'))
<a class="orange" href="{{ route('admin.userPermissions.index', $id) }}"><i class="ace-icon fa fa-lock bigger-130"></i></a>
@endif
@if ($currentUser->hasAccess('admin.users.edit'))
<a class="green" href="{{ route('admin.users.edit', $id) }}"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
@endif
@if ($currentUser->hasAccess('admin.users.destroy'))
<a class="red" id="btn-delete-{{ $id }}" data-url="{{ route('admin.users.destroy', $id) }}" href="javascript:;"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
@endif
