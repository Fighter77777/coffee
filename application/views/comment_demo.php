
<div id="content">
	<div id = "comment-area">
		<? foreach ($comments as $comment):?>
			<div class ="comment" id="comment_<?=$comment['id'];?>">
				<div class = "top">	
					<span class ="name">
						<?=$comment['name']?>
					</span>
					<span class ="date">
						<?=$comment['date_create']?>
					</span>
					<span class="delete">
						<a  href="" id="deleteComment" data-id="<?=$comment['id'];?>">delete comment</a>
					</span>
				</div>
				<div class="text">
					<?=$comment['comment']?>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<form id="comment_form" action method="post">
		<label for="comment_area">Добавить комментарий</label>
		<textarea name="comment_area" id="comment_area" rows="5" cols="70"></textarea>
		<input type="hidden" name="task_id" value="<?=$task_id?>"/>
		<button type="submit">Опубликовать</button>
	</form>
</div>


<style type="text/css">
	textarea{
		display: block;

	}
	
	.comment{
		padding-bottom: 10px;
	}
	#content{
		padding-top: 70px;
		padding-left: 10px;
	}

	#content a {
		color:red;
	}

</style>