<div class="place-layout place-item-layout-1">
  <x-isite::edit-link link="{{$editLink}}{{$item->id}}" tooltip="{{$tooltipEditLink}}"/>
  <a href="{{$item->url}}"><h4>{{$item->title}}</h4></a>
  @if(!empty($item->addressIplace))
    <p><i class="fa fa-map-marker" aria-hidden="true"></i>{!! $item->addressIplace !!}</p>
  @endif
  @if(!empty($item->telephone1))
    <p><i class="fa fa-phone-square" aria-hidden="true"></i>{!! $item->telephone1 !!}</p>
  @endif
  @if(!empty($item->telephone2))
    <p><i class="fa fa-phone-square" aria-hidden="true"></i>{!! $item->telephone1 !!}</p>
  @endif
  @if(!empty($item->telephone3))
    <p><i class="fa fa-phone-square" aria-hidden="true"></i>{!! $item->telephone1 !!}</p>
  @endif
  @if(!empty($item->options->whatsapp1Number))
    <x-isite::whatsapp numbers="{{$numbers->[0]}}"/>
  @endif
  @if(!empty($item->options->whatsapp2Number))
    <x-isite::whatsapp numbers="{{$numbers->[1]}}"/>
  @endif
</div>

