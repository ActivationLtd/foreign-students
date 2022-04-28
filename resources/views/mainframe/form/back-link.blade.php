<?php
/** @var array $var
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $backToElement
 */
$backToElement = $var['element'];
$showField = $var['field'] ?? 'name';
?>

@if($backToElement)
    <a class="btn btn-default bg-white" href="{{$backToElement->editUrl()}}">
        <i class="fa fa-angle-left"></i>
        <b>{{$backToElement->module()->title}}</b>
        <span class="badge badge-primary bg-red flat">{{$backToElement->id}}</span>
        {{$backToElement->$showField}}
    </a>
@endif

@unset($var)