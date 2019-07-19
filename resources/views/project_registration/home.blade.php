@extends('layouts.app')
@section('content')
<div class="container" >
        @component('components.registration.project.project_info', ['projectRegis' => $projectRegis])
        
        @endcomponent
    
        <div class="card">
            <div class="card-header">
                New Idea/Project Description <br>
                <small>Please enter your updated Problem Statement/Product & Solution/ Target Market</small>
            </div>
            <div class="m-1 p-3 card-body">
                <form action="{{route('pr.temp.registration.update')}}" method="post">
                    @csrf

                    <input type="hidden" name="prID" value="{{Crypt::encrypt($projectRegis-> id)}}">
                    <div class="form-group row">
                        <label for="newProblem" class="col-sm-2 col-form-label">Problem Statement</label>
                        <div class="col-sm-10">
                                <textarea class="form-control" name="newProblem" id="newProblem" cols="30" rows="8"></textarea>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newProdSol" class="col-sm-2 col-form-label">Product / Solution</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="newProdSol" id="newProdSol" cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newTarget" class="col-sm-2 col-form-label">Target Market</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="newTarget" id="newTarget" cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button><br>
                        <strong>Warning : Please be advised, submission of updates is only allowed to ONE time per activation only. </strong>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection