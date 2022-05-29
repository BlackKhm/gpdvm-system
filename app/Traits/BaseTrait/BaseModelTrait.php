<?php

namespace App\Traits\BaseTrait;

use App\Libraries\Sharable\SharableLib;
use Illuminate\Support\Facades\DB;

trait BaseModelTrait
{
    public static function BootBaseModelTrait()
    {
        static::created(function ($obj) {
            if (request()->has('share_view')) {
                resolve(SharableLib::class)->shareContact(request());
            }
        });

        static::updated(function ($obj) {
            if (request()->has('share_view')) {
                resolve(SharableLib::class)->shareContact(request());
            }
        });
    }
    /*
    |--------------------------------------------------------------------------
    | CONFIGS
    |--------------------------------------------------------------------------
    */
    public function idPrefixConfig()
    {
        return (object)[
            'column' => $this->idPrefixColumn ?? 'id',
            'digit' => $this->idPrefixDigit ?? 6,
            'prefix' => $this->idPrefix ?? '0',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function makeIdPrefix()
    {
        $config = $this->idPrefixConfig();

        return str_pad(
            $this->{$config->column},
            $config->digit,
            $config->prefix,
            STR_PAD_LEFT
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeIdPrefix($query, $text, $enableOrWhere = false)
    {
        $config = $this->idPrefixConfig();

        $prefix = $config->column.'::text';

        // $sql = \DB::raw("LPAD({$prefix},{$config->digit},{$config->prefix})");

        $sql = $config->column;

        $text = ltrim($text, $config->prefix);
        // dd(is_string($text));
        if (is_null($text) || $text == $config->prefix) {
            return $query;
        }
        // dd($text);
        if ($enableOrWhere) {
            return $query->orWhere($sql,'like' ,  $text."%");
            // return $query->orWhere($sql, $text);
        }

        return $query->where($sql,'like' ,  $text."%");
        // return $query->where($sql, $text);
    }

    public function scopeOrderByIdPrefix($query, $columnDirection)
    {
        $config = $this->idPrefixConfig();

        return $query->orderBy($config->column, $columnDirection);
    }

    public function scopeWhereColumnConcats($query, $value, $column = [], $operator = ' ')
    {
        if (is_array($column) && count($column)) {

            $likeString = env('DB_CONNECTION') === 'pgsql' ? 'ILIKE' : 'like';
            $concat = implode(",'".$operator."',", $column);
            return $query->where(DB::raw("CONCAT({$concat})"), $likeString, '%'.$value.'%');
        }
        return $query;
    }

    public function scopeFlexiPaginate($query, $perPage = false)
    {
        $request = request();

        $setPerPage = $request->per_page ? $request->per_page : 10;

        if (!$perPage) {
            $perPage = $setPerPage;
        } else {
            if (!is_numeric($perPage)) {
                $perPage = $setPerPage;
            }
        }

        return $query->paginate($perPage);
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getIdPrefixAttribute()
    {
        return $this->makeIdPrefix();
        // $config = $this->idPrefixConfig();

        // return str_pad(
        //     $this->{$config->column},
        //     $config->digit,
        //     $config->prefix,
        //     STR_PAD_LEFT
        // );
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
