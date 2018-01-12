<?php

namespace App\Console\Commands;

use App\Models\RedirectLog;
use Illuminate\Console\Command;
use Lanmeng\Utils\IPUtil;
use Lanmeng\Utils\UserAgentUtil;

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
        $this->analyseUserAgent();
        $this->analyseReferer();
        $this->analyseIp();
    }

    protected function analyseIp()
    {
        $redirectLogs = RedirectLog::whereNotNull('client_ip')
            ->whereNull('client_country')
            ->take(100)
            ->get(['id', 'client_country', 'client_ip', 'client_city', 'client_region', 'client_isp']);

        foreach ($redirectLogs as $redirectLog) {
            $client_ip = long2ip($redirectLog->client_ip);
            $ipInfo = IPUtil::getIpInfoFromTaobao($client_ip);

            if (empty($ipInfo)) {
                continue;
            }

            $redirectLog->client_country = $ipInfo->country ?: '未知';
            $redirectLog->client_city = $ipInfo->city ?: '未知';
            $redirectLog->client_region = $ipInfo->region ?: '未知';
            $redirectLog->client_isp = $ipInfo->isp ?: '未知';
            $redirectLog->save();
            sleep(2);
        }
    }

    protected function analyseUserAgent()
    {
        $redirectLogs = RedirectLog::whereNotNull('client_browser_user_agent')
            ->where(function ($query) {
                $query->whereNull('client_browser')
                    ->orWhereNull('client_os');
            })
            ->take(100)
            ->get(['id', 'client_browser', 'client_browser_user_agent', 'client_os']);

        foreach ($redirectLogs as $redirectLog) {
            $info = UserAgentUtil::parseInfo($redirectLog->client_browser_user_agent);

            $redirectLog->client_browser = $info['browser'];
            $redirectLog->client_os = $info['os'];
            $redirectLog->save();
        }
    }

    protected function analyseReferer()
    {
        $redirectLogs = RedirectLog::whereNotNull('referer_url')
            ->whereNull('referer_domain')
            ->take(100)
            ->get(['id', 'referer_domain', 'referer_url']);

        foreach ($redirectLogs as $redirectLog) {
            $piece = parse_url($redirectLog->referer_url);
            if (empty($piece['host'])) {
                continue;
            }

            $redirectLog->referer_domain = $piece['host'];
            $redirectLog->save();
        }
    }
}
