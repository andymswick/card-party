@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
                <div class="ml-4 mt-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Card Games
                    </h3>
                </div>
                <div class="ml-4 mt-2 flex-shrink-0">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('games.create') }}"
                            class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700">
                            Start a New Game
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <ul>
            @forelse ($games as $game)
            <li>
                <a @if($game->has_started) href="{{ $game->play_link }}" @else href="{{ $game->setup_link }}" @endif
                    class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150
                    ease-in-out">
                    <div class="px-4 py-4 flex items-center sm:px-6">
                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                    {{ $game->game_type->label }}
                                </div>
                                <div class="mt-2 flex">
                                    <div class="flex items-center text-sm leading-5 text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>
                                            Created on
                                            <time
                                                datetime="{{ $game->created_at }}">{{ $game->created_at->format('M, d Y')}}</time>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex-shrink-0 sm:mt-0">
                                <div class="flex overflow-hidden">
                                    @foreach($game->players as $player)
                                    @if($player['user_id'] !== null)
                                    <img class="{{ $loop->first ? '' : '-ml-1'}} inline-block h-8 w-8 rounded-full text-white shadow-solid"
                                        src="{{ $game->users->firstWhere('id', $player['user_id'])->gravatar }}"
                                        alt="" />
                                    @else
                                    <div
                                        class="{{ $loop->first ? '' : '-ml-1'}} inline-block h-8 w-8 rounded-full text-white bg-blue-600 shadow-solid flex items-center justify-center">
                                        {{ substr($player['name'], 0, 1) }}
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
            @empty
            <li class="px-4 py-4">No games have been created.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection