<?php

namespace App\Http\Services\Event;

interface EventServiceInterface
{
    public function createEvent(array $data);
    public function verifyEventAndUpdateUserRoles(string $id);
}
