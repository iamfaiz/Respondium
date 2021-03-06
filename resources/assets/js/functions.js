function makeCommentFormFunctional()
{
	$('#comment_form').on('submit', function(e) {
		e.preventDefault();

		var $form = $(this);

		var $comments = $('#comments');

		var data = $form.serialize();

		$form.find('textarea').val('');

		var template = $('#comment_template').html();

		$.ajax({
			method: 'post',
			url: '/comments',
			data: data,
			success: function(data) {
				var output = Mustache.render(template, data);
				$comments.append(output);
				$('.created-at-timeago').timeago();
			}
		});
	});
}

function implementSelect2Library()
{
	$('select#tags_select_box').select2();
}

function makeVotesFormFunctional()
{
	$('#upvote_form').on('submit', function(e) {
		e.preventDefault();

		$this = $(this);

		var data = $this.serialize();

		$.ajax({
			url: '/votes',
			method: 'post',
			data: data
		});
	});

	$('#downvote_form').on('submit', function(e) {
		e.preventDefault();

		$this = $(this);

		var data = $this.serialize();

		$.ajax({
			url: '/votes',
			method: 'post',
			data: data
		});
	});
}

function makeAnswersFormFunctional()
{
	$('#answer_form').on('submit', function(e) {
		e.preventDefault();

		$this = $(this);

		var data = $this.serialize();

		$.ajax({
			url: '/answers',
			method: 'post',
			data: data,
			success: function(answer) {
				window.location.reload();
			}
		});
	});
}

function makeAnswersCommentsFormFunctional()
{
	$('.answer_comment_form').on('submit', function(e) {
		e.preventDefault();

		var $this = $(this);

		var data = $this.serialize();

		$.ajax({
			url: '/comments/answer',
			method: 'post',
			data: data,
			success: function(data) {
				$this.find('textarea').val('');
			}
		});
	});
}

function deleteRequestWithLinks()
{
	$('a[data-method=delete]').on('click', function(event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr('href'),
			method: 'DELETE'
		});

		window.location.reload();
	});
}

function questionSearchForm()
{
	$('#questions_search_form').on('submit', function(e) {
		e.preventDefault();

		var searchQuery = $(this).find('input[type=search]').val();

		window.location.href = '/questions/search/' + searchQuery;
	});
}