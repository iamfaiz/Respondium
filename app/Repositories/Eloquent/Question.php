<?php

namespace App\Repositories\Eloquent;

use App\Tag;
use App\Vote;
use App\Post;
use App\View;
use App\PostTagPivot;
use App\Repositories\QuestionInterface;

class Question implements QuestionInterface
{
	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function getMainFeed()
	{
		return $this->post->latest()->paginate(10);
	}

	public function getForTag($tagName)
	{
		$tagId = Tag::where('name', $tagName)->firstOrFail()->id;

		$postIds = PostTagPivot::where('tag_id', $tagId)->get()->lists('post_id')->toArray();

		return $this->post->whereIn('id', $postIds)->latest()->paginate(10);
	}

	public function getBySlug($slug)
	{
		return $this->post->where('slug', $slug)->with('comments')->with([
			'answers' => function($query) {
			 	$query->with('comments');
			}
		])->firstOrFail();
	}

	public function getVotesFor($postId)
	{
		$upvotes = Vote::where('post_id', $postId)->where('type', 'upvote')->get()->count();

		$downvotes = Vote::where('post_id', $postId)->where('type', 'downvote')->get()->count();

		return $upvotes - $downvotes;
	}

	public function findByIds($ids)
	{
		return $this->post->whereIn('id', $ids)->latest()->paginate(10);
	}

	public function updateBySlug($slug, $updates=[])
	{
		$question = $this->post->where('slug', $slug)->firstOrFail();

		$question->title = $updates['title'];

		$question->description = $updates['description'];

		$question->tags()->sync($updates['tags']);

		$question->save();

		return $question;
	}
}
