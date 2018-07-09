<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TorrentModel extends Model
{
    use Searchable;
    protected $table = 'torrent';

}
