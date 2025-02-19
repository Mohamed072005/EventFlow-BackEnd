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
}
