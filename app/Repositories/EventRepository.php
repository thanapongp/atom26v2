<?php

namespace Atom26\Repositories;

use Carbon\Carbon;
use Atom26\Web\Event;
use Atom26\Web\EventResult;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class EventRepository
{
    /**
     * Create new event based on sport type.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return void
     * @throws InvalidArgumentException
     */
    public function create(Request $request)
    {
        if (! $request->has('label')) {
            throw new InvalidArgumentException('label not found in request bag.');
        }

        if (! method_exists($this, $methodName = 'Create' . studly_case($request->label) . 'Event')) {
            throw new InvalidArgumentException("Method '{$methodName}' not found.");
        }

        DB::transaction(function () use ($methodName, $request) {
            $this->{$methodName}($request);
        });
    }

    protected function CreateAthleticsEvent(Request $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'venue' => $request->venue,
            'sport_id' => $request->sport_id,
            'date' => $this->parseDate($request->date)
        ]);

        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $event->results()->save(new EventResult([
                'university_id' => $university_id,
                'athlete_id' => $request->athlete_id[$i],
                'time' => $request->time[$i],
                'order' => $i,
            ]));

            $i++;
        });
    }

    /**
     * Parse date to dateTime string format.
     * 
     * @param  string $date
     * @param  string $format
     * @return string
     */
    private function parseDate($date, $format = 'd/m/Y H:i')
    {
        return Carbon::createFromFormat($format, $date)->toDateTimeString();
    }
}
