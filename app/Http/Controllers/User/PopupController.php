<?php

namespace App\Http\Controllers\User;

use App\Enums\RuleEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Popup\StorePopupRequest;
use App\Models\Domain;
use App\Models\Popup;
use App\Services\Popupservice;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class PopupController extends Controller
{
    /**
     * @var PopupService
     */
    protected PopupService $popupService;

    public function __construct(PopupService $popupService)
    {
        $this->popupService = $popupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Domain $domain
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Domain $domain, Request $request)
    {
        $popups = $this->popupService->getAll()
            ->where('domain_id', $domain->id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return response()->json($popups);
        }

        return view('popups.index', compact([
            'domain',
            'popups',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Domain $domain
     * @return \Illuminate\Http\Response
     */
    public function create(Domain $domain)
    {
        $rules = RuleEnum::asSelectArray();

        return view('popups.create', compact('rules', 'domain'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Domain $domain
     * @param  StorePopupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePopupRequest $request, Domain $domain)
    {
        $popup = $this->popupService->store($request)->first();
        $fullUrl = $request->getSchemeAndHttpHost();

        $notes = new HtmlString("Kindly add this this code snippet to your page: 
            <b>{$popup->snippet_link}</b>
        ");

        return redirect()->back()->with('status', "Popup created successfully. {$notes}");
    }

    /**
     * Display the specified resource.
     *
     * @param Domain $domain
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain, Popup $popup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Domain $domain
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain, Popup $popup)
    {
        $rules = RuleEnum::asSelectArray();

        return view('popups.edit', compact('domain', 'popup', 'rules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Domain $domain
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain, Popup $popup)
    {
        $popup = $this->popupService->update($popup, $request);
        $fullUrl = $request->getSchemeAndHttpHost();

        $notes = new HtmlString("Kindly add this this code snippet to your page: 
            <pre>
                <code>
                    {$fullUrl}/task.js?id={$popup->domain->reference}
                </code>
            </pre>
        ");

        return redirect()->back()->with('status', "Popup updated successfully. {$notes}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Domain $domain
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain, Popup $popup)
    {
        $this->popupService->delete($popup);

        return redirect()->route('popups.index')->with('status', 'Popup deleted successfully');
    }
}
