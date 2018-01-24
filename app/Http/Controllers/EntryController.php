<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller {
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
		$entries = Entry::orderBy('id', 'desc')->paginate(10);

		return view('entries.index', compact('entries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('entries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$entry = new Entry();

		$entry->title = $request->input("title");
        $entry->hour = $request->input("hour");
        $entry->pre = $request->input("pre");
        $entry->estimated = $request->input("estimated");
        $entry->accepted = $request->input("accepted");
        $entry->start = $request->input("start");
        $entry->end = $request->input("end");
        $entry->mainte = $request->input("mainte");
        $entry->status = $request->input("status");

		$entry->save();

		return redirect()->route('entries.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$entry = Entry::findOrFail($id);

		return view('entries.show', compact('entry'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$entry = Entry::findOrFail($id);

		return view('entries.edit', compact('entry'));
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
		$entry = Entry::findOrFail($id);

		$entry->title = $request->input("title");
        $entry->hour = $request->input("hour");
        $entry->pre = $request->input("pre");
        $entry->estimated = $request->input("estimated");
        $entry->accepted = $request->input("accepted");
        $entry->start = $request->input("start");
        $entry->end = $request->input("end");
        $entry->mainte = $request->input("mainte");
        $entry->status = $request->input("status");

		$entry->save();

		return redirect()->route('entries.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$entry = Entry::findOrFail($id);
		$entry->delete();

		return redirect()->route('entries.index')->with('message', 'Item deleted successfully.');
	}

}
