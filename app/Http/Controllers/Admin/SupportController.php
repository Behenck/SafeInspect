<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\{CreateSupportDTO, UpdateSupportDTO};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ){}

    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('totalPerPage', 15),
            filter: $request->filter
        );
        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports.index', compact('supports', 'filters'));
    }

    public function show(string|int $id, Support $support)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports.create');
    }

    public function store(StoreUpdateSupportRequest $request)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    public function edit(string|int $id, Support $support)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupportRequest $request, Support $support)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id, Support $support) {
        $this->service->delete($id);

        $support->delete();

        return redirect()->route('supports.index');
    }
}
