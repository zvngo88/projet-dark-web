<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteCrawler extends Model
{
    protected $connection = 'mysql_crawler'; // La connexion MySQL si tu utilises une base de données spécifique
    protected $table = 'result'; // Remplace par le nom de ta table
}
