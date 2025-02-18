<?php

use App\Models\Lead;

return[
  [
    'title'=>'Dashboard',
    'route'=>'dashboard',
    'icon'=>'fas fa-tachometer-alt',
  ],
  [
    'title'=>'Agents',
    'route'=>'agents.index',
    'icon'=>'fas fa-user-tie',
  //   'ability'=>['view-any',Lead::class],
  ],
  [
    'title'=>'Leads',
    'route'=>'leads.index',
    'icon'=>'fas fa-users',
  //   'ability'=>['view-any',Lead::class],
  ],
  [
    'title'=>'Tasks',
    'route'=>'tasks.index',
    'icon'=>'fas fa-tasks',
  //   'ability'=>['view-any',Lead::class],
  ],
  [
    'title'=>'Stages',
    'route'=>'stages.index',
    'icon'=>'fas fa-layer-group',
  //   'ability'=>['view-any',Lead::class],
  ],

];

