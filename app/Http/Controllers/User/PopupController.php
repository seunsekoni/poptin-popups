<?php

namespace App\Http\Controllers\User;

use App\Enums\RuleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Popup\StorePopupRequest;
use App\Http\Requests\User\Popup\UpdatePopupRequest;
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

        if ($request->isJson()) {
            return response()->json([
                'data' => $popups,
                'message' => 'Popups fetched successfully',
                'status' => true,
            ]);
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

        $notes = "Kindly add this this code snippet to your page: 
            <b>{$popup->snippet_link}";

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
     * @param  UpdatePopupRequest  $request
     * @param Domain $domain
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePopupRequest $request, Domain $domain, Popup $popup)
    {
        $this->authorize('update', $popup);
        $popup = $this->popupService->update($popup, $request);
        $fullUrl = $request->getSchemeAndHttpHost();

        $notes = "Kindly add this this code snippet to your page: 
            {$fullUrl}/task.js?id={$popup->domain?->reference}";

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
        $this->authorize('delete', $popup);
        $this->popupService->delete($popup);

        return redirect()->route('popups.index')->with('status', 'Popup deleted successfully');
    }
}
