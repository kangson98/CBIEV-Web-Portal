<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#supervisorInfo" aria-expanded="true"
            aria-controls="supervisorInfo">
            Project Supervisor
        </button>
        {{-- <form action="{{ route('send.email.ProjectRegis.supervisor',['id'=> $projectRegis ->id]) }}" method="post">
            @csrf
            <button class="btn btn-link" type="submit">Notify All Supervisors</button>
        </form> --}}
    </div>
    <div class="collapse" id="supervisorInfo">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Type</th>
                        <th>Name</th>
                        <th>IC No</th>
                        <th>Contact No</th>
                        <th>Personal Email</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>UC ID</th>
                        <th>Position</th>
                        <th>Center/Faculty</th>
                    </thead>
                    <tbody>
                        @foreach ($projectRegis-> projectSupervisor as $supervisor)
                        <tr>
                            <td>
                            @switch($supervisor-> member_type)
                                @case(2)
                                    UC Staff
                                    @break
                                @case(3)
                                    Alumni
                                    @break
                                @case(3)
                                    Public
                                    @break                                    
                            @endswitch
                            </td>
                            <td>{{$supervisor-> name}}</td>
                            <td>{{$supervisor-> ic}}</td>
                            <td>{{$supervisor-> contact}}</td>
                            <td>{{$supervisor-> email}}</td>
                            <td>{{$supervisor-> company-> company_name}}</td>
                            <td>{{$supervisor-> company_email}}</td>
                            <td>{{$supervisor-> uc_id}}</td>
                            <td>{{$supervisor-> position}}</td>
                            <td>{{$supervisor-> centerFaculty-> code}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
