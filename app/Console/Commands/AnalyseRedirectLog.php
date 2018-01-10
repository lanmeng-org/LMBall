<?php

namespace App\Console\Commands;

use App\Models\RedirectLog;
use Illuminate\Console\Command;
use Lanmeng\Utils\IPUtil;

class AnalyseRedirectLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analyse:redirect_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyse Redirect Log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $redirectLogs = RedirectLog::whereNull('client_country')
            ->whereNotNull('client_ip')
            ->take(100)
            ->get();

        foreach ($redirectLogs as $redirectLog) {
            $client_ip = long2ip($redirectLog->client_ip);

            $this->info("正在解析 $client_ip");
            $ipInfo = IPUtil::getIpInfoFromTaobao($client_ip);

            if (empty($ipInfo)) {
                continue;
            }

            $redirectLog->client_country = $ipInfo->country;
            $redirectLog->client_city = $ipInfo->city;
            $redirectLog->client_region = $ipInfo->region;
            $redirectLog->client_isp = $ipInfo->isp;
            $redirectLog->save();
        }
    }
}
