<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Article;
use App\Models\VisionMission;
use App\Enums\VisionMissionType;
use Illuminate\Http\Request;


class UserController extends Controller
{
  /**
   * << Users Function >>
   * 
   * --------------------------------
   * @method viewArticle
   * @method indexLandingPage
   * --------------------------------
   */

  /*
  Show News Detail Page
  */
  public function viewArticle($id, $title) {
    $article = Article::findOrFail($id);

    return view('landing.news_detail', compact('article'));
  }

  public function indexLandingPage() 
  {
    // Get all the Staff and Director
    $director = Member::whereHas('position', function ($query) {
      $query->where('position', 'Director');
    })->first();
    $members = Member::whereHas('position', function ($query) {
      $query->where('position', 'LIKE', 'Head%')
            ->orWhere('position', 'LIKE', 'Vice Head%');
    })->get();
    // Get all Recent articles
    $recentArticles = Article::orderBy("created_at", "desc")->take(3)->get();
    // Get Vision
    $vision = VisionMission::where('type', VisionMissionType::VISION)->first();
    // Get Missions
    $missions = VisionMission::where('type', VisionMissionType::MISSION)->get();
    
    return view('landing.home', compact('director', 'members', 'recentArticles', 'vision', 'missions'));
  }

  public function viewArticleCatalog() {
    // Get 3 latest pinned news
    $pinnedArticles = Article::where('is_pinned', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

    // Get all IDs of the 3 pinned news above
    $displayedPinnedIds = $pinnedArticles->pluck('id');
    // Get 4 latest articles (regular articles, or remaining pinned articles that didn't make it to the top 3)
    $latestArticles = Article::where('status', 'published')
        ->whereNotIn('id', $displayedPinnedIds)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Get IDs of the latest articles to be excluded from the pagination below
    $displayedLatestIds = $latestArticles->pluck('id');
    // Merge all IDs that have been displayed above to avoid duplication
    $excludedIds = $displayedPinnedIds->merge($displayedLatestIds);

    // Get the rest of the articles for pagination
    $recentArticles = Article::where('status', 'published')
        ->whereNotIn('id', $excludedIds)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('landing.news_catalog', compact('latestArticles', 'recentArticles', 'pinnedArticles'));
  }
}
