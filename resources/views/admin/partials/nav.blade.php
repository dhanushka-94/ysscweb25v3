<nav class="bg-white shadow-sm border-b-2 border-yellow-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-900">
                        YSSC Admin
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.sliders.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Sliders
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        News
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Team
                    </a>
                    <a href="{{ route('admin.team-categories.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Team Categories
                    </a>
                    <a href="{{ route('admin.fixtures.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Fixtures
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Gallery
                    </a>
                    <a href="{{ route('admin.sponsors.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Sponsors
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Shop
                    </a>
                    <a href="{{ route('admin.office-bearers.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Office Bearers
                    </a>
                    <a href="{{ route('admin.member-applications.index') }}" class="border-transparent text-gray-500 hover:border-yellow-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Applications
                    </a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.settings.index') }}" class="text-gray-700 hover:text-yellow-600 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
                <a href="{{ route('home') }}" target="_blank" class="text-gray-700 hover:text-yellow-600 text-sm">
                    View Site
                </a>
                <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

