<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Konten;
use App\Models\Pengumuman;
use App\Models\TentangKami;
use App\Models\UnitUsaha;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index', [
            'konten'      => Konten::first(),
            'tentang'     => TentangKami::first(),
            'unitUsahas'  => UnitUsaha::latest()->get(),
            'beritas'     => Berita::where('status', 'published')->latest()->take(3)->get(),
            'pengumumans' => Pengumuman::where('status', 'published')->latest()->take(4)->get(),
        ]);
    }

    public function tentangKami()
    {
        return view('landing.tentang-kami', [
            'tentang' => TentangKami::first(),
        ]);
    }

    public function berita()
    {
        return view('landing.berita', [
            'beritas' => Berita::where('status', 'published')->latest()->paginate(9),
        ]);
    }

    public function beritaDetail(Berita $berita)
    {
        abort_if($berita->status !== 'published', 404);

        return view('landing.berita-detail', [
            'berita'  => $berita,
            'lainnya' => Berita::where('status', 'published')
                ->where('id', '!=', $berita->id)
                ->latest()->take(4)->get(),
        ]);
    }

    public function pengumuman()
    {
        return view('landing.pengumuman', [
            'pengumumans' => Pengumuman::where('status', 'published')->latest()->paginate(10),
        ]);
    }

    public function pengumumanDetail(Pengumuman $pengumuman)
    {
        abort_if($pengumuman->status !== 'published', 404);

        return view('landing.pengumuman-detail', [
            'pengumuman' => $pengumuman,
            'lainnya'    => Pengumuman::where('status', 'published')
                ->where('id', '!=', $pengumuman->id)
                ->latest()->take(4)->get(),
        ]);
    }

    public function unitUsahaDetail(UnitUsaha $unitUsaha)
    {
        return view('landing.unit-usaha-detail', [
            'unitUsaha' => $unitUsaha,
            'lainnya'   => UnitUsaha::where('id', '!=', $unitUsaha->id)->latest()->get(),
        ]);
    }
}
