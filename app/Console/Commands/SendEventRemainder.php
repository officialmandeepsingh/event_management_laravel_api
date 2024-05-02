<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventRemainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all event atttendes that event starts soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Calling Event Command");
        $events = Event::with('attendees.user')->whereBetween('start_time', [now(), now()->addDay()])->get();
        $eventCount = $events->count();
        $eventLabel = Str::plural('Event', $eventCount);
        $events->each(
            fn ($event) => $event->attendees->each(
                fn ($attendee) => $this->info("Notifying the user {$attendee->user->name}")
            )
        );
        $this->info('Reminder notifications sent successfully!');
    }
}
