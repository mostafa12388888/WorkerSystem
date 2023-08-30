<?php
namespace App\filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
class postfilter{

    public function filter(){
        return ['content', 'price','worker.name',AllowedFilter::callback('items', function (Builder $query, $value) {
            $query->where('price',"like","%{$value}%")
            ->orWhere('content','like',"%{$value}%")
            ->orWhereHas('worker', function (Builder $query)use($value) {
            $query->where('name',"like","%{$value}%");
        }); })];
    }
}
