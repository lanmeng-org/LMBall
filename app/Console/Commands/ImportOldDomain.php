<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Models\Url;
use Illuminate\Console\Command;
use Lanmeng\Utils\PDOUtil;

class ImportOldDomain extends Command
{

    protected $startInsertNumber = 100;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:old_domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import old domain';

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
        $pdo = PDOUtil::getPDOInstance();

        $this->importDomain($pdo);
        $this->importUrl($pdo);
    }

    protected function importDomain(\PDO $pdo)
    {
        $domains = $pdo->query('SELECT * FROM `lm_domain`');
        foreach ($domains as $domain) {
            $oldDomain = Domain::where('name', $domain['domain'])->first();
            if (empty($domain) || $oldDomain) {
                continue;
            }

            \DB::table('domains')->insert([
                'id'          => $domain['id'],
                'name'        => $domain['domain'],
                'description' => $domain['title'],
                'weight'      => $domain['sort'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->info($domain['domain']);
        }
    }

    protected function importUrl(\PDO $pdo)
    {
        $urls = $pdo->query('SELECT * FROM `lm_jump`');
        foreach ($urls as $url) {
            $oldUrl = Url::where('url', $url['url'])->first();
            if (empty($url['url']) || $oldUrl) {
                continue;
            }

            \DB::table('urls')->insert([
                'domain_id'    => $url['did'],
                'url'          => $url['url'],
                'redirect_url' => $url['jurl'],
                'description'  => $url['info'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->info($url['url']);
        }
    }
}
