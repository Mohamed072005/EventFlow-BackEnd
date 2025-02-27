<?php

namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{

    public function storeEvent(array $data)
    {
        return Event::create($data);
    }

    public function getEventByName(string $name)
    {
        return Event::where('event_name', $name)->first();
    }

    public function fetchVerifiedEvents()
    {
        return Event::where('verified_at', '!=', null)->get();
    }

    public function getEventByIdAndUser(string $id)
    {
        return Event::where('id', $id)->first();
    }


    public function verifyEvent(Event $event)
    {
        $event->verified_at = now();
        $event->save();
        return $event;
    }

    public function fetchEvents()
    {
        return Event::with(['user:id,first_name,role_id,email', 'user.role:id,role_name'])->get();
    }

    public function getEventCount()
    {
       return Event::all()->count();
    }

    public function getOrganizerEventsCount(string $id)
    {
        return Event::where('user_id', $id)->count();
    }

    public function getOrganizerVerifiedEventsCount(string $id)
    {
        return Event::where('user_id', $id)->where('verified_at', '!=', null)->count();
    }

    public function getOrganizerUnverifiedEventsCount(string $id)
    {
        return Event::where('user_id', $id)->where('verified_at', null)->count();
    }

    public function getOrganizerEvents(string $id)
    {
        return Event::where('user_id', $id)->get();
    }
}
