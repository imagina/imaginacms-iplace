<?php

namespace Modules\Iplaces\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Iplaces\Entities\Category;
use Modules\Iplaces\Entities\Zone;
use Laracasts\Presenter\PresentableTrait;
use Modules\Iplaces\Presenters\PlacePresenter;
use Modules\Iplaces\Events\PlaceWasCreated;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ilocations\Entities\City;
use Modules\Ilocations\Entities\Province;
use Modules\Iplaces\Entities\Schedule;
use Modules\Iplaces\Entities\Range;


class Place extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity;

    protected $table = 'iplaces__places';
    public $translatedAttributes = [
        'title',
        'description',
        'slug',
        'metatitle',
        'metadescription',
        'metakeywords'
    ];
    protected $fillable = [
        'title',
        'description',
        'slug',
        'user_id',
        'status',
        'summary',
        'address',
        'options',
        'category_id',
        'created_at',
        'metatitle',
        'metadescription',
        'metakeywords',
        'zone_id',
        'city_id',
        'service_id',
        'province_id',
        'schedule_id',
        'gama',
        'quantity_person',
        'weather',
        'housing',
        'transport'
    ];
    protected $fakeColumns = ['options'];
    protected $presenter = PlacePresenter::class;

    protected $casts = [
        'options' => 'array',
        'status'=>'int',
        'zone_id'=>'int',
        'schedule_id'=>'int',
        'province_id',
        'weather'=>'int'

    ];

    /*
     * ---------
     * RELATIONS
     * --------
     */
    protected function setSlugAttribute($value){

        if(!empty($value)){
            $this->attributes['slug'] = str_slug($value,'-');
        }else{
            $this->attributes['slug'] = str_slug($this->attributes['title'],'-');
        }

    }

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'iplaces_place_category');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'iplaces_place_service');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function range()
    {
        return $this->belongsTo(Range::class);
    }

    /*
     * -------------
     * IMAGE
     * -------------
     */

    public function getMainimageAttribute(){

        $image=$this->options->mainimage ?? 'modules/iplaces/img/default.jpg';
        $v=strftime('%u%w%g%k%M%S', strtotime($this->updated_at));
        // dd($v) ;
        return url($image.'?v='.$v);
        //return ($this->options->mainimage ?? 'modules/iplace/img/place/default.jpg').'?v='.format_date($this->updated_at,'%u%w%g%k%M%S');
    }
    public function getMediumimageAttribute(){

        return url(str_replace('.jpg','_mediumThumb.jpg',$this->options->mainimage ?? 'modules/iplaces/img/default.jpg'));
    }
    public function getThumbailsAttribute(){

        return url(str_replace('.jpg','_smallThumb.jpg',$this->options->mainimage?? 'modules/iplaces/img/default.jpg'));
    }
    public function getMetatitleAttribute(){

        $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
        return $this->translate($locale)->metatitle ?? $this->translate($locale)->title;

    }
    public function getMetadescriptionAttribute(){

        return $this->metadescription ?? substr(strip_tags($this->description),0,150);
    }


    public function getUrlAttribute() {

       // \URL::route(\LaravelLocalization::getCurrentLocale(

        return  \URL::route('iplaces.place.show', [$this->category->slug,$this->slug]);
    }
    public function getOptionsAttribute($value)
    {

        return json_decode(json_decode($value));

    }

    /*
  |--------------------------------------------------------------------------
  | SCOPES
  |--------------------------------------------------------------------------
  */
    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
            ->orWhere('depth', null)
            ->orderBy('lft', 'ASC');
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereStatus(Status::ACTIVE);
    }

    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopeCloudy(Builder $query)
    {
        return $query->whereWeather(Weather::CLOUDY);
    }

    public function scopeWarm(Builder $query)
    {
        return $query->whereWeather(Weather::WARM);
    }



}
