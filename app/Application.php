<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    ///////////////////////////////////////////////
    /* Application Relationships */
    ///////////////////////////////////////////////

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    ///////////////////////////////////////////////
    /* Application Attribute Mutatators */
    ///////////////////////////////////////////////

    protected $appends = ['status'];

    public function getAnswersAttribute($answers)
    {
        return collect(json_decode($answers));
    }

    public function getStatusAttribute()
    {
        if ($this->invitations->count()) {
            return 'invited';
        }

        if ($this->job->awarded_user_id) {

            if ($job->awarded_to == auth()->user()->id) {
                return 'awarded';
            }

            return 'lost';
        }

        return null;
    }

    public function getQualifiedAttribute()
    {
        return $this->isQualified();
    }

    public function getIsQualifiedAttribute()
    {
        return $this->isQualified();
    }

    public function setQualifiedAttribute()
    {
        return $this->isQualified();
    }

    ///////////////////////////////////////////////
    /* Application Utility Methods */
    ///////////////////////////////////////////////

    public function isQualified()
    {
        $boolean = (boolean) $this->requirementsMismatchCount();
        return !$boolean;
    }

    public function requirementsMismatchCount()
    {
        return $this->requirementsMismatch()->count();
    }

    public function requirementsMismatch()
    {
        $scheme = [];
        $answers = [];

        if ($this->job) {

            foreach ($this->job->questions()->where('requirement', true)->get() as $value) {
                $scheme[] = $value->id . '~~' . $value->answer;
            }

            foreach ($this->answers->where('requirement', true)->values() as $value) {
                $answers[] = $value->question_id . '~~' . $value->answer;
            }
        }

        return collect(array_diff($answers, $scheme));
    }

    public function totalMissmatch()
    {
        $scheme = [];
        foreach ($this->job->questions()->get() as $value) {
            $scheme[] = $value->id . '~~' . $value->answer;
        }

        $answers = [];
        foreach ($this->answers->values() as $value) {
            $answers[] = $value->question_id . '~~' . $value->answer;
        }

        return collect(array_diff($answers, $scheme));
    }

    public function totalMatch()
    {
        return $this->job->questions->count() - $this->totalMissmatch()->count();
    }
}
