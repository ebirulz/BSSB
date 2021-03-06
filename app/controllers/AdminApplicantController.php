<?php

class AdminApplicantController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
        $biodatas = BioData::all()->toArray();
        $scholarships = Scholarship::all()->toArray();
        $data = array();
        $result=new stdClass;
        //return Response::json($biodata,200);


        foreach($biodatas as $biodata){
            foreach($scholarships as $scholarship)
            {
                $biodata["reg_number"]=$scholarship['reg_number'];
            }
            $data[]=$biodata;
        }
        return Response::json($data,200);
	}

	public function create()
	{
        $id = Input::all()['user_id'];
        $application = SubmittedApplication::find($id);
        if(is_null($application))
        {
            $applicants =new SubmittedApplication();
            $applicants->user_id = Input::all()['user_id'];
            $user_id = $applicants->save();
            return Response::json(
                array(
                    "user_id"=>$user_id
                ),200
            );
        }
        else{
            return Response::json(
                array(
                    "error"=>"Application for ID ".$id." has already been submitted"
                ),403
            );
        }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return "applicant data saved";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $id = Input::all()['user_id'];
        $application = SubmittedApplication::find($id);
        if(is_null($application))
        {
            return Response::json(
                array(
                    "error"=>"no submitted application for user id ".$id
                ),403
            );
        }
        else
        {
            $data=BioData::find($id);
            return Response::json(
                array(
                    "user_id"=>$data->user_id,
                    "firstname"=>$data->firstName,
                    "surname"=>$data->surname,
                    "passport"=>$data->passportPhoto
                ),200
            );
        }


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

}