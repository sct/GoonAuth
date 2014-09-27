<?php

class NoteController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$auth = Session::get('auth');

		$note = new Note();

		$note->admin_id = $auth->id;
		$note->auth_id = Input::get('auth_id');
		$note->note = Input::get('note');
		$note->save();

		return Redirect::back();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$note = Note::find($id);

		$note->delete();

		return Redirect::back();
	}


}
