<?php
namespace App\Http\Controllers\Admin;

use App\Models\Domain;
use App\Models\RedirectLog;
use App\Models\Url;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $domainNumber = Domain::count();
        $urlNumber = Url::count();
        $viewNumber = [
            'lastMonth' => RedirectLog::where('created_at', '>=', (new Carbon())->subMonth())->count(),
            'lastWeek' => RedirectLog::where('created_at', '>=', (new Carbon())->subWeek())->count(),
        ];

        return view('admin.dashboard.index', [
            'domainNumber' => $domainNumber,
            'urlNumber' => $urlNumber,
            'viewNumber' => $viewNumber,
        ]);
    }
}
