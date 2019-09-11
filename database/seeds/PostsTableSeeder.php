<?php

use App\Tag;
use App\Category;
use App\Posts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'Marketing'
        ]);

        $author1 = App\User::create([
            'name' => 'gokil',
            'email' => 'gokil@oke.com',
            'password' => Hash::make('password')
        ]);

        $author2 = App\User::create([
            'name' => 'potato',
            'email' => 'potato@oke.com',
            'password' => Hash::make('password')
        ]);

        $category2 = Category::create([
            'name' => 'News'
        ]);

        $category3 = Category::create([
            'name' => 'Programming'
        ]);

        $post1 = Posts::create([
            'title' => 'we are family',
            'description' => 'Lorem Ipsum',
            'content' => 'Lorem Ipsum is simply',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Seorang Pria Sedang Main Air',
            'description' => 'Seorang pria main air di tengan jalan',
            'content' => 'Seorang pria main air di tengah jalan direkam dan warga selesai',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);
        $post3 = $author1->posts()->create([
            'title' => 'Python',
            'description' => 'Python is Programming',
            'content' => 'Python adalah bahasa pemrograman interpretatif multiguna dengan filosofi perancangan yang berfokus pada tingkat keterbacaan kode',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
        ]);

        $tag1 = Tag::create([
            'name' => 'Programmer'
        ]);
        $tag2 = Tag::create([
            'name' => 'job'
        ]);
        $tag3 = Tag::create([
            'name' => 'record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
