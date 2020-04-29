<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);

        return view('clients.index')->with(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());

        $photo = $request->file('photo');

        if (optional($photo)->store('public')) {

            $attributes = [
                'filename' => $photo->hashName(),
                'extension' => $photo->extension(),
            ];

            $client->photo()->save(new Photo($attributes));
        }

        return redirect()->route('clients.show', ['client' => $client]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show')->with(compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')->with(compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->fill($request->validated())->save();

        $photo = $request->file('photo');

        if (optional($photo)->store('public')) {

            // remove previous image before we add new
            if ($client->photo()->exists()) {

                Storage::delete('public' . DIRECTORY_SEPARATOR . $client->photo->filename);

                $client->photo->delete();
            }

            $attributes = [
                'filename' => $photo->hashName(),
                'extension' => $photo->extension(),
            ];

            $client->photo()->save(new Photo($attributes));
        }

        return redirect()->route('clients.show', ['client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if ($client->photo()->exists()) {
            Storage::delete('public' . DIRECTORY_SEPARATOR . $client->photo->filename);
        }

        $client->delete();

        return response()->json(['url' => route('clients.index')]);
    }

    /**
     * Delete client photo from storage.
     *
     * @param Request $request
     * @param Client $client
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePhoto(Request $request, Client $client)
    {
        if ($client->photo()->exists()) {

            Storage::delete('public' . DIRECTORY_SEPARATOR . $client->photo->filename);

            $client->photo->delete();
        }

        return response()->json();
    }
}
