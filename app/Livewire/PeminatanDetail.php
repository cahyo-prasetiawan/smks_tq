<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminatan;
use Illuminate\Support\Str;

class PeminatanDetail extends Component
{
    public $peminatan;

    public function mount($slug)
    {
        $this->peminatan = Peminatan::where('slug', $slug)->firstOrFail();
    }

    // Fungsi Super Robust untuk menangani Link Video
    private function generateVideoEmbedUrl($url)
    {
        // 1. Bersihkan URL dari spasi/enter yang tidak sengaja ter-copy
        $url = trim($url);

        if (empty($url)) return null;

        // 2. Jika File Video Langsung (MP4/WebM/OGG)
        if (Str::endsWith(strtolower($url), ['.mp4', '.webm', '.ogg'])) {
            return ['type' => 'file', 'url' => $url];
        }

        // 3. Jika Google Drive
        if (str_contains($url, 'drive.google.com')) {
            // Ubah /view menjadi /preview agar bisa di-embed
            $embed = preg_replace('/\/view.*/', '/preview', $url);
            if (!str_contains($embed, '/preview')) {
                $embed = rtrim($embed, '/') . '/preview';
            }
            return ['type' => 'embed', 'url' => $embed];
        }

        // 4. Jika YouTube (Logika Baru: Prioritaskan Query String)
        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            $videoId = null;

            // CARA A: Cek Parameter ?v= (Paling Akurat untuk link standar)
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            if (isset($params['v'])) {
                $videoId = $params['v'];
            }
            
            // CARA B: Cek Shortlink (youtu.be/ID)
            if (!$videoId && str_contains($url, 'youtu.be')) {
                $path = parse_url($url, PHP_URL_PATH);
                $videoId = trim($path, '/');
            }

            // CARA C: Cek Embed Link (youtube.com/embed/ID)
            if (!$videoId && str_contains($url, '/embed/')) {
                $path = parse_url($url, PHP_URL_PATH);
                $parts = explode('/', trim($path, '/'));
                $videoId = end($parts);
            }

            // Jika ID berhasil ditemukan, buat ulang link embed yang bersih
            if ($videoId) {
                return ['type' => 'embed', 'url' => "https://www.youtube.com/embed/{$videoId}?rel=0&modestbranding=1&showinfo=0"];
            }
        }

        // 5. Fallback Terakhir: Kembalikan link aslinya (berharap browser bisa handle)
        // Jangan return null agar iframe tetap mencoba merender (bisa jadi link embed custom)
        return ['type' => 'embed', 'url' => $url];
    }

    public function render()
    {
        // Proses Video URL
        $videoData = $this->generateVideoEmbedUrl($this->peminatan->video_url);

        return view('livewire.peminatan-detail', [
            'videoType' => $videoData['type'] ?? null,
            'videoEmbedUrl' => $videoData['url'] ?? null,
        ])->layout('components.layouts.app', [
            'title' => $this->peminatan->title . ' - SMKS IT Tanwirul Qulub',
            'description' => substr(strip_tags($this->peminatan->description), 0, 155),
        ]);
    }
}