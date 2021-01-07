<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait RecordSignature
{
    /**
     * @return void
     */
    public static function bootRecordSignature(): void
    {
        self::observerCreating();
        self::observerUpdating();
        self::observerDeleted();
    }

    /**
     * @return void
     */
    protected static function observerCreating(): void
    {
        static::creating(function (Model $model) {
            $model->created_by = Auth::User()->id;
            $model->updated_by = Auth::User()->id;
        });
    }

    /**
     * @return void
     */
    protected static function observerUpdating(): void
    {
        static::updating(function (Model $model) {
            $model->updated_by = Auth::User()->id;
        });
    }

    /**
     * @return void
     */
    protected static function observerDeleted(): void
    {
        static::deleted(function (Model $model) {
            $model->fill(['updated_by' => Auth::user()->id]);
            $model->saveQuietly();
        });
    }
}
