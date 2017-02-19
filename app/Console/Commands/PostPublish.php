<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Post;

class PostPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '記事を公開する';

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
        $posts = Post::where('status', 'FUTURE')
            ->whereDate('published_at', '<=', Carbon::now())
            ->get();

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->publish();
            }
            $this->info('記事を公開しました。[' . count($posts) . '件]');
        }
    }
}
