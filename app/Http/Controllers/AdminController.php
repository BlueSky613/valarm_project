<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Horoscope;
use App\Models\VoiceOption;
use App\Models\VirtualImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;
use Pawlox\VideoThumbnail\VideoThumbnail;

class AdminController
{
    public function dashboard()
    {
        $stats = [
            'quotes_count' => Quote::count(),
            'active_quotes' => Quote::active()->count(),
            'horoscopes_count' => Horoscope::count(),
            'active_horoscopes' => Horoscope::active()->count(),
            'voice_options_count' => VoiceOption::count(),
            'active_voice_options' => VoiceOption::active()->count(),
            'virtual_images_count' => VirtualImage::count(),
            'active_virtual_images' => VirtualImage::active()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Quotes Management
    public function quotesIndex(Request $request)
    {
        $query = Quote::query();

        if ($request->filled('search')) {
            $query->where('content', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $quotes = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Quote::distinct()->pluck('category')->filter();

        return view('admin.quotes.index', compact('quotes', 'categories'));
    }

    public function quotesCreate()
    {
        return view('admin.quotes.create');
    }

    public function quotesStore(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        Quote::create($request->all());

        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote created successfully!');
    }

    public function quotesEdit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    public function quotesUpdate(Request $request, Quote $quote)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        $quote->update($request->all());

        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote updated successfully!');
    }

    public function quotesDestroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote deleted successfully!');
    }

    // Horoscopes Management
    public function horoscopesIndex(Request $request)
    {
        $query = Horoscope::query();

        if ($request->filled('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sign')) {
            $query->where('sign', $request->sign);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $horoscopes = $query->orderBy('date', 'desc')->paginate(10);
        $signs = Horoscope::getSigns();

        return view('admin.horoscopes.index', compact('horoscopes', 'signs'));
    }

    public function horoscopesCreate()
    {
        $signs = Horoscope::getSigns();
        return view('admin.horoscopes.create', compact('signs'));
    }

    public function horoscopesStore(Request $request)
    {
        $request->validate([
            'sign' => 'required|string|in:' . implode(',', array_keys(Horoscope::getSigns())),
            'content' => 'required|string|max:2000',
            'date' => 'required|date',
            'is_active' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        Horoscope::create($request->all());

        return redirect()->route('admin.horoscopes.index')
            ->with('success', 'Horoscope created successfully!');
    }

    public function horoscopesEdit(Horoscope $horoscope)
    {
        $signs = Horoscope::getSigns();
        return view('admin.horoscopes.edit', compact('horoscope', 'signs'));
    }

    public function horoscopesUpdate(Request $request, Horoscope $horoscope)
    {
        $request->validate([
            'sign' => 'required|string|in:' . implode(',', array_keys(Horoscope::getSigns())),
            'content' => 'required|string|max:2000',
            'date' => 'required|date',
            'is_active' => 'boolean',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        $horoscope->update($request->all());

        return redirect()->route('admin.horoscopes.index')
            ->with('success', 'Horoscope updated successfully!');
    }

    public function horoscopesDestroy(Horoscope $horoscope)
    {
        $horoscope->delete();

        return redirect()->route('admin.horoscopes.index')
            ->with('success', 'Horoscope deleted successfully!');
    }

    // Voice Options Management
    public function voiceOptionsIndex(Request $request)
    {
        $query = VoiceOption::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('voice_id', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $voiceOptions = $query->orderBy('created_at', 'desc')->paginate(10);
        $languages = VoiceOption::distinct()->pluck('language')->filter();
        $genders = VoiceOption::distinct()->pluck('gender')->filter();

        return view('admin.voice-options.index', compact('voiceOptions', 'languages', 'genders'));
    }

    public function voiceOptionsCreate()
    {
        return view('admin.voice-options.create');
    }

    public function voiceOptionsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'voice_id' => 'required|string|max:100',
            'language' => 'required|string|max:10',
            'gender' => 'nullable|string|in:male,female,neutral',
            'speed' => 'required|integer|min:1|max:5',
            'pitch' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:500',
        ]);

        VoiceOption::create($request->all());

        return redirect()->route('admin.voice-options.index')
            ->with('success', 'Voice option created successfully!');
    }

    public function voiceOptionsEdit(VoiceOption $voiceOption)
    {
        return view('admin.voice-options.edit', compact('voiceOption'));
    }

    public function voiceOptionsUpdate(Request $request, VoiceOption $voiceOption)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'voice_id' => 'required|string|max:100',
            'language' => 'required|string|max:10',
            'gender' => 'nullable|string|in:male,female,neutral',
            'speed' => 'required|integer|min:1|max:5',
            'pitch' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:500',
        ]);

        $voiceOption->update($request->all());

        return redirect()->route('admin.voice-options.index')
            ->with('success', 'Voice option updated successfully!');
    }

    public function voiceOptionsDestroy(VoiceOption $voiceOption)
    {
        $voiceOption->delete();

        return redirect()->route('admin.voice-options.index')
            ->with('success', 'Voice option deleted successfully!');
    }

    // Virtual Images Management
    public function virtualImagesIndex(Request $request)
    {
        $query = VirtualImage::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $virtualImages = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = VirtualImage::distinct()->pluck('category')->filter();

        return view('admin.virtual-images.index', compact('virtualImages', 'categories'));
    }

    public function virtualImagesCreate()
    {
        return view('admin.virtual-images.create');
    }

    public function virtualImagesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|mimetypes:video/mp4,video/ogg,video/webm',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $imagePath = $request->file('image')->store('virtual-images', 'public');

        $videoFullPath = public_path('storage/' . $imagePath);
        $thumbnailPath = public_path('storage/thumbnails');
        $thumbnailName = pathinfo($imagePath, PATHINFO_FILENAME) . '.png';
        $thumbnail = new VideoThumbnail();

        $thumbnail->createThumbnail($videoFullPath, $thumbnailPath, $thumbnailName, 1, 320, 240);

        Log::info('Creating thumbnail for video: ' . $thumbnailPath);

        VirtualImage::create([
            'name' => $request->name,
            'image_path' => $imagePath,
            'category' => $request->category,
            'description' => $request->description,
            'thumbnail' => 'thumbnails/'.$thumbnailName,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.virtual-images.index')
            ->with('success', 'Virtual image created successfully!');
    }

    public function virtualImagesEdit(VirtualImage $virtualImage)
    {
        return view('admin.virtual-images.edit', compact('virtualImage'));
    }

    public function virtualImagesUpdate(Request $request, VirtualImage $virtualImage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'category', 'description']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($virtualImage->image_path);
            $data['image_path'] = $request->file('image')->store('virtual-images', 'public');
        }

        $virtualImage->update($data);

        return redirect()->route('admin.virtual-images.index')
            ->with('success', 'Virtual image updated successfully!');
    }

    public function virtualImagesDestroy(VirtualImage $virtualImage)
    {
        Storage::disk('public')->delete($virtualImage->image_path);
        $virtualImage->delete();

        return redirect()->route('admin.virtual-images.index')
            ->with('success', 'Virtual image deleted successfully!');
    }
}
