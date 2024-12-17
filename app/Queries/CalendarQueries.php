<?php 
namespace App\Queries;

use App\Models\Calendar;
use App\Models\Event;
use App\Models\SettingsModel;

class CalendarQueries
{

    public static function countAll(): int
    {
        return Event::count();
        
    }

    /**
     * Get all sales sorted by creation date.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCalendarsSortedByCreatedAt(): \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
    {
        return Event::all()->sortBy('created_at');
    }

    /**
     * Get paginated list of sales.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getPaginate(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Event::orderByDesc('id')
            ->paginate(SettingsModel::where('key', 'pagination_size')
                ->get()->last()->value);
    }
}