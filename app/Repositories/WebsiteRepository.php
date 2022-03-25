<?php

namespace App\Repositories;

use App\Models\Website;

class WebsiteRepository extends BaseRepository
{
    public function __construct(Website $website)
    {
        parent::__construct($website);
    }
}