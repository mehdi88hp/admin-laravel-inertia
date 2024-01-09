<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string raw
 * @property int is_404_in_dict_dot_com
 * @property \Modules\Enums\ECrawlerType crawler_type
 */
class DicDotCom extends Model
{
    protected $guarded = ['id'];

    protected $table = 'dic_dot_com';

    public function word()
    {

    }
}
