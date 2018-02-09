<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Day;
use Illuminate\Http\Request;

class DayController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$days = Day::orderBy('id', 'desc')->paginate(10);

		return view('days.index', compact('days'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('days.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$day = new Day();
		$day->dd=$request->input("dd");

		$day->save();

		return redirect()->route('days.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$day = Day::findOrFail($id);

		return view('days.show', compact('day'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$day = Day::findOrFail($id);

		return view('days.edit', compact('day'));
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
		$day = Day::findOrFail($id);
		$day->dd=$request->input("dd");
#        \Log::debug($day->dd);

		$day->save();

		return redirect()->route('days.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$day = Day::findOrFail($id);
		$day->delete();

		return redirect()->route('days.index')->with('message', 'Item deleted successfully.');
	}

}
