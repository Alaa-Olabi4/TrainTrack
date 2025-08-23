<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Task;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReportController extends Controller
{
    public function SystemReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date']
        ]);

        $start = $request->start_date;
        $end   = $request->end_date;

        $dateFilter = function ($query) use ($start, $end) {
            return $query->whereBetween('created_at', [$start, $end]);
        };

        $data = [
            // Users
            'users_count'            => $dateFilter(User::query())->count(),
            'active_users_count'     => $dateFilter(User::where('status', true))->count(),
            'trainers_count'         => $dateFilter(User::where('role_id', 3))->count(),
            'active_trainers_count'  => $dateFilter(User::where('status', true)->where('role_id', 3))->count(),

            // Sections & Categories
            'sections_count'         => $dateFilter(Section::query())->count(),
            'categories_count'       => $dateFilter(Category::query())->count(),

            // Inquiries
            'inquiries_count'        => $dateFilter(Inquiry::query())->count(),
            'closed_inquiries_count' => $dateFilter(Inquiry::where('cur_status_id', 3))->count(),
            'opened_inquiries_count' => $dateFilter(Inquiry::where('cur_status_id', 1))->count(),
            'pending_inquiries_count' => $dateFilter(Inquiry::where('cur_status_id', 2))->count(),
            'reopened_inquiries_count' => $dateFilter(Inquiry::where('cur_status_id', 4))->count(),
        ];

        // Sum of closing times in minutes
        $totalMinutes = Inquiry::where('cur_status_id', 3)
            ->get()
            ->reduce(function ($carry, $inq) {
                $created = Carbon::parse($inq->created_at);
                $closed  = Carbon::parse($inq->closed_at);
                return $carry + $closed->diffInMinutes($created);
            }, 0);

        if ($data['closed_inquiries_count'] > 0) {
            $avgMinutes = $totalMinutes / $data['closed_inquiries_count'];
            $hours   = floor($avgMinutes / 60);
            $minutes = round($avgMinutes % 60);

            $data['avg_closing'] = sprintf('%d:%02d', $hours, $minutes);
        } else {
            $data['avg_closing'] = '0:00';
        }
        return $data;
    }

    public function SystemReportExcel() {}


    public function TrainerReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date']
        ]);

        $start = $request->start_date;
        $end   = $request->end_date;

        $dateFilter = function ($query) use ($start, $end) {
            return $query->whereBetween('created_at', [$start, $end]);
        };

        $data = [];
        $i = 0;

        $users = User::where('role_id', 3)
            ->where('status', 1)
            ->get();

        foreach ($users as $user) {
            $inquiries = $user->assignedInquiries()->where($dateFilter);

            $totalResponded = (clone $inquiries)->count();
            $opened   = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'opened'))->count();
            $closed   = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'closed'))->count();
            $pending  = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'pending'))->count();
            $reopened = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'reopened'))->count();

            // Average closing time in seconds
            $avgClosingSeconds = (clone $inquiries)
                ->whereHas('status', fn($q) => $q->where('name', 'closed'))
                ->whereNotNull('closed_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, closed_at)) as avg_seconds')
                ->value('avg_seconds');

            $avgClosingFormatted = null;
            if ($avgClosingSeconds !== null) {
                $hours = floor($avgClosingSeconds / 3600);
                $minutes = floor(($avgClosingSeconds % 3600) / 60);
                $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
            }

            // Average evaluation
            // $avgEvaluation = (clone $inquiries)
            //     ->join('evaluations', 'evaluations.inquiry_id', '=', 'inquiries.id')
            //     ->avg('evaluations.score');

            // Last user they delegated to in the given period
            $lastDelegatedUser = Task::where('owner_id', $user->id)
                ->whereBetween('created_at', [$start, $end])
                ->latest('created_at')
                ->with('delegation')
                ->first();

            $data[$i] = [
                'user_id'                  => $user->id,
                'username'                 => $user->name,
                'total_responded_inquiries' => $totalResponded,
                'opened_inquiries'         => $opened,
                'closed_inquiries'         => $closed,
                'pending_inquiries'        => $pending,
                'reopened_inquiries'       => $reopened,
                'avg_closing_hours'        => $avgClosingFormatted,
                // 'avg_evaluation'           => $avgEvaluation ? round($avgEvaluation, 2) : null,
                'last_delegated_user'      => $lastDelegatedUser?->delegation?->name,
            ];
            $i++;
        }

        return $data;
    }


    public function myDailyReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date']
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end   = Carbon::parse($request->end_date)->endOfDay();

        $user = User::findOrFail(auth()->user()->id); // current trainer

        $period = CarbonPeriod::create($start, $end);

        $report = [];

        foreach ($period as $date) {
            $dayStart = $date->copy()->startOfDay();
            $dayEnd   = $date->copy()->endOfDay();

            $inquiries = $user->assignedInquiries()
                ->whereBetween('created_at', [$dayStart, $dayEnd]);

            $totalResponded = (clone $inquiries)->count();
            $opened   = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'opened'))->count();
            $closed   = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'closed'))->count();
            $pending  = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'pending'))->count();
            $reopened = (clone $inquiries)->whereHas('status', fn($q) => $q->where('name', 'reopened'))->count();

            $avgClosingSeconds = (clone $inquiries)
                ->whereHas('status', fn($q) => $q->where('name', 'closed'))
                ->whereNotNull('closed_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, closed_at)) as avg_seconds')
                ->value('avg_seconds');

            // Convert to HH:MM
            $avgClosingFormatted = null;
            if ($avgClosingSeconds !== null) {
                $hours = floor($avgClosingSeconds / 3600);
                $minutes = floor(($avgClosingSeconds % 3600) / 60);
                $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
            }

            // Average evaluation
            // $avgEvaluation = (clone $inquiries)
            //     ->join('evaluations', 'evaluations.inquiry_id', '=', 'inquiries.id')
            //     ->avg('evaluations.score');

            $followUpsCount = $user->followUps()
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->count();

            $lastDelegation = $user->delegatedTasks()
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->latest('created_at')
                ->with('owner')
                ->first();

            $report[] = [
                'date'                  => $date->format('Y-m-d'),
                'total_responded'       => $totalResponded,
                'opened'                => $opened,
                'closed'                => $closed,
                'pending'               => $pending,
                'reopened'              => $reopened,
                'avg_closing'           => $avgClosingFormatted,
                // 'avg_evaluation'        => $avgEvaluation ? round($avgEvaluation, 2) : null,
                'followups'             => $followUpsCount,
                'last_delegation_from'  => $lastDelegation?->owner?->name,
            ];
        }

        $totals = [
            'date'            => 'Total',
            'total_responded' => array_sum(array_column($report, 'total_responded')),
            'opened'          => array_sum(array_column($report, 'opened')),
            'closed'          => array_sum(array_column($report, 'closed')),
            'pending'         => array_sum(array_column($report, 'pending')),
            'reopened'        => array_sum(array_column($report, 'reopened')),
            'avg_closing'     => null,
            // 'avg_evaluation'  => null,
            'followups'       => array_sum(array_column($report, 'followups')),
            'last_delegation_from' => '-', 
        ];

        // حساب متوسط زمن الإغلاق (بالثواني)
        $closingSeconds = [];
        foreach ($report as $row) {
            if (!empty($row['avg_closing'])) {
                [$h, $m] = explode(':', $row['avg_closing']);
                $closingSeconds[] = ($h * 3600) + ($m * 60);
            }
        }
        if (count($closingSeconds) > 0) {
            $avgSec = array_sum($closingSeconds) / count($closingSeconds);
            $hours = floor($avgSec / 3600);
            $minutes = floor(($avgSec % 3600) / 60);
            $totals['avg_closing'] = sprintf('%02d:%02d', $hours, $minutes);
        }

        // متوسط التقييم
        // $evaluations = array_filter(array_column($report, 'avg_evaluation'));
        // if (count($evaluations) > 0) {
        //     $totals['avg_evaluation'] = round(array_sum($evaluations) / count($evaluations), 2);
        // }

        $report[] = $totals;

        return $report;
    }
}
