<?php

namespace App\Http\Controllers;

use App\Employer;
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
     * @param \App\Employer $employer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Employer $employer)
    {
        $this->authorize('update', $employer);
        return view('profile.employer.edit', ['employer' => $employer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Employer $employer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Employer $employer)
    {
        $this->authorize('update', $employer);
        $attr = $request->validate($this->rules());
        $employer->update($attr);
        $employer->setLogo($request);

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employer $employer
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Employer $employer)
    {
        $this->authorize('delete', $employer);
    }

    private function rules() {
        return [
            'name' => 'string|required',
            'size' => 'integer|required',
            'website' => 'url|required'
        ];
    }
}
