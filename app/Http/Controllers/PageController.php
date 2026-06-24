<?php

namespace App\Http\Controllers;

use App\Support\Site;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => array_slice(Site::services(), 0, 6),
            'projects' => array_slice(Site::projects(), 0, 3),
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
            'projects' => Site::projects(),
        ]);
    }

    public function project(string $locale, string $slug)
    {
        $project = Site::project($slug);
        abort_if(! $project, 404);

        $others = collect(Site::projects())
            ->where('slug', '!=', $slug)
            ->take(3)
            ->all();

        return view('pages.project', compact('project', 'others'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
