<?php

namespace App\Http\Controllers\WebApi;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewCountController extends Controller
{
    public function index(Request $request)
    {
        $query = \DB::table('redirect_logs')
            ->selectRaw('count(domain_id) as view_count, DATE_FORMAT(`created_at`, \'%Y-%m-%d\') as view_date')
            ->groupBy('view_date');

        // 查询 days 天以内数据
        $days = (int)$request->get('days');
        if ($days) {
            $query->where('created_at', '>=', (new Carbon())->subDays($days));
        }

        // 查询 domain_id 下的数据
        $domainId = (int)$request->get('domain_id');
        if ($domainId) {
            $query->where('domain_id', $domainId);
        }

        $viewCount = $query->get();

        return $this->jsonResponse->success200($viewCount);
    }
}
