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
}
