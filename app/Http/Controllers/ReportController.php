<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Task;
use App\Models\Report;
use App\Models\Rating;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use Rap2hpoutre\FastExcel\FastExcel;
use OpenSpout\Common\Entity\Style\Style;

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

        //Avearge rating
        $ratings = $dateFilter(Rating::all());
        $total_ratings = 0;
        $ratings_cnt = count($ratings);
        if ($ratings_cnt > 0) {
            foreach ($ratings as $r) {
                $total_ratings += $r->score;
            }
            $avgRatings = $total_ratings / $ratings_cnt;
            $data['avgRatings'] = $avgRatings;
        } else {
            $data['avgRatings'] = 0;
        }
        return response()->json($data);
    }
    public function SystemReportExcel(Request $request)
    {
        $data = json_decode($this->SystemReport($request)->content());

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_systemReport.xlsx';

        $path = public_path('reports/SystemReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'SystemReport',
            'content' => $path
        ]);

        (new FastExcel([$data]))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    "users count" => $val->users_count,
                    "active users count" => $val->active_users_count,
                    "trainers count" => $val->trainers_count,
                    "active trainers count" => $val->active_trainers_count,
                    "sections count" => $val->sections_count,
                    "categories count" => $val->categories_count,
                    "inquiries count" => $val->inquiries_count,
                    "closed inquiries count" => $val->closed_inquiries_count,
                    "opened inquiries count" => $val->opened_inquiries_count,
                    "pending inquiries count" => $val->pending_inquiries_count,
                    "reopened inquiries count" => $val->reopened_inquiries_count,
                    "avg closing" => $val->avg_closing,
                    "avg Ratings" => $val->avgRatings,
                ];
            });

        return response()->download($path)->deleteFileAfterSend(false);
    }

    public function categoryReport(Request $request)
    {
        $request->validate([
            'start_date'   => ['nullable', 'date'],
            'end_date'     => ['nullable', 'date'],
            'assignee_id'  => ['nullable', 'integer', 'exists:users,id']
        ]);

        $start      = $request->start_date;
        $end        = $request->end_date;
        $assigneeId = $request->assignee_id;

        $filters = function ($q) use ($start, $end, $assigneeId) {
            if ($start && $end) {
                $q->whereBetween('created_at', [$start, $end]);
            }
            if ($assigneeId) {
                $q->where('assignee_id', $assigneeId);
            }
        };

        $categories = Category::with([
            'inquiries' => function ($q) use ($filters) {
                $filters($q);
                $q->with(['status', 'ratings']);
            }
        ])
            ->withCount([
                'inquiries as total_inquiries' => function ($q) use ($filters) {
                    $filters($q);
                },
                'inquiries as opened_inquiries' => function ($q) use ($filters) {
                    $filters($q);
                    $q->whereHas('status', fn($s) => $s->where('name', 'opened'));
                },
                'inquiries as closed_inquiries' => function ($q) use ($filters) {
                    $filters($q);
                    $q->whereHas('status', fn($s) => $s->where('name', 'closed'));
                },
                'inquiries as pending_inquiries' => function ($q) use ($filters) {
                    $filters($q);
                    $q->whereHas('status', fn($s) => $s->where('name', 'pending'));
                },
                'inquiries as reopened_inquiries' => function ($q) use ($filters) {
                    $filters($q);
                    $q->whereHas('status', fn($s) => $s->where('name', 'reopened'));
                },
            ])
            ->get()
            ->map(function ($category) {
                $closedInquiries = $category->inquiries->filter(function ($inq) {
                    return $inq->status->name === 'closed' && $inq->closed_at;
                });

                $avgClosingFormatted = null;
                if ($closedInquiries->count() > 0) {
                    $totalSeconds = $closedInquiries->reduce(function ($carry, $inq) {
                        return $carry + $inq->created_at->diffInSeconds($inq->closed_at);
                    }, 0);

                    $avgSeconds = $totalSeconds / $closedInquiries->count();
                    $hours = floor($avgSeconds / 3600);
                    $minutes = floor(($avgSeconds % 3600) / 60);
                    $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
                }

                $avgRating = null;
                if ($category->inquiries->count() > 0) {
                    $scores = $category->inquiries->flatMap(function ($inq) {
                        return $inq->ratings->pluck('score');
                    });
                    if ($scores->count() > 0) {
                        $avgRating = round($scores->avg(), 2);
                    }
                }

                return [
                    'category_id'        => $category->id,
                    'category_name'      => $category->name,
                    'category_weight'      => $category->weight,
                    'total_inquiries'    => $category->total_inquiries,
                    'opened_inquiries'   => $category->opened_inquiries,
                    'closed_inquiries'   => $category->closed_inquiries,
                    'pending_inquiries'  => $category->pending_inquiries,
                    'reopened_inquiries' => $category->reopened_inquiries,
                    'avg_closing'        => $avgClosingFormatted,
                    'avg_rating'     => $avgRating,
                ];
            });

        $totals = [
            'category_id'        => null,
            'category_name'      => 'Total',
            'category_weight'    => $categories->sum('category_weight'),
            'total_inquiries'    => $categories->sum('total_inquiries'),
            'opened_inquiries'   => $categories->sum('opened_inquiries'),
            'closed_inquiries'   => $categories->sum('closed_inquiries'),
            'pending_inquiries'  => $categories->sum('pending_inquiries'),
            'reopened_inquiries' => $categories->sum('reopened_inquiries'),
            'avg_closing'        => null,
            'avg_rating'     => null,
        ];

        $allClosed = Inquiry::whereHas('status', fn($s) => $s->where('name', 'closed'))
            ->whereNotNull('closed_at')
            ->when($start && $end, fn($q) => $q->whereBetween('created_at', [$start, $end]))
            ->when($assigneeId, fn($q) => $q->where('assignee_id', $assigneeId))
            ->get();

        if ($allClosed->count() > 0) {
            $totalSeconds = $allClosed->reduce(function ($carry, $inq) {
                return $carry + $inq->created_at->diffInSeconds($inq->closed_at);
            }, 0);
            $avgSeconds = $totalSeconds / $allClosed->count();
            $hours = floor($avgSeconds / 3600);
            $minutes = floor(($avgSeconds % 3600) / 60);
            $totals['avg_closing'] = sprintf('%02d:%02d', $hours, $minutes);
        }

        $allScores = Rating::when($start && $end, function ($q) use ($start, $end) {
            $q->whereHas('inquiry', fn($inq) => $inq->whereBetween('created_at', [$start, $end]));
        })
            ->when($assigneeId, function ($q) use ($assigneeId) {
                $q->whereHas('inquiry', fn($inq) => $inq->where('assignee_id', $assigneeId));
            })
            ->pluck('score');

        if ($allScores->count() > 0) {
            $totals['avg_rating'] = round($allScores->avg(), 2);
        }

        $categories->push($totals);

        return $categories;
    }
    public function CategoryReportExcel(Request $request)
    {
        $data = $this->categoryReport($request);

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_categoryReport.xlsx';

        $path = public_path('reports/CategoryReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'categoryReport',
            'content' => $path
        ]);

        (new FastExcel($data))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    'category_id'        => $val['category_id'],
                    'category_name'      => $val['category_name'],
                    'category_weight'    => $val['category_weight'],
                    'total_inquiries'    => $val['total_inquiries'],
                    'opened_inquiries'   => $val['opened_inquiries'],
                    'closed_inquiries'   => $val['closed_inquiries'],
                    'pending_inquiries'  => $val['pending_inquiries'],
                    'reopened_inquiries' => $val['reopened_inquiries'],
                    'avg_closing'        => $val['avg_closing'],
                ];
            });
        return response()->download($path)->deleteFileAfterSend(false);
    }

    public function TrainerReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date']
        ]);

        $start = $request->start_date;
        $end   = $request->end_date;

        $users = User::where('role_id', 3)
            ->where('status', 1)
            ->get();

        $data = [];

        foreach ($users as $user) {
            $inquiries = $user->assignedInquiries()
                ->whereBetween('inquiries.created_at', [$start, $end]);

            $statusCounts = (clone $inquiries)
                ->selectRaw("
                SUM(CASE WHEN statuses.name = 'opened' THEN 1 ELSE 0 END) as opened_count,
                SUM(CASE WHEN statuses.name = 'closed' THEN 1 ELSE 0 END) as closed_count,
                SUM(CASE WHEN statuses.name = 'pending' THEN 1 ELSE 0 END) as pending_count,
                SUM(CASE WHEN statuses.name = 'reopened' THEN 1 ELSE 0 END) as reopened_count,
                COUNT(*) as total_count
            ")
                ->join('statuses', 'statuses.id', '=', 'inquiries.cur_status_id')
                ->first();

            $avgClosingSeconds = (clone $inquiries)
                ->whereHas('status', fn($q) => $q->where('name', 'closed'))
                ->whereNotNull('closed_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, inquiries.created_at, closed_at)) as avg_seconds')
                ->value('avg_seconds');

            $avgClosingFormatted = null;
            if ($avgClosingSeconds !== null) {
                $hours = floor($avgClosingSeconds / 3600);
                $minutes = floor(($avgClosingSeconds % 3600) / 60);
                $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
            }

            $avgRating = (clone $inquiries)
                ->join('ratings', 'ratings.inquiry_id', '=', 'inquiries.id')
                ->avg('ratings.score');

            $lastDelegatedUser = Task::where('owner_id', $user->id)
                ->whereBetween('tasks.created_at', [$start, $end])
                ->latest('tasks.created_at')
                ->with('delegation')
                ->first();

            $data[] = [
                'user_id'                  => $user->id,
                'username'                 => $user->name,
                'total_responded_inquiries' => $statusCounts->total_count ?? 0,
                'opened_inquiries'         => $statusCounts->opened_count ?? 0,
                'closed_inquiries'         => $statusCounts->closed_count ?? 0,
                'pending_inquiries'        => $statusCounts->pending_count ?? 0,
                'reopened_inquiries'       => $statusCounts->reopened_count ?? 0,
                'avg_closing_hours'        => $avgClosingFormatted,
                'avg_rating'               => $avgRating ? round($avgRating, 2) : null,
                'last_delegated_user'      => $lastDelegatedUser?->delegation?->name,
            ];
        }

        return $data;
    }

    public function TrainerReportExcel(Request $request)
    {
        $data = $this->TrainerReport($request);

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_trainerReport.xlsx';

        $path = public_path('reports/TrainerReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'TrainerReport',
            'content' => $path
        ]);

        (new FastExcel($data))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    'User id'                  => $val['user_id'],
                    'Username'                 => $val['username'],
                    'Total Responded Inquiries' => $val['total_responded_inquiries'],
                    'Opened Inquiries'         => $val['opened_inquiries'],
                    'Closed Inquiries'         => $val['closed_inquiries'],
                    'Pending Inquiries'        => $val['pending_inquiries'],
                    'Reopened Inquiries'       => $val['reopened_inquiries'],
                    'Avg Closing Hours'        => $val['avg_closing_hours'],
                    'Avg Rating'           => $val['avg_rating'],
                    'Last Delegated User'      => $val['last_delegated_user'],
                ];
            });
        return response()->download($path)->deleteFileAfterSend(false);
    }

    public function Trainers()
    {
        $data = [];
        $i = 0;

        $users = User::where('role_id', 3)
            ->where('status', 1)
            ->get();

        foreach ($users as $user) {
            $inquiries = $user->assignedInquiries();

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

            $avgRating = (clone $inquiries)
                ->join('ratings', 'ratings.inquiry_id', '=', 'inquiries.id')
                ->avg('ratings.score');

            $lastDelegatedUser = Task::where('owner_id', $user->id)
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
                'avg_rating'           => $avgRating ? round($avgRating, 2) : null,
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

        $user = auth()->user();
        $period = CarbonPeriod::create($start, $end);

        $report = [];

        foreach ($period as $date) {
            $dayStart = $date->copy()->startOfDay();
            $dayEnd   = $date->copy()->endOfDay();

            $query = Inquiry::with(['status'])
                ->where('assignee_id', $user->id)
                ->whereBetween('created_at', [$dayStart, $dayEnd]);

            $report[] = $this->calculateMetrics($query, $date->format('Y-m-d'), $user, $dayStart, $dayEnd);
        }

        $report[] = $this->calculateTotals($report);

        return $report;
    }
    public function myDailyReportExcel(Request $request)
    {
        $data = $this->myDailyReport($request);

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_dailyReport.xlsx';

        $path = public_path('reports/DailyReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'myDailyReport',
            'content' => $path
        ]);

        (new FastExcel($data))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    'date'                  => $val['date'],
                    'total_responded'       => $val['total_responded'],
                    'opened'                => $val['opened'],
                    'closed'                => $val['closed'],
                    'pending'               => $val['pending'],
                    'reopened'              => $val['reopened'],
                    'avg_closing'           => $val['avg_closing'],
                    'avg_rating'            => $val['avg_rating'],
                    'followups'             => $val['followups'],
                    'last_delegation_from'  => $val['last_delegation_from'],
                ];
            });
        return response()->download($path)->deleteFileAfterSend(false);
    }
    public function myWeeklyReport(Request $request)
    {
        $request->validate([
            'month' => ['required', 'date_format:Y-m']
        ]);

        $start = Carbon::createFromFormat('Y-m', $request->month)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        $user = auth()->user();
        $report = [];

        $currentStart = $start->copy();

        while ($currentStart->lte($end)) {
            $weekStart = $currentStart->copy();

            if ($weekStart->dayOfWeek !== Carbon::SATURDAY) {
                $daysToFriday = (Carbon::FRIDAY - $weekStart->dayOfWeek + 7) % 7;
                $weekEnd = $weekStart->copy()->addDays($daysToFriday);
            } else {
                $weekEnd = $weekStart->copy()->addDays(6);
            }

            if ($weekEnd->gt($end)) {
                $weekEnd = $end->copy();
            }

            $query = Inquiry::with(['status'])
                ->where('assignee_id', $user->id)
                ->whereBetween('created_at', [$weekStart, $weekEnd]);

            $label = $weekStart->format('Y-m-d') . ' → ' . $weekEnd->format('Y-m-d');
            $report[] = $this->calculateMetrics($query, $label, $user, $weekStart, $weekEnd);

            $currentStart = $weekEnd->copy()->addDay();
        }

        $report[] = $this->calculateTotals($report);

        return $report;
    }
    public function myWeeklyReportExcel(Request $request)
    {
        $data = $this->myWeeklyReport($request);

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_weeklyReport.xlsx';

        $path = public_path('reports/WeeklyReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'myWeeklyReport',
            'content' => $path
        ]);

        (new FastExcel($data))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    'date'                  => $val['date'],
                    'total_responded'       => $val['total_responded'],
                    'opened'                => $val['opened'],
                    'closed'                => $val['closed'],
                    'pending'               => $val['pending'],
                    'reopened'              => $val['reopened'],
                    'avg_closing'           => $val['avg_closing'],
                    'avg_rating'            => $val['avg_rating'],
                    'followups'             => $val['followups'],
                    'last_delegation_from'  => $val['last_delegation_from'],
                ];
            });
        return response()->download($path)->deleteFileAfterSend(false);
    }
    public function myMonthlyReport(Request $request)
    {
        $request->validate([
            'year' => ['required', 'digits:4', 'integer']
        ]);

        $start = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
        $end   = $start->copy()->endOfYear();

        $user = auth()->user();
        $report = [];
        $currentStart = $start->copy();

        while ($currentStart->lte($end)) {
            $monthStart = $currentStart->copy();
            $monthEnd   = $currentStart->copy()->endOfMonth();

            $query = Inquiry::with(['status'])
                ->where('assignee_id', $user->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd]);

            $label = $monthStart->format('F Y');
            $report[] = $this->calculateMetrics($query, $label, $user, $monthStart, $monthEnd);

            $currentStart->addMonth();
        }

        $report[] = $this->calculateTotals($report);

        return $report;
    }
    public function myMonthlyReportExcel(Request $request)
    {
        $data = $this->myMonthlyReport($request);

        $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

        $header_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border)

            ->setFontBold()
            ->setBackgroundColor("EDEDED");


        $rows_style = (new Style())
            ->setFontSize(15)
            ->setShouldWrapText()

            ->setCellAlignment('center')
            ->setCellVerticalAlignment('center')

            ->setBorder($border);

        $filename = time() . '_monthlyReport.xlsx';

        $path = public_path('reports/MonthlyReports/' . $filename);

        Report::create([
            'created_by' => auth()->user()->id,
            'type' => 'myMonthlyReport',
            'content' => $path
        ]);

        (new FastExcel($data))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->export($path, function ($val) {
                return [
                    'date'                  => $val['date'],
                    'total_responded'       => $val['total_responded'],
                    'opened'                => $val['opened'],
                    'closed'                => $val['closed'],
                    'pending'               => $val['pending'],
                    'reopened'              => $val['reopened'],
                    'avg_closing'           => $val['avg_closing'],
                    'avg_rating'            => $val['avg_rating'],
                    'followups'             => $val['followups'],
                    'last_delegation_from'  => $val['last_delegation_from'],
                ];
            });
        return response()->download($path)->deleteFileAfterSend(false);
    }
    //Helper functions
    private function calculateMetrics($query, $label, $user, $startDate, $endDate)
    {
        $opened   = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'opened'))
            ->count();

        $closed   = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'closed'))
            ->count();

        $pending  = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'pending'))
            ->count();

        $reopened = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'reopened'))
            ->count();

        $totalResponded = (clone $query)->count();

        $avgClosingSeconds = (clone $query)
            ->whereHas('status', fn($q) => $q->where('name', 'closed'))
            ->whereNotNull('closed_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, inquiries.created_at, closed_at)) as avg_seconds')
            ->value('avg_seconds');

        $avgClosingFormatted = null;
        if ($avgClosingSeconds !== null) {
            $hours = floor($avgClosingSeconds / 3600);
            $minutes = floor(($avgClosingSeconds % 3600) / 60);
            $avgClosingFormatted = sprintf('%02d:%02d', $hours, $minutes);
        }

        $avgRating = Rating::join('inquiries', 'ratings.inquiry_id', '=', 'inquiries.id')
            ->where('inquiries.assignee_id', $user->id)
            ->whereBetween('ratings.created_at', [$startDate, $endDate])
            ->avg('ratings.score');

        $avgRating = $avgRating ?: 0;

        $followUpsCount = $user->followUps()
            ->whereBetween('follow_ups.created_at', [$startDate, $endDate])
            ->count();

        $lastDelegation = $user->delegatedTasks()
            ->whereBetween('tasks.created_at', [$startDate, $endDate])
            ->latest('tasks.created_at')
            ->with('owner')
            ->first();

        return [
            'date'                  => $label,
            'total_responded'       => $totalResponded,
            'opened'                => $opened,
            'closed'                => $closed,
            'pending'               => $pending,
            'reopened'              => $reopened,
            'avg_closing'           => $avgClosingFormatted,
            'avg_rating'            => $avgRating ? round($avgRating, 2) : null,
            'followups'             => $followUpsCount,
            'last_delegation_from'  => $lastDelegation?->owner?->name,
        ];
    }

    private function calculateTotals($report)
    {
        $totals = [
            'date'            => 'Total',
            'total_responded' => array_sum(array_column($report, 'total_responded')),
            'opened'          => array_sum(array_column($report, 'opened')),
            'closed'          => array_sum(array_column($report, 'closed')),
            'pending'         => array_sum(array_column($report, 'pending')),
            'reopened'        => array_sum(array_column($report, 'reopened')),
            'avg_closing'     => null,
            'avg_rating'  => null,
            'followups'       => array_sum(array_column($report, 'followups')),
            'last_delegation_from' => '-',
        ];

        $closingSeconds = [];
        foreach ($report as $row) {
            if (!empty($row['avg_closing']) && $row['avg_closing'] !== '-') {
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

        $ratings = array_filter(array_column($report, 'avg_rating'));
        if (count($ratings) > 0) {
            $totals['avg_rating'] = round(array_sum($ratings) / count($ratings), 2);
        }

        return $totals;
    }
}
