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
        
        $page = new Page;
        $page->user_id = 1;
        $page->title = "Admissions Page 1";
        $page->slug = "admissions/page/1";
        $page->body = '<p><span style="font-size: 36px;">Majors and Minors</span></p><p><span style="font-size: 18px;">With 56 majors and 35 minors, Colby offers the ideal liberal arts and sciences environment: the variety you need for wide exploration and the depth you need to focus in your area (or areas) of interest. Along the way you&rsquo;ll gain the tools and experience to master any profession and adapt to any circumstance. Heading for a career in medicine, law, or engineering? We have the courses and advising to get you ready&mdash;while ensuring you graduate with the liberal arts and sciences knowledge and skill set that will make you a better doctor, attorney, or engineer.</span></p><p><br></p><p><iframe src="https://player.vimeo.com/video/304697352" width="620" height="349" frameborder="0" allowfullscreen=""></iframe></p><p><br></p><p><span style="font-size: 36px;">Our Professors</span></p><p><span style="font-size: 18px;">They&rsquo;re world-class scholars and teachers who dive deeply into major issues facing our world. From research assistantships and independent study projects, to summer experiences and excursions abroad, they view collaboration with students as essential to the work they do. What&rsquo;s more, students who work with professors often become co-authors of books, articles, and papers, and travel to national and international conferences, all before they receive a degree.</span></p><p><span style="font-size: 36px;">Jan Plan</span></p><p><span style="font-size: 18px;">At Colby you&rsquo;ll spend January doing just one thing of your choosing. Our innovative winter term is about exploration, expansion, freedom, and the chance to really focus. Do research in Belize. Shadow an oncologist at a local hospital. Take an internship in Miami. Become an EMT. Make a movie. Follow your fascination. Try something entirely new. Whatever it is, spend January in motion.</span></p>';
        $page->published = 1;
        $page->save();

        $page = new Page;
        $page->user_id = 1;
        $page->title = "FormStack Page";
        $page->slug = "form/page";
        $page->body = '<script type="text/javascript" src="https://colbycollege.formstack.com/forms/js.php/test_form"></script>
        <noscript><a href="https://colbycollege.formstack.com/forms/test_form" title="Online Form">Online Form - Test Form</a></noscript>
        <div style="text-align:right; font-size:x-small;"><a href="http://www.formstack.com?utm_source=jsembed&utm_medium=product&utm_campaign=product+branding&fa=h,3711922" title="Powered by Formstack">Powered by Formstack</a></div>';
        $page->published = 1;
        $page->save();
    }
}
