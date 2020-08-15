<?php 
	$action = 'recoverPendingTasks';
	require 'task_controller.php';

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<script>
			function edit(id, text_desc)
			{
				let form = document.createElement('form');
				form.action = 'task_controller.php?pag=index&action=update'
				form.method = 'post'
				form.className = 'row'

				let inputText = document.createElement('input');
				inputText.type = 'text'
				inputText.className = 'form-control col-9'
				inputText.name = 'task'
				inputText.value = text_desc

				let button = document.createElement('button');
				button.type = 'submit'
				button.className = 'btn btn-info col-3'
				button.innerHTML = 'Atualizar'

				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id
				// 
				form.appendChild(inputText)
				form.appendChild(button)
				form.appendChild(inputId)

				// alert(text_desc)

				let task = document.getElementById('task_'+id)

				task.innerHTML = ''

				task.insertBefore(form, task[0])
			}

			function remove(id)
			{
				location.href = "index.php?pag=index&action=remove&id="+id
			}

			function check(id)
			{
				location.href = "index.php?pag=index&action=check&id="+id
			}
		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<?php  foreach($tasks as $index => $value) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id="task_<?php echo $value->id ?>">
										<?php echo $value->tarefa ?> 
										</div>
											<div class="col-sm-3 mt-2 d-flex justify-content-between">
												<i class="fas fa-trash-alt fa-lg text-danger" onclick="remove(<?=$value->id ?>)"></i>
												
												<i class="fas fa-edit fa-lg text-info" onclick="edit(<?=$value->id ?>, '<?=$value->tarefa?>')"></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="check(<?=$value->id ?>)"></i>
												
											</div>
									</div>
								<?php  };?>		

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>