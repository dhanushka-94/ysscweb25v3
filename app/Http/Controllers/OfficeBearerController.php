<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeBearer;

class OfficeBearerController extends Controller
{
    public function index()
    {
        try {
            // Get all office bearers ordered by category order and then by individual order
            $officeBearers = OfficeBearer::orderBy('order')->orderBy('name')->get();
            
            // Group by category
            $groupedOfficeBearers = $officeBearers->groupBy('category');
            
            // Define category display order
            $categoryOrder = [
                'Executive Committee',
                'Committee Members',
                'Sports Management',
                'Administration',
                'Advisors',
            ];
            
            // Sort categories according to predefined order
            $sortedOfficeBearers = collect();
            foreach ($categoryOrder as $category) {
                if ($groupedOfficeBearers->has($category)) {
                    $sortedOfficeBearers->put($category, $groupedOfficeBearers->get($category));
                }
            }
            
            // Add any additional categories not in the predefined list
            foreach ($groupedOfficeBearers as $category => $bearers) {
                if (!in_array($category, $categoryOrder)) {
                    $sortedOfficeBearers->put($category, $bearers);
                }
            }
            
        } catch (\Exception $e) {
            $sortedOfficeBearers = collect();
        }
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => null],
            ['title' => 'Office Bearers', 'url' => null]
        ];
        
        return view('about.office-bearers', compact('sortedOfficeBearers', 'breadcrumbs'));
    }
}
