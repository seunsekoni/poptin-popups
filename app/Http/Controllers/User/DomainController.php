<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Domain\StoreDomainRequest;
use App\Http\Requests\User\Domain\UpdateDomainRequest;
use App\Models\Domain;
use App\Services\DomainService;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * @var DomainService
     */
    protected DomainService $domainService;

    /**
     * DomainController constructor.
     *
     * @param DomainService $domainService
     * @return void
     */
    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $domains = $this->domainService->getAll()
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->ajax()) {
            return response()->json($domains);
        }

        return view('domains.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDomainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainRequest $request)
    {
        $this->domainService->store($request);

        return redirect()->back()
            ->with('status', 'Domain created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $domain
     * @return \Illuminate\Http\Response
     */
    public function show($domain)
    {
        $domain = $this->domainService->getById($domain)->load('popups');
        $this->authorize('view', $domain);

        return view('popups.index', compact('domain'));
    }

    /**
     * Show specied resource to public.
     */
    /**
     * Display the specified resource.
     *
     * @param  int $domain
     * @return \Illuminate\Http\Response
     */
    public function showPublic($domain)
    {
        $domain = $this->domainService->getById($domain)->load('popups.rules');

        return response()
            ->json([
                'data' => $domain,
                'message' => 'Domain loaded successfully.',
                'status' => true,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        return view('domains.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDomainRequest  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $this->authorize('update', $domain);
        $this->domainService->update($request, $domain);

        return redirect()->back()
            ->with('status', 'Domain updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        $this->authorize('delete', $domain);
        $this->domainService->delete($domain);

        return redirect()->route('domains.index')
            ->with('status', 'Domain deleted successfully.');
    }
}
