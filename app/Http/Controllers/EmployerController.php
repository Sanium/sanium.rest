<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['show', 'index']);
        $this->middleware(['verified'])->except(['show', 'index', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Employer::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        dd($employer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Employer $employer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|\Illuminate\View\View
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Employer $employer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
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

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Employer $employer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Employer $employer)
    {
        try {
            $this->authorize('delete', $employer);
            $employer->delete();
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
