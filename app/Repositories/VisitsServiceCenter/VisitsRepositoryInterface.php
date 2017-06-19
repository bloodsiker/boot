<?php
namespace App\Repositories\VisitsServiceCenter;

interface VisitsRepositoryInterface
{
    public function addVisits($id);

    public function allVisits($id);

    public function visitsBetween($id, $start, $end);

    public function allSumVisits($id);

    public function allSumHosts($id);
}