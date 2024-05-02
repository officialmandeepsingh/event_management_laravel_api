<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{


    /* public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
        // $this-> ('auth:sanctum', ['except' => ['index', 'show']]);
    } */

    use CanLoadRelationships;

    // public function __construct(){
    //     $this->middleware('auth:sanctum')->except(['index', 'show']);
    // }



    private array $relations = ['user', 'attendees', 'attendees.user'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Event::all();
        // return EventResource::collection(Event::with('user', 'attendees')->get());

        /* $query = Event::query();
        $relations = ['user', 'attendees'];
        foreach ($relations as $relation) {
            $query->when(
                $this->shouldIncludeRelation($relation),
                fn ($q) => $q->with($relation)
            );
        } */

        $query = $this->loadRelationships(Event::query());
        return EventResource::collection($query->latest()->paginate());
    }

    /* protected function shouldIncludeRelation(string $relation): bool
    {
        $include = request()->query('include');

        if (!$include) {
            return false;
        }

        $relations = array_map('trim', explode(',', $include));

        return in_array($relation, $relations);
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {

        // $event = Event::create([
        //     ...$request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'nullable|string',
        //         'start_time' => 'required|date',
        //         'end_time' => 'required|date|after:start_time'
        //     ]),
        //     'user_id' => 1
        // ]);

        // return new EventResource($event);
        $event = Event::create([...$request->validated(), 'user_id' => 1]);
        // return new EventResource($event);
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user', 'attendees');
        // return $event;
        // return new EventResource($event);
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        //     $event->update(
        //         $request->validate([
        //             'name' => 'sometimes|string|max:255',
        //             'description' => 'nullable|string',
        //             'start_time' => 'sometimes|date',
        //             'end_time' => 'sometimes|date|after:start_time'
        //         ])
        //     );

        $event->update($request->validated());
        // return new EventResource($event);
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response(status: 204);
    }
}
