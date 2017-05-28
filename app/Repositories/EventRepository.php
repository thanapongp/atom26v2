<?php

namespace Atom26\Repositories;

use Carbon\Carbon;
use Atom26\Web\Event;
use Atom26\Web\EventSet;
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
            $this->{$methodName}($request, $this->createEventModel($request));
        });
    }

    /**
     * Create atheletic event recored.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event $event
     */
    protected function CreateAthleticsEvent(Request $request, Event $event)
    {
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
     * Create pathong event record.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event   $event
     */
    protected function CreatePethongEvent(Request $request, Event $event)
    {
        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $data = [
                'university_id' => $university_id,
                'athlete_id' => $request->athlete_id[$i],
                'score' => $request->score[$i],
            ];

            if ($request->is_winner == $i) {
                $data = array_merge($data, ['is_winner' => true]);
            }

            $event->results()->save(new EventResult($data));

            $i++;  
        });
    }

    /**
     * Create basketball event record.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event   $event
     */
    protected function CreateBasketBallEvent(Request $request, Event $event)
    {
        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $data = [
                'university_id' => $university_id,
                'athlete_id' => $request->athlete_id[$i],
                'score' => $request->score[$i],
            ];

            if ($request->is_winner == $i) {
                $data = array_merge($data, ['is_winner' => true]);
            }

            $event->results()->save(new EventResult($data));

            $i++;  
        });
    }

    /**
     * Create football event record.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event   $event
     */
    protected function CreateFootBallEvent(Request $request, Event $event)
    {
        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $data = [
                'university_id' => $university_id,
                'athlete_id' => $request->athlete_id[$i],
                'score' => $request->score[$i],
            ];

            if ($request->is_winner == $i) {
                $data = array_merge($data, ['is_winner' => true]);
            }

            $event->results()->save(new EventResult($data));

            $i++;  
        });
    }

    /**
     * Create volleyball event record.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event   $event
     */
    protected function CreateVolleyballEvent(Request $request, Event $event)
    {
        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $data = [
                'university_id' => $university_id,
                'score' => $request->score[$i],
            ];

            if ($request->is_winner == $i) {
                $data = array_merge($data, ['is_winner' => true]);
            }

            $event->results()->save(new EventResult($data));

            $result = EventResult::find(DB::getPdo()->lastInsertId());

            foreach ($request->set[$i] as $set => $score) {
                $result->sets()->save(new EventSet([
                    'set' => $set,
                    'score' => $score,
                ]));
            }

            $i++;  
        });
    }

    /**
     * Create takraw event record.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Web\Event   $event
     */
    protected function CreateTakrawEvent(Request $request, Event $event)
    {
        $i = 1;

        collect($request->university_id)->each(function ($university_id) use (
            $request, $event, &$i
        ) {
            $data = [
                'university_id' => $university_id,
                'athlete_id' => $request->athlete_id[$i],
                'score' => $request->score[$i],
            ];

            if ($request->is_winner == $i) {
                $data = array_merge($data, ['is_winner' => true]);
            }

            $event->results()->save(new EventResult($data));

            $i++;  
        });
    }

    /**
     * Create base event model.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Atom26\Web\Event
     */
    private function createEventModel(Request $request)
    {
        return Event::create([
            'name' => $request->name,
            'venue' => $request->venue,
            'sport_id' => $request->sport_id,
            'date' => $this->parseDate($request->date)
        ]);
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
