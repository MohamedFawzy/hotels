<?php

namespace App\Repository;
use App\Hotel;
use App\ValueObject\Entity;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Builder;
/**
 * Class Hotels
 * @package App\Repository
 */
class Hotels implements IRepository
{

    /**
     * find all elements in page with default 15 record by per
     * @return array
     */
    public function findAll(): array
    {

        $model = Hotel::SearchSortPaginationCriteria();
        $columns = Hotel::$columns;
        $result = ['model'=>$model, 'columns' => $columns];

        return $result;
    }

    /**
     * Save new record to database
     * @param \App\ValueObject\Hotel $entity
     * @return bool
     * @throws \ErrorException
     */
    public function store(Entity $entity): bool
    {
        $hotel = new Hotel();
        $hotel->name = $entity->getName();
        $hotel->price = $entity->getPrice();
        $hotel->city = $entity->getCity();
        $result=[];
        for($i=0; $i< count($entity->getAvailability()); $i++){
            $result[$i] = [
                'from' => new \MongoDB\BSON\UTCDateTime(new \DateTime($entity->getAvailability()[$i]['from'])),
                'to' => new \MongoDB\BSON\UTCDateTime(new \DateTime($entity->getAvailability()[$i]['to'])),
            ];
        }
        $hotel->availability = $result;
        $result = $hotel->save();
        if(!$result){
            throw new \ErrorException("cannot create new entity");
        }
        return $result;
    }

    /**
     * @param string $search_column
     * @param Builder $builder
     * @param array $price
     * @return Builder
     */
    public function priceQuery(string $search_column, Builder $builder, array $price): Builder
    {
        return $builder->whereBetween($search_column, $price);
    }

    /**
     * @param Request $request
     * @param Builder $builder
     * @return Builder
     */
    public function availabilityQuery(Request $request, Builder $builder): Builder
    {

        $search_inputs = explode(',', $request->search_input);
        $from = new \MongoDB\BSON\UTCDateTime(new \DateTime($search_inputs[0]));
        $to = new \MongoDB\BSON\UTCDateTime(new \DateTime($search_inputs[1]));
        return $builder->where('availability', 'elemMatch', array('from' => array('$gte'=>$from), 'to' => array('$lte'=>$to)));
    }

    /**
     * @param string $search_column
     * @param array $search_input
     * @param Builder $builder
     * @return Builder
     */
    public function queryIn(string  $search_column , array $search_input , Builder $builder): Builder
    {
        return $builder->whereIn($search_column, $search_input);
    }


}