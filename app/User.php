<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    /**
     * Players only local scope
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPlayers($query): Builder
    {
        return $query->where('user_type', 'player');
    }

    public function getIsGoalieAttribute(): bool
    {
        return (bool) $this->can_play_goalie;
    }

    public function getFullnameAttribute(): string
    {
        return Str::title($this->first_name . ' ' . $this->last_name);
    }
}
