<?php

use App\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page= new Page;
        $page->user_id = 1;
        $page->title = "Test Page 1";
        $page->slug = "test/page/1";
        $page->published = 1;
        $page->body = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam facilisis, risus at malesuada viverra, arcu libero mollis mauris, vitae blandit orci mi sit amet augue. Nam nec mi eget diam viverra semper sit amet id eros. Donec eu venenatis odio. Etiam leo orci, mollis a est et, dignissim condimentum nibh. Aliquam ac euismod arcu. Ut a erat ac arcu malesuada faucibus. Aliquam erat volutpat. Curabitur nec bibendum ligula, ac suscipit urna.</p>
        <p>Etiam luctus velit nec neque convallis, nec maximus tortor varius. Ut elementum vestibulum ante ac porta. Fusce eget vulputate orci. Nunc rutrum ac sem in laoreet. Fusce odio nunc, malesuada et eleifend at, varius sit amet tortor. Nunc hendrerit lectus eu dolor rhoncus posuere. Fusce faucibus nisl a nibh lobortis accumsan. Nam iaculis mattis facilisis. Aenean nisl est, rutrum nec est sit amet, pretium maximus diam. Nam sagittis dictum ante, eget feugiat mauris finibus a. Ut id lacus et erat aliquam aliquam sit amet nec odio. Nunc vitae varius libero. Praesent sit amet neque posuere, rutrum purus vitae, porttitor urna. Suspendisse nec lectus id risus viverra ornare. Vivamus tincidunt, massa vel consequat fringilla, lacus ex pellentesque enim, ut pretium ex massa vel orci.</p>";
        $page->save();

        $page = new Page;
        $page->user_id = 1;
        $page->title = "Test Page 2";
        $page->slug = "test/page/2";
        $page->body = "<p>Sed elementum purus nec nunc tempor, non convallis eros sagittis. Morbi bibendum magna a lectus sagittis placerat. Nullam pretium augue in hendrerit pulvinar. Sed vel lacus ac quam molestie molestie. Quisque ullamcorper turpis eget nisl consequat sollicitudin. Aliquam et erat tincidunt, posuere magna nec, bibendum augue. Quisque sagittis, mi at suscipit tempor, lectus metus interdum est, quis sollicitudin magna leo scelerisque justo.</p>";
        $page->save();
    }
}