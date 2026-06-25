<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Support\Site;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => array_slice(Site::services(), 0, 6),
            'projects' => Project::published()->ordered()->where('is_featured', true)->take(3)->get(),
            'stats'    => config('site.stats', []),
            'process'  => config('site.process', []),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'services' => Site::services(),
        ]);
    }

    public function portfolio()
    {
        return view('pages.portfolio', [
            'projects' => Project::published()->ordered()->get(),
        ]);
    }

    public function project(string $locale, string $slug)
    {
        $project = Project::published()->where('slug', $slug)->first();
        abort_if(! $project, 404);

        $others = Project::published()->ordered()
            ->where('slug', '!=', $slug)
            ->take(3)
            ->get();

        return view('pages.project', compact('project', 'others'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
