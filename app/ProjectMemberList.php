<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectMemberList extends Pivot
{
    /**
     * Table name for this model
     */
    protected $table = 'project_member_list';
}
