<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class TrackController extends Controller
{
    public function index($albumId)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            // Retorna todas as faixas associadas ao álbum
            return $album->tracks;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        }
    }

    public function store(Request $request, $albumId)
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
            return response()->json(['error' => $e->validator->errors()], 400); // Retorna erros de validação com código de status 400 (Bad Request)
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Retorna outros erros com código de status 500 (Internal Server Error)
        }
    }

    public function show($albumId, $id)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            // Verifica se a faixa com o ID fornecido pertence ao álbum
            $track = $album->tracks()->findOrFail($id);

            return $track;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Track not found'], 404);
        }
    }

    public function update(Request $request, $albumId, $id)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            $request->validate([
                'title' => 'required',
                'duration' => 'required|integer',
            ]);

            // Verifica se a faixa com o ID fornecido pertence ao álbum
            $track = $album->tracks()->findOrFail($id);
            $track->update($request->all());

            return $track;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Track not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($albumId, $id)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            // Verifica se a faixa com o ID fornecido pertence ao álbum
            $track = $album->tracks()->findOrFail($id);
            $track->delete();

            return response()->json(['message' => 'Track deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Track not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request, $albumId)
    {
        try {
            // Verifica se o álbum com o ID fornecido existe
            $album = Album::findOrFail($albumId);

            $query = $request->input('query');

            // Retorna todas as faixas associadas ao álbum que correspondem à pesquisa
            $tracks = $album->tracks()->where('title', 'like', '%' . $query . '%')->get();

            return $tracks;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Album not found'], 404);
        }
    }
}
