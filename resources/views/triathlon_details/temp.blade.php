@if (count($triDetails) > 1)

        @foreach ($triDetails as $triDetail)

                <div class="card">
                <h3>usr_id: {{$triDetail->usr_id}}</h3>
                <h3>tri_id: {{$triDetail->tri_id}}</h3>
                <h3>div_id: {{$triDetail->div_id}}</h3>
                <h3>act_id: {{$triDetail->act_id}}</h3>
                <h3>minutes: {{$triDetail->minutes}}</h3>

                </div>

        @endforeach
    
@endif


@foreach ($triDetails as $triDetail)

<div class="card">
<p>usr_id: {{$triDetail->usr_id}}</p>
<p>tri_id: {{$triDetail->tri_id}}</p>
<p>div_id: {{$triDetail->div_id}}</p>
<p>act_id: {{$triDetail->act_id}}</p>
<p>minutes: {{$triDetail->minutes}}</p>
<p>id: {{$triDetail->id}}</p>
<p>first_name: {{$triDetail->first_name}}</p>
<p>last_name: {{$triDetail->last_name}}</p>
<p>dob: {{$triDetail->dob}}</p>
<p>sex: {{$triDetail->sex}}</p>
<p>email: {{$triDetail->email}}</p>
<p>email_verified_at: {{$triDetail->email_verified_at}}</p>
<p>password: {{$triDetail->password}}</p>
<p>remember_token: {{$triDetail->remember_token}}</p>
<p>division_name: {{$triDetail->division_name}}</p>
<p>activity_type: {{$triDetail->activity_type}}</p>
<p>miles: {{$triDetail->miles}}</p>
<p>kms: {{$triDetail->kms}}</p>
<p>triathlon_name: {{$triDetail->triathlon_name}}</p>
<p>event_date_on: {{$triDetail->event_date_on}}</p>
<p>city_name: {{$triDetail->city_name}}</p>
<p>state_name: {{$triDetail->state_name}}</p>
<p>zip_code: {{$triDetail->zip_code}}</p>

</div>

@endforeach


$triDetails = DB::table('tri_details')
->join('users',        'users.id', '=', 'tri_details.usr_id'  )
->join('divisions',    'divisions.id', '=', 'tri_details.div_id' )
->join('activities',   'activities.id', '=', 'tri_details.act_id' )
->join->on('div_details',  'div_details.act_id', '=', 'tri_details.act_id', 'and', 'div_details.div_id', '=', 'tri_details.div_id' )
->join('triathlons',   'triathlons.id', '=', 'tri_details.tri_id' )
->groupBy('triathlons.id', 'divisions.id', 'users.id')
->get();
return view('triathlon_details.index')->with('triDetails', $triDetails);

'first_name', 'last_name', 'triathlon_name', 'division_name'

<td>{{$triDetail->first_name}}</td>
<td>{{$triDetail->last_name}}</td>
<td>{{$triDetail->triathlon_name}}</td>
<td>{{$triDetail->division_name}}</td>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Triathlon</th>
        <th>Division</th>
        <th>Total Minutes</th>
        <th>Total Miles</th>
        <th>Total Kilometers</th>
    </tr>
    @foreach ($triDetails as $triDetail)
    <tr>
        <td>{{$triDetail->tri_id}}</td>
        <td>{{$triDetail->div_id}}</td>
        <td>{{$triDetail->minutes}}</td>
        


    </tr>
    @endforeach
</table>





<h1>Triathlon Details for {{Auth::user()->first_name}}</h1>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Triathlon</th>
        <th>Division</th>
        <th>Total Minutes</th>
        <th>Total Miles</th>
        <th>Total Kilometers</th>
    </tr>
    @foreach ($triDetails as $triDetail)
    <tr>
        <td>div_id: {{$triDetail->tri_id}}</td>
        <td>tri_id: {{$triDetail->div_id}}</td>
        <td>usr_id: {{$triDetail->usr_id}}</td>
        <td>act_id: </td>
        <td>{{$triDetail->minutes}}</td>
        <td>{{$triDetail->miles}}</td>
        <td>{{$triDetail->kms}}</td>



    </tr>
    @endforeach
