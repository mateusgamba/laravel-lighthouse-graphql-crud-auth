<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait RecordSignature
{
    /**
     * @return void
     */
    public static function bootRecordSignature()
    {
        self::observerCreating();
        self::observerUpdating();
        self::observerDeleted();
    }

    /**
     * @return void
     */
    protected static function observerCreating()
    {
        static::creating(function (Model $model) {
            $model->created_by = Auth::User()->id;
            $model->updated_by = Auth::User()->id;
        });
    }

    /**
     * @return void
     */
    protected static function observerUpdating()
    {
        static::updating(function (Model $model) {
            $model->updated_by = Auth::User()->id;
        });
    }

    /**
     * @return void
     */
    protected static function observerDeleted()
    {
        static::deleted(function (Model $model) {
            $model->fill(['updated_by' => Auth::user()->id]);
            $model->saveQuietly();
        });
    }
}
