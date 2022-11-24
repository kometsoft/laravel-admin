<?php

namespace Tabler\App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tabler\App\DataTables\ActivitiesDataTable;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivitiesDataTable $dataTable)
    {
        return $dataTable->render('tabler::admin.activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        dd($r->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('tabler::admin.activity.show', [
            'activity' => $activity,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @param  \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Activity $activity)
    {
        dd($r->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
