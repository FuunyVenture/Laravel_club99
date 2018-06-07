<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'About Us',
                'slug' => 'about-us',
                'meta_keywords' => '',
                'meta_desc' => '',
                'content' => '<div class="col-md-4">
<p>This is a Sample Content Page.</p>

<p>&nbsp;</p>

<p><img alt="The Amazing Product" src="http://placehold.it/300x250" /></p>
</div>

<div class="col-md-8">
<p>The best package for lorem ipsumer</p>

<p>Mustache farm-to-table deep v cardigan, Banksy Godard roof party PBR&amp;B.</p>

<ul>
<li>Details</li>
<li>Lorem ipsum</li>
<li>Nostrud exercitation</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
</ul>
</div>
',
                'icon' => '',
                'published' => 1,
                'published_at' => '2016-03-31 09:32:17',
                'blog_post' => 0,
                'created_at' => '2016-03-31 09:24:42',
                'updated_at' => '2016-03-31 09:32:17',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Sample Blog',
                'slug' => 'sample-blog',
                'meta_keywords' => '',
                'meta_desc' => '',
                'content' => '<div class="col-md-4">
<p>This is a Sample Content Page.</p>

<p>&nbsp;</p>

<p><img alt="The Amazing Product" src="http://placehold.it/300x250" /></p>
</div>

<div class="col-md-8">
<p>The best package for lorem ipsumer</p>

<p>Mustache farm-to-table deep v cardigan, Banksy Godard roof party PBR&amp;B.</p>

<ul>
<li>Details</li>
<li>Lorem ipsum</li>
<li>Nostrud exercitation</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
</ul>
</div>
',
                'icon' => '',
                'published' => 1,
                'published_at' => '2016-03-31 09:32:17',
                'blog_post' => 1,
                'created_at' => '2016-03-31 09:24:42',
                'updated_at' => '2016-03-31 09:32:17',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Sample Blog 2',
                'slug' => 'sample-blog-2',
                'meta_keywords' => '',
                'meta_desc' => '',
                'content' => '<div class="col-md-4">
<p>This is a Sample Content Page.</p>

<p>&nbsp;</p>

<p><img alt="The Amazing Product" src="http://placehold.it/300x250" /></p>
</div>

<div class="col-md-8">
<p>The best package for lorem ipsumer</p>

<p>Mustache farm-to-table deep v cardigan, Banksy Godard roof party PBR&amp;B.</p>

<ul>
<li>Details</li>
<li>Lorem ipsum</li>
<li>Nostrud exercitation</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
</ul>
</div>
',
                'icon' => '',
                'published' => 1,
                'published_at' => '2016-03-31 09:32:17',
                'blog_post' => 1,
                'created_at' => '2016-03-31 09:24:42',
                'updated_at' => '2016-03-31 09:32:17',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Sample Blog 3',
                'slug' => 'sample-blog-3',
                'meta_keywords' => '',
                'meta_desc' => '',
                'content' => '<div class="col-md-4">
<p>This is a Sample Content Page.</p>

<p>&nbsp;</p>

<p><img alt="The Amazing Product" src="http://placehold.it/300x250" /></p>
</div>

<div class="col-md-8">
<p>The best package for lorem ipsumer</p>

<p>Mustache farm-to-table deep v cardigan, Banksy Godard roof party PBR&amp;B.</p>

<ul>
<li>Details</li>
<li>Lorem ipsum</li>
<li>Nostrud exercitation</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
</ul>
</div>
',
                'icon' => '',
                'published' => 1,
                'published_at' => '2016-03-31 09:32:17',
                'blog_post' => 1,
                'created_at' => '2016-03-31 09:24:42',
                'updated_at' => '2016-03-31 09:32:17',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Sample Blog 4',
                'slug' => 'sample-blog-4',
                'meta_keywords' => '',
                'meta_desc' => '',
                'content' => '<div class="col-md-4">
<p>This is a Sample Content Page.</p>

<p>&nbsp;</p>

<p><img alt="The Amazing Product" src="http://placehold.it/300x250" /></p>
</div>

<div class="col-md-8">
<p>The best package for lorem ipsumer</p>

<p>Mustache farm-to-table deep v cardigan, Banksy Godard roof party PBR&amp;B.</p>

<ul>
<li>Details</li>
<li>Lorem ipsum</li>
<li>Nostrud exercitation</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
<li>Resources ipsum</li>
<li>Adipiscit resource</li>
<li>Resource numquam</li>
</ul>
</div>
',
                'icon' => '',
                'published' => 1,
                'published_at' => '2016-03-31 09:32:17',
                'blog_post' => 1,
                'created_at' => '2016-03-31 09:24:42',
                'updated_at' => '2016-03-31 09:32:17',
            ),
        ));
        
        
    }
}
