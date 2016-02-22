<div class="container">
	<div class="row">
		<div class="row center">
			<form action="save" method="GET" >
				<a  class="modal-trigger btn-floating btn-large waves-effect waves-light red" href="#add">
					<i class="material-icons">add</i>
				</a>
				<button type="submit"  class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">save</i></button>
			</div>
			<ul class="collapsible popout" data-collapsible="accordion"  >
				<?php foreach ($this->content['todo'] as  $i): ?>
					<li>
						<div class="collapsible-header" >
							<input type="checkbox" class="strikethrough" name="id[]"  value="<?= $i['id'];?>" id="<?= $i['id'];?>" />
							<label for="<?= $i['id'];?>"><h6><?= $i['title'];?></h6></label>
						</div>
						<div class="collapsible-body">
							<p><?= $i['description'];?>
								<a class="modal-trigger btn-floating btn right waves-effect waves-light red" href="delete?id=<?= $i['id'];?>">
									<i class="large material-icons">delete</i>
								</a>
								<a class="modal-trigger btn-floating btn right waves-effect waves-light red" href="#edit<?= $i['id'];?>">
									<i class="large material-icons">mode_edit</i>
								</a>
							</p>
						</div>
					</li>
				<?php endforeach;?>	
			</ul>
		</form>
		<?php foreach ($this->content['todo_edit'] as  $i): ?>
			<div id="edit<?= $i['id'];?>" class="modal modal">
				<div class="modal-content">
					<div class="row">
						<form class="col s12" action="edit?id=<?= $i['id'];?>">
							<input id="id" type="hidden" name="id" value="<?= $i['id'];  ?>"> 
							<div class="row">
								<div class="input-field col s6">
									<input id="title" type="text" length="32" name="title" value="<?= $i['title'];  ?>" required> 
									<label for="title">Title</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<textarea id="description" class="materialize-textarea" length="120" name="description" required><?= $i['description'];  ?></textarea>
									<label for="description">Description</label>
								</div>
							</div>
							<button type="submit" class="btn waves-effect waves-light" value="Edit"/><i class="material-icons right">edit</i> </button>
							<a href="#!" class=" modal-action modal-close btn waves-effect waves-light"><i class="material-icons right">not_interested</i></a>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach;?>	
		<div id="add" class="modal modal">
			<div class="modal-content">
				<div class="row">
					<form class="col s12" method="post" action="add">
						<div class="row">
							<div class="input-field col s6">
								<input id="title" name="title" type="text" length="32" required>
								<label for="title">Title</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea id="description" name="description" class="materialize-textarea" length="120" required></textarea>
								<label for="description">Description</label>
							</div>
						</div>
						<button type="submit" class="btn waves-effect waves-light" ><i class="material-icons right">add</i> </button>
						<a href="#!" class=" modal-action modal-close btn waves-effect waves-light"><i class="material-icons right">not_interested</i></a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>