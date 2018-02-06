<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Task;
use App\Entry;
use Validator;

use Illuminate\Http\Request;

class TaskController extends Controller {

    // constructor
    public function __construct()
    {
        $this->middleware('auth');
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
        $n=0;
        foreach ($entries as $entry){
            $entry->selected = '';
            if ($n==0) $entry->selected = 'selected';
            $n++;
        }
#        var_dump($entries);
		return view('tasks.create', compact('entries'));
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

		return redirect()->route('tasks.index')->with('message', 'Item created successfully.');
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
        $n=0;
        foreach ($entries as $entry){
            $entry->selected = '';
            if ($task->entries_id==$entry->id) $entry->selected = 'selected';
            $n++;
        }

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

		return redirect()->route('tasks.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('tasks.index')->with('message', 'Item deleted successfully.');
	}

}
