<?php

namespace App\Http\Services\Event;

use App\Http\Services\Event\EventServiceInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EventService implements EventServiceInterface
{
    private $roleRepository;
    private $eventRepository;
    private $userRepository;
    public function __construct(RoleRepositoryInterface $roleRepository, EventRepositoryInterface $eventRepository, UserRepositoryInterface $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
    }
    public function createEvent(array $data)
    {
        try {
            $user = Auth::user();
            $userRole = $this->roleRepository->getRoleById($user->role_id);
            $checkEvent = $this->eventRepository->getEventByName($data['event_name']);
            if ($checkEvent) {
                if (!is_null($checkEvent->verified_at)) {
                    throw new \Exception('An event with this name is already verified and cannot be duplicated.', 400);
                }

                if (is_null($checkEvent->verified_at) && !in_array($userRole->role_name, ['admin', 'organizer'])) {
                    throw new \Exception('A pending event with this name already exists. Please wait for approval.', 400);
                }
            }
            if ($userRole->role_name === 'admin' || $userRole->role_name === 'organizer'){
                $data['verified_at'] = now();
            }else {
                $data['verified_at'] = null;
            }
            $data['user_id'] = $user->id;
            $data['image_url'] = $data['image_url'] ?? '';
            $event = $this->eventRepository->storeEvent($data);
            return $event;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function verifyEventAndUpdateUserRoles(string $id)
    {
        try {
            $event = $this->eventRepository->getEventByIdAndUser($id);
            if (!$event) {
                throw new \Exception('Event not found', 404);
            }
            $updatedEvent = $this->eventRepository->verifyEvent($event);
            $role = $this->roleRepository->getOneRole('organizer');
            $this->userRepository->updateUserRole($event->user, $role->id);
            return $updatedEvent;
        }catch (\Exception $e) {
            throw $e;
        }
    }
}
