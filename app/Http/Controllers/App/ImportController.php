<?php

namespace App\Http\Controllers\App;

use App\Helper\LinkAce;
use App\Helper\LinkIconMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoImportRequest;
use App\Models\Link;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Shaarli\NetscapeBookmarkParser\NetscapeBookmarkParser;

/**
 * Class ImportController
 *
 * @package App\Http\Controllers\App
 */
class ImportController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getImport()
    {
        return view('actions.import.import');
    }

    /**
     * Permanently delete entries for a model from the trash
     *
     * @param DoImportRequest $request
     * @return Response
     * @throws FileNotFoundException
     */
    public function doImport(DoImportRequest $request)
    {
        $data = $request->file('import-file')->get();

        $parser = new NetscapeBookmarkParser();

        $links = $parser->parseString($data);

        if (empty($links)) {
            alert(trans('import.import_empty'), 'warning');
            return redirect()->back();
        }

        $user_id = auth()->id();
        $imported = 0;
        $skipped = 0;

        foreach ($links as $link) {
            if (Link::whereUrl($link['uri'])->first()) {
                $skipped++;
            } else {
                $link_meta = LinkAce::getMetaFromURL($link['uri']);

                $title = $link['title'] ?: $link_meta['title'];

                $new_link = new Link([
                    'user_id' => $user_id,
                    'url' => $link['uri'],
                    'title' => $title,
                    'description' => $link['note'] ?: $link_meta['description'],
                    'icon' => LinkIconMapper::mapLink($link['uri']),
                    'is_private' => $link['pub'],
                ]);

                // created_at is not fillable. We have to set it.
                $new_link->created_at = Carbon::createFromTimestamp($link['time']);
                $new_link->save();


                // Get all tags
                if (!empty($link['tags'])) {
                    $tags = explode(' ', $link['tags']);

                    foreach ($tags as $tag) {
                        $new_tag = Tag::firstOrCreate([
                            'user_id' => $user_id,
                            'name' => $tag,
                        ]);

                        $new_link->tags()->attach($new_tag->id);
                    }
                }

                $imported++;
            }
        }

        alert(trans('import.import_successfully', [
            'imported' => $imported,
            'skipped' => $skipped,
        ]), 'success');

        return redirect()->back();
    }
}
