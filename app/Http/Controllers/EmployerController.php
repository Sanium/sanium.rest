<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class EmployerController extends Controller
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
     * @param Employer $employer
     * @return Factory|RedirectResponse|Response|Redirector|View
     */
    public function edit(Request $request, Employer $employer)
    {
        try {
            $this->authorize('update', $employer);
        } catch (AuthorizationException $e) {
            $request->session()->flash('status', $e->getMessage());
            return redirect(route('home'));
        }
        return view('profile.employer.edit', ['employer' => $employer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employer $employer
     * @return RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Employer $employer)
    {
        try {
            $this->authorize('update', $employer);
        } catch (AuthorizationException $e) {
            $request->session()->flash('status', $e->getMessage());
            return redirect(route('home'));
        }
        $attr = $request->validate($this->rules());
        $employer->update($attr);
        $employer->setLogo($request);
        $request->session()->flash('status', __('Profile updated.'));

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Employer $employer
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Employer $employer)
    {
        try {
            $this->authorize('delete', $employer);
            $name = $employer->name;
            $employer->delete();
            $request->session()->flash('status', __('Employer :name has been removed.', ['name' => $name]));
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return redirect(route('home'));
        }
    }

    private function rules() {
        return [
            'name' => 'string|required',
            'size' => 'integer|required',
            'website' => 'url|required'
        ];
    }
}
