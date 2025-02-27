<?php

namespace App\Http\Controllers;

use App\Http\Services\User\UserServiceInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $eventRepository;
    private $userRepository;
    private $userService;

    public function __construct(EventRepositoryInterface $eventRepository, UserRepositoryInterface $userRepository, UserServiceInterface $userService)
    {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    //
    public function getAdminDashboardStatistics()
    {
        try {
            $allEvents = $this->eventRepository->getEventCount();
            $allUsers = $this->userRepository->getAllUsers();
            $filtredUsers = $this->userService->filterUsersByOrganizer($allUsers);
            return response()->json(
                [
                    'allEvents' => $allEvents,
                    'allUsers' => count($allUsers),
                    'allOrganizers' => $filtredUsers,
                ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
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
