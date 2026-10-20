<?php

namespace App\Http\Controllers;

use App\Models\Rekod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RekodController extends Controller
{
    /** Register config or 404. */
    protected function config(string $jenis): array
    {
        return config("perumahan.types.$jenis") ?? abort(404);
    }

    /** All labels of a register, flattened. */
    protected function labels(array $cfg): array
    {
        return collect($cfg['sections'])->flatMap(fn ($s) => collect($s['fields'])->pluck('label'))->all();
    }

    public function index()
    {
        $types = config('perumahan.types');
        $counts = Rekod::selectRaw('jenis, count(*) as total')->groupBy('jenis')->pluck('total', 'jenis');

        return view('rekod.index', [
            'types' => $types,
            'groups' => config('perumahan.groups'),
            'counts' => $counts,
            'recent' => Rekod::latest()->take(6)->get(),
            'statusTally' => Rekod::selectRaw('status, count(*) as total')
                ->whereNotNull('status')->groupBy('status')->pluck('total', 'status'),
        ]);
    }

    public function list(Request $request, string $jenis)
    {
        $cfg = $this->config($jenis);

        $rekods = Rekod::jenis($jenis)
            ->cari($request->query('q'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('rekod.list', compact('jenis', 'cfg', 'rekods') + ['q' => $request->query('q', '')]);
    }

    public function choose(string $jenis)
    {
        $cfg = $this->config($jenis);
        abort_unless($cfg['choose'] ?? false, 404);

        return view('rekod.choose', compact('jenis', 'cfg'));
    }

    public function create(Request $request, string $jenis)
    {
        $cfg = $this->config($jenis);

        if (($cfg['choose'] ?? false) && blank($request->query('jenis_permohonan'))) {
            return redirect()->route('perumahan.choose', $jenis);
        }

        return view('rekod.form', [
            'jenis' => $jenis,
            'cfg' => $cfg,
            'rekod' => new Rekod(['jenis' => $jenis, 'jenis_permohonan' => $request->query('jenis_permohonan')]),
        ]);
    }

    public function show(string $jenis, Rekod $rekod)
    {
        return view('rekod.show', ['jenis' => $jenis, 'cfg' => $this->config($jenis), 'rekod' => $rekod]);
    }

    public function edit(string $jenis, Rekod $rekod)
    {
        return view('rekod.form', ['jenis' => $jenis, 'cfg' => $this->config($jenis), 'rekod' => $rekod]);
    }

    public function store(Request $request, string $jenis)
    {
        $rekod = Rekod::create($this->payload($request, $jenis));

        return redirect()
            ->route('perumahan.show', [$jenis, $rekod])
            ->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function update(Request $request, string $jenis, Rekod $rekod)
    {
        $rekod->update($this->payload($request, $jenis));

        return redirect()
            ->route('perumahan.show', [$jenis, $rekod])
            ->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function destroy(string $jenis, Rekod $rekod)
    {
        $rekod->delete();

        return redirect()->route('perumahan.list', $jenis)->with('berjaya', 'Rekod telah dihapuskan');
    }

    /** Validate against the config and fold the fields into the JSON column. */
    protected function payload(Request $request, string $jenis): array
    {
        $cfg = $this->config($jenis);
        $labels = $this->labels($cfg);

        $rules = ['status' => ['nullable', 'string', 'max:80'], 'jenis_permohonan' => ['nullable', 'string', 'max:120']];
        $names = [];

        foreach ($labels as $label) {
            $name = Str::slug($label, '_');
            $names[$name] = $label;
            // First field of the first section is required; everything else optional.
            $rules["fields.$name"] = [$label === $labels[0] ? 'required' : 'nullable', 'string', 'max:255'];
        }

        $validated = $request->validate($rules, [], collect($names)->mapWithKeys(
            fn ($label, $name) => ["fields.$name" => $label]
        )->all());

        return [
            'jenis' => $jenis,
            'jenis_permohonan' => $validated['jenis_permohonan'] ?? $request->input('jenis_permohonan'),
            'status' => $validated['status'] ?? $request->input('fields.status') ?? 'Dalam Proses',
            'data' => array_filter($validated['fields'] ?? [], fn ($v) => $v !== null),
        ];
    }
}
