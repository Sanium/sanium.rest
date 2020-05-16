<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['verified']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Client $client
     * @return Factory|RedirectResponse|Response|Redirector|View
     */
    public function edit(Request $request, Client $client)
    {
        try {
            $this->authorize('update', $client);
        } catch (AuthorizationException $e) {
            $request->session()->flash('status', $e->getMessage());
            return redirect(route('home'));
        }
        return view('profile.client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return Factory|RedirectResponse|Response|Redirector|View
     * @throws ValidationException
     */
    public function update(Request $request, Client $client)
    {
        try {
            $this->authorize('update', $client);
        } catch (AuthorizationException $e) {
            $request->session()->flash('status', $e->getMessage());
            return redirect(route('home'));
        }
        $attr = $this->validator($request->all())->validate();
        $client->update($attr);
        $client->setFile($request);
        $request->session()->flash('status', __('Profile updated.'));

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Client $client
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Client $client)
    {
        try {
            $this->authorize('delete', $client);
            $name = $client->name;
            $client->delete();
            $request->session()->flash('status', __('Client :name has been removed.', ['name' => $name]));
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return redirect(route('home'));
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'links' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimetypes:application/pdf'],
        ]);
    }
}
