@inject('auth', 'Illuminate\Contracts\Auth\Guard')
@inject('videoGenerator', 'App\HtmlGenerators\AnswerVideo')

<div class="row single-question">
	<div class="col-md-12">
		<h1 class="page-header">{{ $question->title }}</h1>
		<p>{!! Markdown::parse($question->description); !!}</p>
		@if($question->video_url)
			{!! $videoGenerator->generate($question->video_url) !!}
		@endif

		<div class="links-bar">
					<form method="post" action="/questions/{{ $question->slug }}">
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="DELETE">

						<button class="btn btn-danger btn-sm" href="/questions/{{ $question->slug }}/delete">Delete</button>
					</form>

			@if ($auth->check())
				@if ($auth->user()->id === $question->user->id)
					<a class="btn btn-primary btn-sm" href="/questions/{{ $question->slug }}/edit">Edit</a>
					<form method="post" action="/questions/{{ $question->slug }}">
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="DELETE">

						<button class="btn btn-danger btn-sm" href="/questions/{{ $question->slug }}/delete">Delete</button>
					</form>
				@endif
			@endif
		</div>
	</div>
</div>
