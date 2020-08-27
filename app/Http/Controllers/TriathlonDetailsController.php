<?php

namespace App\Http\Controllers;
use App\triathlon;
use App\division;
use App\activity;
use App\tri_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class TriathlonDetailsController extends Controller
{   
    // authenticate user roles
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
        $this->middleware('role:user|superadministrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /** Compute the results of all the triathlons for all users. 
        * Return the results to triathlon-details page and display
        * Two step process. 1st, get the aggregate totals, 2nd append the
        * name columns to the results of step 1.
        */
        // step 1 of 2
        $triDetails2 = DB::table('tri_details')
            ->select( 'usr_id', 'tri_details.tri_id', 'tri_details.div_id', 
                DB::raw('SUM(minutes) as minutes'),
                DB::raw('SUM(miles) as miles'), 
                DB::raw('SUM(kms) as kms') )
            ->join('div_details',  function($join){ 
                $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                    ->on('div_details.div_id', '=', 'tri_details.div_id');
            })
            ->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.usr_id');

            // step 2 of 2
        $triDetails = DB::table('users')
            ->joinSub($triDetails2, 'triDetails2', function($join) {
                $join->on('users.id', '=', 'triDetails2.usr_id');
            })
            ->join('triathlons', 'triathlons.id', '=', 'triDetails2.tri_id')
            ->join('divisions', 'divisions.id', '=', 'triDetails2.div_id' )
            ->orderBy('tri_id')
            ->orderBy('div_id')
            ->orderBy('minutes')
            ->get();

    return view('triathlon_details.index', [ 'triDetails' => $triDetails]);
    }

     /*   $shares = DB::table('shares')
        ->join('members', 'members.id', '=', 'shares.member_id')
        ->join('follows', 'follows.member_id', '=', 'members.id')
        ->where('follows.follower_id', '=', 9)
        ->get();
    }//*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        // using triathlon::lists() deprecated since laravel 5.3
       
        // drop-down box for the divisions selection in create/add triathlon page
        $divisions = division::pluck('division_name', 'id');

        /** triathlons drop down box for the create/add triathlon page 
         * Display only triathlon events where the user has not entered in data.
         * Two step process. 1st, get an array of tri_ids that the user HAS entered in data.
         * 2nd, use this array in the whereNotIn clause against the triathlons table.
         * Since we are limiting the user to choose from triathlons where they have no data then,
         * this should also serve as protection against adding a new event when one already exists.
         */
        // triathlon drop down box part 1 of 2
        $triathlonsEntered = DB::table('tri_details')
        ->select( 'tri_details.usr_id', 'triathlons.id as newid', 'tri_details.tri_id', 'triathlon_name')
        ->join('triathlons', 'id', '=', 'tri_details.tri_id')
        ->where( 'tri_details.usr_id', '=', Auth()->user()->id ) 
        ->groupBy('tri_details.tri_id', 'tri_details.usr_id', 'newid', 'triathlon_name')
        ->pluck('newid');
        // triathlon drop down box part 2 of 2
        $triathlonsNotEntered = DB::table('triathlons')
        ->select('id', 'triathlon_name')
        ->whereNotIn( 'triathlons.id', $triathlonsEntered )
        ->pluck('triathlon_name', 'id');

        return view('triathlon_details.create', [
            'triathlonsNotEntered' => $triathlonsNotEntered,
            'divisions' => $divisions, ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Notes
         * The values being used for the act_id are static.
         * There isn't a check to see if the record already exists because
         * the add form should only display events for which the user has
         * not entered in any data.
         */

        // verify the minutes fields from the form
        $this->validate($request,[
            'swim_id' => 'required|numeric|min:0|not_in:0|max:180',
            'bike_id' => 'required|numeric|min:0|not_in:0|max:180',
            'run_id'  => 'required|numeric|min:0|not_in:0|max:180',
        ]);
        $swim = $request->input('swim_id');
        $bike = $request->input('bike_id');
        $run =  $request->input('run_id');
        $tri =  $request->input('tri_id');
        $div =  $request->input('div_id');


        // add swim activiy
        $details1 = new tri_details();
        $details1->usr_id = auth()->user()->id;
        $details1->tri_id = $tri;
        $details1->div_id = $div;
        $details1->act_id = 1; // where 1 is the id of swim
        $details1->minutes = $swim;      
        $details1->save();

        // add bike activity
        $details2 = new tri_details();
        $details2->usr_id = auth()->user()->id;
        $details2->tri_id = $tri;
        $details2->div_id = $div;
        $details2->act_id = 3; // where 3 is the id of bike
        $details2->minutes = $bike;      
        $details2->save();

        // add run activity
        $details3 = new tri_details();
        $details3->usr_id = auth()->user()->id;
        $details3->tri_id = $tri;
        $details3->div_id = $div;
        $details3->act_id = 5; // where 5 is the id of run
        $details3->minutes = $run;      
        $details3->save();

        return redirect('/triathlon-details/show')->with('success', 'Event successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
          /** aggregate the minutes, miles, kms of each triathlon for which the user has data. 
        * Return the results to show.blade.php
        * Two step process. 1st, get the aggregate totals, 2nd append the
        * name columns to the results of step 1.
        */
        // step 1 of 2
        $triDetails2 = DB::table('tri_details')
            ->select( 'usr_id', 'tri_details.tri_id', 'tri_details.div_id', 
                DB::raw('SUM(minutes) as minutes'),
                DB::raw('SUM(miles) as miles'), 
                DB::raw('SUM(kms) as kms') )
            ->join('div_details',  function($join){ 
                $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                    ->on('div_details.div_id', '=', 'tri_details.div_id')
                    ->where('usr_id', Auth()->user()->id );
            })
            ->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.usr_id');
        // step 2 of 2
        $triDetails = DB::table('users')
            ->joinSub($triDetails2, 'triDetails2', function($join) {
                $join->on('users.id', '=', 'triDetails2.usr_id');
            })
            ->join('triathlons', 'triathlons.id', '=', 'triDetails2.tri_id')
            ->join('divisions', 'divisions.id', '=', 'triDetails2.div_id' )
            ->get();
            //->toSql();
            //dd($triDetails);

        return view('triathlon_details.show', [ 'triDetails' => $triDetails]);
    }

/**
     * This functions computes the queries that will display a summary of the
     * minutes, miles, and kms for swim,bike, and run of a single triathlon AND
     * display the individual minutes, miles, and kms for that event. This breakout
     * of minutes, miles and kms aides the user when editing the event. 
     * Note: wherein(act_id [1,3,5]) referes to the ids for swim, bike, run. 
     *       numbers 2,4 refer to the transitions between the events but, a 
     *       decision was made to leave them out for now. 
     * @param  int  $tri_id
     * @param  int  $div_id
     * @return \Illuminate\Http\Response
     */
    public function showevent($tri_id, $div_id)
    {
        /** Notes
         *  Create two different query sets. Both sets require two steps.
         *  1st step gets the aggregate totals. 2nd step appends the column names.   
         */ // triathlon::lists() deprecated since laravel 5.3

        // step 1 of 2 Summary of all activities for a triathlon event
        $triSum2 = DB::table('tri_details')
        ->select( 'usr_id', 'tri_details.tri_id', 'tri_details.div_id',
            DB::raw('SUM(minutes) as minutes'),
            DB::raw('SUM(miles) as miles'), 
            DB::raw('SUM(kms) as kms') )
        ->join('div_details',  function($join){ 
            $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                ->on('div_details.div_id', '=', 'tri_details.div_id')
                ->where('usr_id', Auth()->user()->id );
        })
        ->where([
            [ 'tri_details.tri_id', '=', $tri_id ],
            [ 'tri_details.div_id', '=', $div_id ],
        ])
        ->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.usr_id');

        // step 2 of 2 Summary of all activities for a triathlon event
        $triSum = DB::table('users')
        ->joinSub($triSum2, 'triDetails', function($join) {
            $join->on('users.id', '=', 'triDetails.usr_id');
        })
        ->join('triathlons', 'triathlons.id', '=', 'triDetails.tri_id')
        ->join('divisions', 'divisions.id', '=', 'triDetails.div_id' )
        ->get();
 
        // step 1 of 2 breakout the minutes, miles, and kms of each activity for a triathlon event
        $triDetails2 = DB::table('tri_details')
        ->select( 'usr_id', 'tri_details.tri_id', 'tri_details.div_id', 'tri_details.act_id',
            DB::raw('SUM(minutes) as minutes'),
            DB::raw('SUM(miles) as miles'), 
            DB::raw('SUM(kms) as kms') )
        ->join('div_details',  function($join){ 
            $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                ->on('div_details.div_id', '=', 'tri_details.div_id')
                ->wherein('tri_details.act_id', [1,3,5] );

            })
        ->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.act_id', 'tri_details.usr_id')
        ->where([
            [ 'tri_details.tri_id', '=', $tri_id ],
            [ 'tri_details.div_id', '=', $div_id ],
        ]);
        
        // step 2 of 2 breakout the minutes, miles, kms of each activity for a triathlon event
        $triDetails = DB::table('users')
        ->joinSub($triDetails2, 'triDetails2', function($join) {
            $join->on('users.id', '=', 'triDetails2.usr_id');
            })
        ->join('triathlons', 'triathlons.id', '=', 'triDetails2.tri_id')
        ->join('divisions' , 'divisions.id' , '=', 'triDetails2.div_id' )
        ->join('activities', 'activities.id', '=', 'triDetails2.act_id')
        ->where( 'users.id', '=', Auth()->user()->id )
        ->get();

        return view('triathlon_details.showevent', [
            'triDetails' => $triDetails,
            'triSum'     => $triSum ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        // created function editevent that uses 2 parameters
    }

 /**
     * Show the form for editing a new resource.
     * 
     * @param  int  $tri_id
     * @param  int  $div_id
     * @return \Illuminate\Http\Response
     */

    public function editevent($tri_id, $div_id)
    {
        /* use tri_id and div_id to generate an edit form specific
         * to the triathlon event the user choose from the hyperlink in show.blade.php */

        /* subquery/ innerquery for outer query below. 
         * remove tri_details.act_id from the select and groupby statements to
         * generate a query that will return the SUM of ALL activities */
        $triDetails2 = DB::table('tri_details')
        ->select( 'usr_id', 'tri_details.tri_id', 'tri_details.div_id', 'tri_details.act_id',
            DB::raw('SUM(minutes) as minutes'),
            DB::raw('SUM(miles) as miles'), 
            DB::raw('SUM(kms) as kms') )
        ->join('div_details',  function($join){ 
            $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                ->on('div_details.div_id', '=', 'tri_details.div_id')
                ->wherein('tri_details.act_id', [1,3,5] );
            })
        ->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.act_id', 'tri_details.usr_id')
        ->where([
            [ 'tri_details.tri_id', '=', $tri_id ],
            [ 'tri_details.div_id', '=', $div_id ],
        ]);
        /* outer query to be used with the above subquery
         * The subquery generates the aggregate totals and the
         * outer query adds the column names from the other tables
         * Because all columns in a select statement MUST be in the groupby statement */
        $triDetails = DB::table('users')
        ->joinSub($triDetails2, 'triDetails2', function($join) {
            $join->on('users.id', '=', 'triDetails2.usr_id');
            })
        ->join('triathlons', 'triathlons.id', '=', 'triDetails2.tri_id')
        ->join('divisions' , 'divisions.id' , '=', 'triDetails2.div_id' )
        ->join('activities' , 'activities.id' , '=', 'triDetails2.act_id' )
        ->where( 'users.id', '=', Auth()->user()->id )
        ->get();

        // populate the drop down boxes of the edit form */
        $triathlons = triathlon::where('id',$tri_id)->pluck('triathlon_name','id');
        $divisions  = division::where( 'id',$div_id)->pluck('division_name', 'id');
        $activities = activity::where('id', 1)->orwhere('id', 3)->orwhere('id', 5)->pluck('activity_name', 'id');

        return view('triathlon_details.editevent', [
            'divisions' => $divisions,
            'triathlons' => $triathlons,
            'activities' => $activities,
            'triDetails' => $triDetails ]);
    }/** end public function editevent() */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate that user entered data before attempting insert
        $this->validate($request,[
            'minutes' => 'required|numeric|min:0|not_in:0|max:180'
        ]);

        tri_details::where([
            [ 'usr_id',         auth()->user()->id ],
            [ 'tri_id',  $request->input('tri_id') ],
            [ 'div_id',  $request->input('div_id') ],
            [ 'act_id',  $request->input('act_id') ],
           // [ 'minutes', $request->input('minutes') ],
            ])
            ->update(['minutes' => $request->input('minutes')]);

        return redirect()->back()->with('success', 'successfully updated.');
   //*/
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tri_id
     * @param  int  $div_id
     * @return \Illuminate\Http\Response
     */
    public function destroy2($tri_id, $div_id)
    {
        // user requested to delete a specific triathlon 
        DB::table('tri_details')->where([ 
            [ 'usr_id', '=', Auth()->user()->id ],
            [ 'tri_id', '=', $tri_id ],
            [ 'div_id', '=', $div_id ],
        ])->delete();
        
        // return to index page
        return redirect('/triathlon-details/show')->with( 'success', 'Event removed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // created function destroy2 that uses two parameters
    }


}
