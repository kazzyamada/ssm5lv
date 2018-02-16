<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Entry;
use App\Task;
use Validator;

use Illuminate\Http\Request;

class TaskController extends Controller {

    // constructor
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function selectedBoxTop($entries)
    {
        $n=0;
        foreach ($entries as $entry){
            $entry->selected = '';
            if ($n==0) $entry->selected = 'selected';
        }
        return $entries;
    }
    public function selectedBox($entries, $id)
    {
//        \Log::debug(__METHOD__.LP.RP.C.LP.__LINE__.RP.SP."id=$id");
        foreach ($entries as $entry){
            $entry->selected = '';
            if ($entry->id==$id) $entry->selected = 'selected';
        }
        return $entries;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Task::orderBy('id', 'desc')->paginate(10);

		return view('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $entries = DB::table('entries')->orderBy('id','desc')->get();
#        $entries = Entry::pluck('title', 'id');    // for 5.3

        $entries=$this->selectedBoxTop($entries);
//        var_dump($entries);

		return view('tasks.create', compact('entries'));
	}

	/**
	 * Show the form for copy form id and create a new resource.
	 *
	 * @return Response
	 */
	public function copy($id)
	{

#        \Log::debug('id='.$id);
		$task = Task::findOrFail($id);

        $entries = DB::table('entries')->orderBy('id','desc')->get();
#        $entries = Entry::pluck('title', 'id');    // for 5.3
        $entries=$this->selectedBox($entries, $task->entries_id);
//        var_dump($entries);
		return view('tasks.copy', compact('task'),compact('entries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'entries_id' => 'required|numeric|exists:entries,id',
            'log' => 'required|max:255',
            'task_day' => 'required',
            'task_hour' => 'required',
        ]);
        if ($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

		$task = new Task();
		$task->entries_id = $request->input("entries_id");
        $task->log = $request->input("log");
        $task->task_day = $request->input("task_day");
        $task->task_hour = $request->input("task_hour");

		$task->save();

		return redirect()->route('tasks.index')->with('message', trans('created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = Task::findOrFail($id);

		return view('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = Task::findOrFail($id);

        $entries = DB::table('entries')->orderBy('id','desc')->get();
        $entries=$this->selectedBox($entries, $task->entries_id);

		return view('tasks.edit', compact('task'),compact('entries'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $validator = Validator::make($request->all(), [
            'entries_id' => 'required|numeric|exists:entries,id',
            'log' => 'required|max:255',
            'task_day' => 'required',
            'task_hour' => 'required',
        ]);
        if ($validator->fails()){
            $this->throwValidationException($request, $validator);
        }
#        \Log::debug($request);
		$task = Task::findOrFail($id);

		$task->entries_id = $request->input("entries_id");
        $task->log = $request->input("log");
        $task->task_day = $request->input("task_day");
        $task->task_hour = $request->input("task_hour");
#        \Debugbar::info($task->job_date);

		$task->save();

		return redirect()->route('tasks.index')->with('message', trans('updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = Task::findOrFail($id);
		$task->delete();

		return redirect()->route('tasks.index')->with('message', trans('deleted'));
	}

	/**
	 * totaling
	 *
	 * @return Response
	 */
	public function total()
	{
        $sql ='select E.id, E.title, E.hour, sum(V.task_hour) as man_hour,count(E.id) as days,E.hour-sum(V.task_hour) as remain,E.pre, E.end,E.status from entries as E, tasks as V where E.id = V.entries_id group by V.entries_id order by E.id,E.pre';
        $sql2 ='E.id, E.title, E.hour, sum(V.task_hour) as man_hour,E.hour-sum(V.task_hour) as remain,E.pre, E.end,E.status from entries as E, tasks as V where E.id = V.entries_id group by V.entries_id order by E.id,E.pre';
        $totals = DB::select($sql);
        $day_total=0;
        $job_hour=0;
        $man_hour=0;
        $remain_hour=0;
        foreach ($totals as $total){
            $day_total+=$total->days;
            $job_hour+=$total->hour;
            $man_hour+=$total->man_hour;
            $remain_hour+=$total->remain;
        }
#        var_dump($totals);
#        どうやって足す？
        $obj = new \stdClass;
        $obj->id = '';
        $obj->title = '--- total ---';
        $obj->days = $day_total;
        $obj->hour = $job_hour;
        $obj->man_hour = $man_hour;
        $obj->remain = $remain_hour;
        $obj->pre = '';
        $obj->end = '';
        $obj->status = '';
        $totals[]=$obj;
        
		return view('tasks.total', compact('totals'));

	}
}
