<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Popup;

class PopupService implements ModelInterface
{
    /**
     * Get all popups.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAll()
    {
        return Popup::query();
    }

    /**
     * Get the popup by id.
     *
     * @param  int $id
     * @return Popup
     */
    public function getById(int $id): Popup
    {
        return Popup::findOrFail($id);
    }

    /**
     * Store a new popup.
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store($request)
    {
        $domain = $request->domain;
        $data = [];
        if ($forms = $request['form']) {
            foreach ($forms as $req) {
                $popup = new Popup();
                $popup->page = $req['page'];
                $popup->text = $req['text'];
                $popup->rule = $req['rule'];
                $popup->status = $req['status'];

                $data[] = $popup;
            }
            // Save all data in DB at once
            $domain->popups()->saveMany($data);
        }

        return $domain->popups;
    }

    /**
     * Update a popup.
     *
     * @param  $popup
     * @param  $request
     * @return Popup
     */
    public function update($popup, $request): Popup
    {
        $popup->page = $request->page;
        $popup->text = $request->text;
        $popup->rule = $request->rule;
        $popup->status = $request->status;
        $popup->update();

        return $popup;
    }

    /**
     * Delete a popup.
     *
     * @param  $popup
     * @return void
     */
    public function delete($popup)
    {
        $popup->delete();
    }
}
