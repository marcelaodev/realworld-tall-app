<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return new TagCollection(Tag::all());
    }
}
