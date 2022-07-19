<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Popup;
use App\Models\PopupRule;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        $domain = $request->domain;
        $data = [];
        $popup = new Popup();
        $popup->domain()->associate($domain);
        $popup->text = $request->text;
        $popup->save();

        if ($forms = $request['form']) {
            foreach ($forms as $req) {
                $popupRule = new PopupRule();
                $popupRule->popup_id = $popup->id;
                $popupRule->page = $req['page'];
                $popupRule->rule = $req['rule'];
                $popupRule->status = $req['status'];

                $data[] = $popupRule;
            }
            // Save all data in DB at once
            $popup->rules()->saveMany($data);
        }
        DB::commit();

        return $domain->popups;
    }

    /**
     * Update a popup.
     *
     * @param  $popup
     * @param  $request
     * @return Popup $popup
     */
    public function update($popup, $request): Popup
    {
        $forms = $request['form'];
        foreach ($forms as $req) {
            if (array_key_exists('id', $req)) {
                $popupRule = PopupRule::findOrFail($req['id']);
                $popupRule->page = $req['page'];
                $popupRule->rule = $req['rule'];
                $popupRule->status = $req['status'];
                $popupRule->save();
            } else {
                $popupRule = new PopupRule();
                $popupRule->popup_id = $popup->id;
                $popupRule->page = $req['page'];
                $popupRule->rule = $req['rule'];
                $popupRule->status = $req['status'];
                $popupRule->save();
            }
        }

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

    /**
     * Delete a popup rule.
     *
     * @param  $popupRule
     * @return void
     */
    public function deleteRule($popupRule)
    {
        $popupRule->delete();
    }
}