</table>
<p>user count=: {{$temp}}</p>




$usrTriDiv = DB::table('tri_details')
            ->select( 'tri_details.usr_id', 'tri_details.tri_id', 'tri_details.div_id',
            'tri_details.act_id', 'first_name', 'last_name', 'triathlon_name', 'division_name',
            'activity_type')
            ->join('divisions' , 'divisions.id' , '=', 'tri_details.div_id' )
            ->join('triathlons', 'triathlons.id', '=', 'tri_details.tri_id')
            ->join('activities', 'activities.id', '=', 'tri_details.act_id')
            ->join('users'     , 'users.id'     , '=', 'tri_details.usr_id' )
->where(Auth()->user()->id = 'tri_details.usr_id')
->get();

{!! Form::open(['action' => 'TriathlonDetailsController@update', 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('triathlon_name', 'Triathlon Name') }}
    {{Form::select('tri_id', $event->triathlon_name, ['class' => 'form-control', 'placeholder' => 'Triathlon Name'])}}
</div>
<div class="form-group">
    {{Form::label('division_name', 'Division Name') }}
    {{Form::select('div_id', $event->division_name, ['class' => 'form-control', 'placeholder' => 'Division Name'])}}
</div>
<div class="form-group">
    {{Form::label('activity_type', 'Activity Type') }}
    {{Form::select('act_id', $event->activity_type, ['class' => 'form-control', 'placeholder' => 'Activity Type'])}}
</div>
<div class="form-group">
    {{Form::label('minutes', 'Minutes') }}
    {{Form::text('minutes', '', ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
</div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}


    [ $request->input('minutes') , Auth()->user()->id , 
    $request->input('tri_id') , $request->input('div_id'),
    $request->input('act_id') ]);
    
    












    // working
    //$triDetails = tri_details::all(); // returns all the records from the database. folder providers\Post.php
    //return view('triathlon_details.index')->with('triDetails', $triDetails);

    /*// new partial working
    $triDetails = DB::table('tri_details')
    ->join('users',        'users.id', '=', 'tri_details.usr_id'  )
    ->join('divisions',    'divisions.id', '=', 'tri_details.div_id' )
    ->join('activities',   'activities.id', '=', 'tri_details.act_id' )
    ->join('div_details',  'div_details.act_id', '=', 'tri_details.act_id' )
    
    ->join('triathlons',   'triathlons.id', '=', 'tri_details.tri_id' )
    ->get();
    return view('triathlon_details.index')->with('triDetails', $triDetails);
    
//*/
/*
$triDetails = DB::table('tri_details' )
->join('users',        'users.id', '=', 'tri_details.usr_id'  )
->join('divisions',    'divisions.id', '=', 'tri_details.div_id' )
->join('activities',   'activities.id', '=', 'tri_details.act_id' )
->join('div_details',  function($join){ 
$join->on('div_details.act_id', '=', 'tri_details.act_id' )
     ->on('div_details.div_id', '=', 'tri_details.div_id');
})
->join('triathlons',   'triathlons.id', '=', 'tri_details.tri_id' )

->where('tri_details.usr_id', '1')

->get();
return view('triathlon_details.index')->with('triDetails', $triDetails);
//*/

/*
$triDetails = DB::table('tri_details' )->select('tri_details.div_id', 'tri_details.tri_id',
'first_name', 'last_name', 'triathlon_name', 'division_name', )
->join('users',        'users.id', '=', 'tri_details.usr_id'  )
->join('divisions',    'divisions.id', '=', 'tri_details.div_id' )
->join('activities',   'activities.id', '=', 'tri_details.act_id' )
->join('div_details',  function($join){ 
$join->on('div_details.act_id', '=', 'tri_details.act_id' )
     ->on('div_details.div_id', '=', 'tri_details.div_id');
})
->join('triathlons',   'triathlons.id', '=', 'tri_details.tri_id' )
->where('tri_details.usr_id', '1')
->get();

//return view('triathlon_details.index')->with('triDetails', $triDetails);
//return view('triathlon_details.index', ['triDetails' => $triDetails]);
//*/      

/* // working
$triDetails = DB::table('tri_details' )->select( 'tri_details.div_id', 'tri_details.tri_id',
'tri_details.usr_id',
DB::RAW('SUM(minutes) AS minutes'), 
DB::raw('SUM(miles) AS miles'),
DB::raw('SUM(kms) as kms') )
->join('users',        'users.id', '=', 'tri_details.usr_id'  )
->join('divisions',    'divisions.id', '=', 'tri_details.div_id' )
->join('activities',   'activities.id', '=', 'tri_details.act_id' )
->join('div_details',  function($join){ 
$join->on('div_details.act_id', '=', 'tri_details.act_id' )
     ->on('div_details.div_id', '=', 'tri_details.div_id');
})
->join('triathlons',   'triathlons.id', '=', 'tri_details.tri_id' )

->where('tri_details.usr_id', '1')
->groupBy('tri_id', 'div_id', 'usr_id')
->get();
//->toSql();
//dd($triDetails);

$temp = DB::table('tri_details')
->select(DB::raw('count(usr_id) as usr_id'), 'tri_id', 'div_id')
->where('usr_id', '1')
->groupBy('usr_id', 'tri_id', 'div_id')
->get();

return view('triathlon_details.index', ['triDetails' => $triDetails, 'temp' => $temp]);
//*/
/*
$temp = 
DB::table('tri_details')->select( 'tri_details.div_id', 'tri_details.tri_id',
'tri_details.usr_id',
DB::RAW('SUM(minutes) AS minutes'), 
DB::raw('SUM(miles) AS miles'),
DB::raw('SUM(kms) as kms') )
->where('tri_details.usr_id', '1')
->groupBy('tri_id', 'div_id', 'usr_id')->get()
;

$temp2 = DB::table('div_details')
    ->joinSub($temp, 'temp', function ($join){
        $join->on('div_details.div_id', '=', 'temp.div_id')
             ->on('div_details.act_id', '=', 'temp.act_id');
})
->get();

//->toSql();
//dd($temp2);
return view('triathlon_details.index', [ 'temp' => $temp]);
//*/

/*
$triDetails =     DB::table('tri_details')
        ->select( 'usr_id', 'first_name', 'last_name', 'triathlon_name', 'division_name', 'minutes', 'miles' )
        ->join('divisions', 'divisions.id', '=', 'tri_details.div_id' )
        ->join('triathlons', 'triathlons.id', '=', 'tri_details.tri_id')
        ->join('users', 'users.id', '=', 'tri_details.usr_id')
        ->join('div_details',  function($join){ 
            $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                ->on('div_details.div_id', '=', 'tri_details.div_id')
                ->where('usr_id', '1');
})
->get();
//*/


//$activities = activity::pluck('activity_type', 'id');
//$triathlons = tri_details::where('usr_id', '=', Auth()->user()->id )->pluck('triathlon_name','id');
//$triathlons = triathlon::pluck('triathlon_name', 'id');
/*
$triDetails2 = DB::table('tri_details')
->select( 'tri_details.usr_id', 'triathlons.id as newid', 'tri_details.tri_id', 'triathlon_name')
->join('triathlons', 'id', '=', 'tri_details.tri_id')
->where( 'tri_details.usr_id', '=', Auth()->user()->id ) 
->groupBy('tri_details.tri_id', 'tri_details.usr_id', 'newid', 'triathlon_name');
//->get();
//->toSql();
//dd($triDetails2);
//$triArray = [1,2,3];  
//*/


//*/
/* outer query to be used with the above subquery
 * The subquery generates the aggregate totals and the
 * outer query adds the column names from the other tables
 * Because all columns in a select statement MUST be in the groupby statement */



//->whereNull( 'triDetails2.tri_id')

//->toSql();
//->get();
//->distinct('tri_.id');
//->list('triathlons_name', 'tri_id');//*/
//->distinct('tri_id')->get();
//*/

/*
$triDetails = DB::table('tri_details')
->select( 'tri_details.usr_id', 'tri_details.tri_id')
->rightJoin('users', 'id', '=', 'tri_details.usr_id')
->leftJoin('triathlons', 'id', '=', 'tri_details.tri_id')
->where('tri_details.usr_id', '=', Auth()->user()->id )
->get();
//*/

/*
->rightJoin('triathlons', '=', 'tri_details.tri_id')
->where([
[ 'tri_details.usr_id', '=', Auth()->user()->id ],
[ 'triathlons', 'id', '<>', 'tri_details.tri_id' ], 
])
->get();
//*/
/*    
  $triDetails = DB::table('triathlons')
 ->join('triDetails2', 'tri_id', '=', 'triathlons.id')
// ->where('triDetails2', 'tri_id', '<>', 'triathlons.id' )
->get();
//*/

/*// working
$triathlons = triathlon::pluck('triathlon_name', 'id');
$divisions = division::pluck('division_name', 'id');
$triDetails2 = DB::table('tri_details')
->select( 'usr_id', 'tri_details.tri_id', 'triathlon_name')
->join('triathlons', 'id', '=', 'tri_details.tri_id')
->where( 'tri_details.usr_id', '=', Auth()->user()->id );

$triDetails = DB::table('triathlons')
->joinSub($triDetails2, 'triDetails2', function($join) {
$join->on('triathlons.id', '=', 'triDetails2.tri_id');
})
->get();
//*/




/* // working version
// check to see if the record already 
$doesExist = tri_details::select('*')
->where( [
    ['usr_id', auth()->user()->id ],
    ['tri_id', $request->input('tri_id') ],
    ['div_id', $request->input('div_id') ],
    ['act_id', $request->input('act_id') ],
    ])
->doesntExist();
    if($doesExist){
        $details = new tri_details();
        $details->usr_id = auth()->user()->id;
        $details->tri_id = $request->input('tri_id');
        $details->div_id = $request->input('div_id');
        $details->act_id = $request->input('act_id');
        $details->minutes = $request->input('minutes');      
        $details->save();

        return redirect('/triathlon-details')->with('success', 'Event successfully added.');
    }else{
        echo 'else tracer';
        return redirect('/triathlon-details/create')->with('error', 'Record already exists. Use update page to change it.');
    }
    //*/

/* could not figure a way to work with this
$details = tri_details::firstOrCreate( [
'usr_id' => auth()->user()->id ,
'tri_id' => $request->input('tri_id'),
'div_id' => $request->input('div_id'),
'act_id' => $request->input('act_id'), ],
['minutes' => $request->input('minutes')]
);

if(!$details){
    //echo 'if tracer';
    $details->minutes = $request->input('minutes');
    $details->save();
    return redirect('/triathlon-details')->with('success', 'Event successfully added.');
    
} else {
    //dd($details);
    //echo 'else tracer';
    return redirect('/triathlon-details/create')->with('error', 'Record already exists.');

}
//*/

//return(var_dump($_POST) );







//*/
/* //working
$triDetails =     DB::table('tri_details')
            ->select( 'tri_details.usr_id', 'tri_details.tri_id', 'tri_details.div_id', 'tri_details.act_id',
            'first_name', 'last_name', 'triathlon_name', 'division_name', 
            DB::raw('SUM(minutes) as minutes'),
            DB::raw('SUM(miles) as miles'), 
            DB::raw('SUM(kms) as kms') )
            ->join('divisions', 'divisions.id', '=', 'tri_details.div_id' )
            ->join('triathlons', 'triathlons.id', '=', 'tri_details.tri_id')
            ->join('users', 'users.id', '=', 'tri_details.usr_id')
            ->join('div_details',  function($join){ 
                $join->on('div_details.act_id', '=', 'tri_details.act_id' )
                    ->on('div_details.div_id', '=', 'tri_details.div_id')
                    ->where('usr_id', '1');
                
})
->groupBy('tri_details.div_id', 'tri_details.tri_id', 'tri_details.usr_id', 'tri_details.act_id',
'first_name', 'last_name', 'triathlon_name', 'division_name')
->get();
//*/
/*
$triDetails = DB::table('users')
->joinSub($test, 'test', function($join) {
    $join->on('users.id', '=', 'test.usr_id')
    ->groupBy('test.tri_id');
})//*/
    //->groupBy('tri_details.tri_id', 'tri_details.div_id', 'tri_details.usr_id', 'minutes', 'miles')

    //->toSql();
    //dd($triDetails);









    * populate the drop down boxes of the edit form */
    $triathlons = triathlon::where('id',$tri_id)->pluck('triathlon_name','id');
    $divisions  = division::where( 'id',$div_id)->pluck('division_name', 'id');
    $activities = activity::pluck('activity_type', 'id');



    echo "hello edit";
    /*
    // passing of users id through get probably not the best idea
    // using triathlon::lists() deprecated since laravel 5.3
    $triathlons = DB::table('tri_details')->select('triathlon_name', 'id')
    ->join('triathlon', 'id', '=', 'tri_details.tri_id')
    ->join('users',     'id', '=', 'tri_details.usr_id')
    ->where('users.id',       '=', auth()->user()->id);
    $divisions = division::pluck('division_name', 'id');
    $activities = activity::pluck('activity_type', 'id');

    return view('triathlon_details.edit', [
        'triathlons' => $triathlons,
        'divisions' => $divisions,
        'activities' => $activities
        ]);
        //*/
        /*
    $division = DB::table('tri_details')
    ->select('tri_details.div_id', 'division_name')
    ->join('divisions' , 'divisions.id' , '=', 'tri_details.div_id' )
    ->join('triathlons', 'triathlons.id', '=', 'tri_details.tri_id')
    ->join('activities', 'activities.id', '=', 'tri_details.act_id')
    ->where( [
        [ 'tri_details.usr_id', '=', Auth()->user()->id ],
        [ 'tri_details.tri_id', '=', $id ],
    ])
    ->get();//*/

    $triathlons = triathlon::where('id',$id)->pluck('triathlon_name','id');
    // using triathlon::lists() deprecated since laravel 5.3
    $divisions = division::pluck('division_name', 'id');
    $activities = activity::pluck('activity_type', 'id');

    return view('triathlon_details.create', [
        'triathlons' => $triathlons,
        'divisions' => $divisions,
        'activities' => $activities
        ]);

    return view('triathlon_details.edit', ['division' => $divisions,
                'triathlon' => $triathlons ]);


                /* // working version
                $doesExist = tri_details::select('*')
                ->where( [
                    ['usr_id', auth()->user()->id ],
                    ['tri_id', $request->input('tri_id') ],
                    ['div_id', $request->input('div_id') ],
                    ['act_id', $request->input('act_id') ],
                    [ 'minutes', $request->input('minutes') ],
                    ])
                ->doesntExist();
                    if($doesExist){
                        $details = new tri_details();
                        $details->usr_id = auth()->user()->id;
                        $details->tri_id = $request->input('tri_id');
                        $details->div_id = $request->input('div_id');
                        $details->act_id = $request->input('act_id');
                        $details->minutes = $request->input('minutes');      
                        $details->save();
                    }
                    //*/
        /*
                        $m = $request->input('minutes'); 
                        $u = Auth()->user()->id; 
                        $t = $request->input('tri_id'); 
                        $d = $request->input('div_id');
                        $a = $request->input('act_id');
        
        
                $affected = DB::update('UPDATE tri_details SET minutes = ?
                 WHERE usr_id = ? , tri_id = ? , div_id = ? , act_id = ?' ,
                [ $m , $u , $t , $d , $a ]);
        //*//*
                    $model = tri_details::where([
                    [ 'usr_id', '=',        auth()->user()->id ],
                    [ 'tri_id', '=', $request->input('tri_id') ],
                    [ 'div_id', '=', $request->input('div_id') ],
                    [ 'act_id', '=', $request->input('act_id') ],
                    ])->firstOrFail();
        //*/
                      
                   // }else{
                     //   echo 'else tracer';
                       // return redirect('/triathlon-details/editevent/$tri_id/$div_id')->with('error', 'Unable to apply requested changes.');
                   // }




