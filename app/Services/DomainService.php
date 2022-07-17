<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Domain;

class DomainService implements ModelInterface
{
    /**
     * Get all domains.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAll()
    {
        return Domain::query();
    }

    /**
     * Get the domain by id.
     *
     * @param  int $id
     * @return Domain
     */
    public function getById(int $id): Domain
    {
        return Domain::findOrFail($id);
    }

    /**
     * Store a new domain.
     *
     * @param $data
     * @return Domain
     */
    public function store($request): Domain
    {
        $domain = new Domain();
        $domain->user()->associate($request->user()->id);
        $domain->top_level = $request->top_level;
        $domain->reference = \Illuminate\Support\Str::uuid();
        $domain->description = $request->description;
        $domain->save();

        return $domain;
    }

    /**
     * Update a domain.
     *
     * @param  $request
     * @param  $domain
     * @return Domain
     */
    public function update($request, $domain): Domain
    {
        $domain->top_level = $request->top_level;
        $domain->description = $request->description;
        $domain->update();

        return $domain;
    }

    /**
     * Delete a domain.
     *
     * @param  $domain
     * @return void
     */
    public function delete($domain): void
    {
        $domain->delete();
    }
}
