<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class AlbumController extends Controller
{
    public function index()
    {
        return Album::all();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'release_year' => 'required|integer',
            ]);

            return Album::create($request->all());
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            return Album::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'release_year' => 'required|integer',
            ]);

            $album = Album::findOrFail($id);
            $album->update($request->all());

            return $album;
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $album = Album::findOrFail($id);
            $album->delete();

            return response()->json(['message' => 'Album deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $albums = Album::where('title', 'like', '%' . $query . '%')->get();

        return $albums;
    }

    public function addTrack(Request $request, $albumId)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            $request->validate([
                'title' => 'required',
                'duration' => 'required|integer',
            ]);

            // Cria uma nova faixa associada ao álbum
            $track = new Track([
                'album_id' => $albumId,
                'title' => $request->input('title'),
                'duration' => $request->input('duration'),
            ]);
            $track->save();

            return response()->json($track, 201); // Retorna a faixa criada com código de status 201 (Created)
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
