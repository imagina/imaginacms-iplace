<?php

namespace Modules\Iplaces\View\Components;

use Illuminate\View\Component;

class PlaceListItem extends Component
{


  public $item;
  public $mediaImage;
  public $view;
  public $withViewMoreButton;
  public $viewMoreButtonLabel;
  public $editLink;
  public $tooltipEditLink;
  public $placesListItemLayout;
  public $numbers;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($item, $mediaImage = "mainimage", $layout = 'place-list-item-layout-1', $parentAttributes = null,
                              $withViewMoreButton = false, $viewMoreButtonLabel = "isite::common.menu.viewMore",
                              $editLink = null , $tooltipEditLink = null)
  {
    $this->item = $item;
    $this->mediaImage = $mediaImage;
    $this->view = "iplaces::frontend.components.place.place-list-item.layouts." . ($layout ?? 'place-list-item-layout-1' ) .".index";
    $this->withViewMoreButton = $withViewMoreButton;
    $this->viewMoreButtonLabel = $viewMoreButtonLabel;
    $this->editLink = $editLink;
    $this->tooltipEditLink = $tooltipEditLink;

    $numbers = [
      0 => [
        "callingCode" => $item->options->whatsapp1Code,
        "number" => $item->options->whatsapp1Number,
        "message" => $item->options->whatsapp1Message
      ],
      1 => [
        "callingCode" => $item->options->whatsapp2Code,
        "number" => $item->options->whatsapp2Number,
        "message" => $item->options->whatsapp2Message
      ],
    ];



    if(!empty($parentAttributes))
      $this->getParentAttributes($parentAttributes);
  }

  private function getParentAttributes($parentAttributes){

    isset($parentAttributes["mediaImage"]) ? $this->mediaImage = $parentAttributes["mediaImage"] : false;
    isset($parentAttributes["layout"]) ? $this->layout = $parentAttributes["layout"] : false;
    isset($parentAttributes["withViewMoreButton"]) ? $this->withViewMoreButton = $parentAttributes["withViewMoreButton"] : false;
    isset($parentAttributes["viewMoreButtonLabel"]) ? $this->viewMoreButtonLabel = $parentAttributes["viewMoreButtonLabel"] : false;

  }
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view($this->view);
  }
}