<main class="todo-content">
	<div class="container">
		<div class="row">
			<?php
			isset($this->content['template'])
			? include 'tpl/' . $this->content['template']
			:  $this->content['images'];
			?>
		</div>
	</div>
</main>