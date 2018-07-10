@php
if($reportType->slug == 'dor-paramedic')
{	
	$value = App\Models\Auth\Role::find(7)->users->pluck('id', 'full_name');
}
@endphp

{{ HtmlExtra::select()->name($name)
->id($id)
->helperText($helpertext)
->value($value)
->data($data)
->render() }}