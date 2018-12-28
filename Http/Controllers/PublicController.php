<?php

namespace Modules\Iplaces\Http\Controllers;

use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iplaces\Http\Controllers\Api\PlaceController;
use Modules\Iplaces\Repositories\CategoryRepository;
use Modules\Iplaces\Repositories\PlaceRepository;
use Modules\Iplaces\Repositories\ServiceRepository;
use Modules\Iplaces\Repositories\ZoneRepository;
use Modules\Iplaces\Repositories\ScheduleRepository;
use Illuminate\Http\Request;
use Route;

class PublicController extends BasePublicController
{

  public $place;
  public $category;
  public $service;
  public $zone;
  public $schedule;

  public function __construct(PlaceRepository $place, CategoryRepository $category, ServiceRepository $service, ZoneRepository $zone, ScheduleRepository $schedule)
  {
    parent::__construct();
    $this->place = $place;
    $this->category = $category;
    $this->service = $service;
    $this->zone = $zone;
    $this->schedule = $schedule;
  }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
  {

    $oldCat = null;
    $oldServ = null;
    $oldZone = null;
    $oldSche = null;
    if ((isset($request->categories) && !empty($request->categories)) ||
      (isset($request->services) && !empty($request->services)) ||
      (isset($request->zones) && !empty($request->zones)) ||
      (isset($request->schedules) && !empty($request->schedules))|| (isset($request->gamas) && !empty($request->gamas))) {
      $filter = ['categories' => $request->categories, 'gama' => $request->gamas,'quantity_persons' => $request->quantity_persons,"services" => $request->services, "zones" => $request->zones, "schedules" => $request->schedules];

      $places = $this->place->wherebyFilter($request->page??1, $take = 12, json_decode(json_encode($filter)), $include = null);
      $oldCat = $request->categories;
      $oldServ = $request->services;
      $oldZone = $request->zones;
      $oldSche = $request->schedules;
        $oldGama = $request->gamas;
        $oldQuan = $request->quantity_persons;
    } else {
      $places = $this->place->wherebyFilter($request->page??1, 12   ,json_decode(json_encode( ['orderBy'=>'created_at','orderType'=>'desc'])));
    }

    $services = $this->service->all();
    $zones = $this->zone->all();
    $schedules = $this->schedule->all();
    $categories = $this->category->all();
    $tpl = 'iplaces::frontend.index';
    $ttpl = 'iplaces.index';

    if (view()->exists($ttpl)) $tpl = $ttpl;

    Return view($tpl, compact('places', 'categories', 'zones', 'services', 'schedules', 'oldCat', 'oldServ', 'oldZone', 'oldSche','oldGama','oldQuan'));

  }

  public function category($slugCategory)
  {

    $category = $this->category->findBySlug($slugCategory);
    $places = $this->place->whereCategory($category->id);
    $services = $this->service->all();
    $zones = $this->zone->all();
    $schedules = $this->schedule->all();
    $categories = $this->category->all();
    $tpl = 'iplaces::frontend.index';
    $ttpl = 'iplace.frontend.index';

    if (view()->exists($ttpl)) $tpl = $ttpl;

    Return view($tpl, compact('places', 'category', 'zones', 'services', 'categories', 'schedules'));

  }

    public function show($slugCategory, $slugPlace)
    {

        $category = $this->category->findBySlug($slugCategory);
        $place = $this->place->findBySlug($slugPlace);
        if ($place->category->id == $category->id) {
            $categories = $this->category->all();
            $services = $this->service->all();
            $zones = $this->zone->all();
            $schedules = $this->schedule->all();
            $tpl = 'iplaces::frontend.show';
            $ttpl = 'iplaces.show';

            if (view()->exists($ttpl)) $tpl = $ttpl;

      Return view($tpl, compact('place', 'category', 'zones', 'services', 'categories', 'schedules'));
    }

    return abort(404);


  }
}