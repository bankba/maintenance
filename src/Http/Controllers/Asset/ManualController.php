<?php

namespace Stevebauman\Maintenance\Http\Controllers\Asset;

use Stevebauman\Maintenance\Http\Requests\Asset\ManualRequest;
use Stevebauman\Maintenance\Repositories\Asset\ManualRepository;
use Stevebauman\Maintenance\Repositories\Asset\Repository as AssetRepository;
use Stevebauman\Maintenance\Http\Controllers\Controller as BaseController;

class ManualController extends BaseController
{
    /**
     * @var AssetRepository
     */
    protected $asset;

    /**
     * Constructor.
     *
     * @param AssetRepository  $asset
     * @param ManualRepository $manual
     */
    public function __construct(AssetRepository $asset, ManualRepository $manual)
    {
        $this->asset = $asset;
        $this->manual = $manual;
    }

    /**
     * Displays all of the specified asset manuals.
     *
     * @param int|string $assetId
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $asset = $this->asset->find($id);

        return view('maintenance::assets.manuals.index', compact('asset'));
    }

    /**
     * Displays the asset manual upload form.
     *
     * @param int|string $assetId
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $asset = $this->asset->find($id);

        return view('maintenance::assets.manuals.create', compact('asset'));
    }
    /**
     * Uploads manuals and attaches them to the specified asset.
     *
     * @param ManualRequest $request
     * @param int|string    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ManualRequest $request, $id)
    {
        $asset = $this->asset->find($id);

        $attachments = $this->manual->upload($request, $asset, $asset->images());

        if($attachments) {
            $message = 'Successfully uploaded files.';

            return redirect()->route('maintenance.assets.manuals.index', [$asset->id])->withSuccess($message);
        } else {
            $message = 'There was an issue uploading the files you selected. Please try again.';

            return redirect()->route('maintenance.assets.manuals.create', [$id])->withErrors($message);
        }
    }

    /**
     * Displays the asset manual.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if($manual) {
            return view('maintenance::assets.manuals.show', compact('asset', 'manual'));
        }

        abort(404);
    }

    /**
     * Displays the form for editing an uploaded manual.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if($manual) {
            return view('maintenance::assets.manuals.edit', compact('asset', 'manual'));
        }

        abort(404);
    }

    /**
     * Processes deleting an attachment record and the file itself.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if($manual && $manual->delete()) {
            $message = 'Successfully deleted manual.';

            return redirect()->route('maintenance.work-orders.attachments.index', [$manual->id])->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this manual. Please try again.';

            return redirect()->route('maintenance.work-orders.attachments.show', [$asset->id, $manual->id])->withErrors($message);
        }
    }
}
