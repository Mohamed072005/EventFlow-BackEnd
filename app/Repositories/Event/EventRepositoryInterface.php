<?php

namespace App\Repositories\Event;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function storeEvent(array $data);
    public function getEventByName(string $name);
    public function fetchVerifiedEvents();
    public function getEventByIdAndUser(string $id);
    public function verifyEvent(Event $event);
    public function fetchEvents();
    public function getEventCount();
    public function getOrganizerEventsCount(string $id);
    public function getOrganizerVerifiedEventsCount(string $id);
    public function getOrganizerUnverifiedEventsCount(string $id);
    public function getOrganizerEvents(string $id);
}
