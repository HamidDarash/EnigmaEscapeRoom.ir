<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use App\Game;
use Illuminate\Http\Request;
use Session;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['current_menu_select' => 'games']);
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $games = Game::where('name', 'LIKE', "%$keyword%")
                ->orWhere('information', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $games = Game::paginate($perPage);
        }

        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session(['current_menu_select' => 'games']);
        return view('admin.games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Game::create($requestData);

        Session::flash('flash_message', 'بازی جدید اضافه گردید');

        return redirect('admin/games');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);

        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();
        $game = Game::findOrFail($id);
        $game->update($requestData);


        if ($request->file('image') != null) {
            $imageName = 'game-id-' . $id . '.' .
                $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                base_path() . '/public/img/games/', $imageName
            );

            if (isset($imageName)) {
                $game->previewImg = $imageName;
                $game->save();
            }
        }

        Session::flash('flash_message', 'بازی مورد نظر بروزرسانی شد');
        return redirect('admin/games');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        if ($game->previewImg) {
            $deletePath = base_path() . '/public/img/games/' . $game->previewImg;
            if (File::exists($deletePath)) {
                File::delete($deletePath);
            }
        }

        Game::destroy($id);
        Session::flash('flash_message', 'بازی مورد نظر حذف گردید');
        return redirect('admin/games');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function changeActivate(Request $request)
    {
        $game_id = $request['gameId'];
        $activate = $request['activate'];
        $gameTableItem = null;
        if (isset($game_id) && isset($activate)) {
            $gameTableItem = Game::find($game_id);

            if ($activate == "1") {
                $gameTableItem->activate = 0;
            } else {
                $gameTableItem->activate = 1;
            }
            $gameTableItem->save();
        }
        return array(
            'gameId' => $game_id,
            'activate' => $gameTableItem->activate
        );
    }


}
