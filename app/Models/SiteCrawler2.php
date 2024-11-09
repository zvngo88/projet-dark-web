<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SiteCrawler2  extends Model
{
    protected $connection = 'mysql_crawler'; // Connexion MySQL si nécessaire
    protected $table = 'result2'; // Nom de ta deuxième table
}