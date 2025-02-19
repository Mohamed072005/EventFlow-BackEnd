<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventValidation;
use App\Http\Services\Auth\AuthServiceInterface;
use App\Http\Services\Event\EventServiceInterface;
use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class EventController extends Controller
{
    private $eventService;
    private $eventRepository;

    public function __construct(EventServiceInterface $eventService, EventRepositoryInterface $eventRepository)
    {
        $this->eventService = $eventService;
        $this->eventRepository = $eventRepository;
    }

    public function createEvent(Request $request)
    {
        try {
            $validation = EventValidation::getInstance();
            $result = $validation->validate('create', $request);
            if ($result !== true) {
                throw new ValidationException($result);
            }
            $event = $this->eventService->createEvent($request->all());
            return response()->json(['message' => 'Create Success', 'event' => $event], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function getVerifiedEvents()
    {
        try {
            $events = $this->eventRepository->fetchVerifiedEvents();
            return response()->json(['events' => $events], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], $e->getCode());
        }

    }

    public function verifyEvent($id){
        try {
            $event = $this->eventService->verifyEventAndUpdateUserRoles($id);
            return response()->json(['message' => 'Verify Success', 'event' => $event], 200);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
