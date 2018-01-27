<?php

error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set( 'display_errors', 1 );


use App\Task;
use App\Entry;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksDbTest extends TestCase
{
    /**
     * リレーションのテスト その1
     * laravel の暗黙に従わない場合の面倒な話
     *
     * @return void
     * 
     * 参考https://qiita.com/zaburo/items/d665804f8ea850502c64
     * リレーションをtasks.entry_id = entries.id なら簡単なのにね。
     * ちょっと違う:-p
     */
    public function testTaskDb1()
    {
        $ra = Task::orderBy('id', 'asc')->paginate(1)->toArray();
#        var_dump($ra['data'][0]);
        $this->assertEquals($ra['data'][0]['id'], 1);
        $this->assertEquals($ra['data'][0]['entries_id'], 1);
        $tasks = Task::select()
                    ->join('entries', 'tasks.entries_id','=','entries.id')
                    ->orderBy('tasks.id','asc')
//                    ->get();    //これなら$a[]['id']
                    ->first();    // こっちは1レコードなので$a['id']が返る

        $ra=$tasks->toArray();
//        var_dump($ra);
//        echo $ra['title']." ".$ra['log']."<br>\n";
        $this->assertEquals($ra['title'],"title1");

        $tasks = Task::select()
                    ->join('entries', 'tasks.entries_id','=','entries.id')
                    ->orderBy('tasks.id','asc')
                    ->get();    //これなら$a[]['id']
//                    ->first();    // こっちは1レコードなので$a['id']が返る

        $ra=$tasks->toArray();
//        echo $ra[0]['title']." ".$ra[0]['log']."<br>\n";
        $this->assertEquals($ra[0]['title'],"title1");
    }
    /**
     * リレーションのテスト その2
     * laravel の暗黙に従った場合
     *
     * @return void
     * 
     * 参考https://qiita.com/zaburo/items/d665804f8ea850502c64
     * リレーションをtasks.Entry_id = entries.id なら簡単なのにね。
     */
    public function testTaskDb2()
    {
        $task = App\Task::find(1);
        $r = $task->entry->title;
        $this->assertEquals($r, 'title1');
        $r = $task->log;;
        $this->assertEquals($r, 'log1');

        $task = App\Task::find(2);
        $r = $task->entry->title;
        $this->assertEquals($r, 'title2');
        $r = $task->log;;
        $this->assertEquals($r, 'log2');
    }
}
