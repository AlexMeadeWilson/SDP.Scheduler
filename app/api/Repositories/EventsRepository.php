<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class EventsRepository
{
    // Private Variables
    private $database;

    // Constructor
    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    // GET Events List: All
    public function getAll()
    {
        return $this->database->table('events')->get();
    }

    // GET Events List: Overdue
    public function getOverdue()
    {
        return $this->database
            ->table('events')
            ->whereRaw('Date(start) < CURDATE() AND status < 4')
            ->orderBy('start', 'asc')
            ->get();
    }

    // GET Events List: Today
    public function getToday()
    {
        return $this->database
            ->table('events')
            ->whereRaw('Date(start) = CURDATE() AND status < 4')
            ->orderBy('start', 'asc')
            ->get();
    }

    // GET Events List: Upcoming
    public function getUpcoming()
    {
        return $this->database
            ->table('events')
            ->whereRaw('Date(start) > CURDATE() AND status < 4')
            ->orderBy('start', 'asc')
            ->get();
    }

    // CREATE Events
    public function create(array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->insert($event);
    }

    // UPDATE Events by ID
    public function update(string $id, array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->where('id', $id)
            ->update($event);
    }

    // DELETE Events by ID
    public function delete(string $id): bool
    {
        return $this->database
            ->table('events')
            ->where('id', $id)
            ->delete();
    }

    // Validate the Job (Event) Fields
    private function validateEvent(array $event): array
    {
        return [
            'title' => $event['title'],
            'start' => $event['start'],
            'end' => $event['end'],
            'description' => $event['description'],
            'contact' => $event['contact'],
            'site' => $event['site'],
            'technician' => $event['technician'],
        ];
    }
}