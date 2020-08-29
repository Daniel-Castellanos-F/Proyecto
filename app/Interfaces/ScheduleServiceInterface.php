<?php namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
	public function isAvailableInterval($date, $escenarioId, Carbon $start);
	public function getAvailableIntervals($date, $escenarioId);
}