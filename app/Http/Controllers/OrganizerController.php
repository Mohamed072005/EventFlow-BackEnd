<?php

namespace App\Http\Controllers;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    //
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository){
        $this->eventRepository = $eventRepository;
    }
    public function getOrganizerDashboardStatistics()
    {
        try {
            $organizer = Auth::user();
            $organizerEvents = $this->eventRepository->getOrganizerEventsCount($organizer->id);
            $verifiedEvents = $this->eventRepository->getOrganizerVerifiedEventsCount($organizer->id);
            $unverifiedEvents = $this->eventRepository->getOrganizerUnverifiedEventsCount($organizer->id);
            return response()->json(
                [
                    'events' => $organizerEvents,
                    'verifiedEvents' => $verifiedEvents,
                    'unverifiedEvents' => $unverifiedEvents,
                ], 200);

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
