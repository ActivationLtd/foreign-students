<?php
/** @var array $var
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 */
$label = null;
if ($backToElement) {
    $label = "Download Zip";
}
$label = $var['label'] ?? $label;
$url = $var['url'] ?? route('download.zip', ['module_id' => $element->module()->id, 'element_id' => $element->id]);;
?>

@if($backToElement)
    <a class="btn btn-default bg-white" href="{!! $url !!}">
        <i class="fa fa-file-zip-o"></i>
        <b>{{$label}}</b>
    </a>
@endif

@unset($var, $label, $url)