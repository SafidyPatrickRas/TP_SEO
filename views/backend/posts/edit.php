<div class="page-header">
	<div>
		<h2 class="page-title">Modifier l'article</h2>
		<p class="page-meta">Mettez a jour le contenu et le statut.</p>
	</div>
</div>

<form action="/admin/articles/<?=(int)$post['id']?>" class="card form-card" method="post" id="post-form">
	<div class="form-field">
		<label for="title">Titre</label>
		<input class="form-input" id="title" name="title" required value="<?=htmlspecialchars($post['title'])?>">
	</div>
	<div class="form-field">
		<label for="content">Contenu</label>
		<textarea class="form-textarea" id="content" name="content" rows="8"><?=htmlspecialchars($post['content'])?></textarea>
	</div>
	<div class="form-field">
		<label for="status">Statut</label>
		<select class="form-select" id="status" name="status">
			<option value="draft"<?=$post['status']==='draft'?'selected':''?>>Brouillon</option>
			<option value="published"<?=$post['status']==='published'?'selected':''?>>Publie</option>
		</select>
	</div>
	<button class="btn btn-primary" type="submit">Mettre a jour</button>
</form>

<script src="https://cdn.tiny.cloud/1/cg9ppftk6e2vvgi45f55g3j2dlmnhhs5mcmi7zz4fqt03cih/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
	tinymce.init({
		selector: '#content',
		height: 500,
		plugins: [
			'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
			'preview', 'anchor', 'searchreplace', 'visualblocks',
			'code', 'fullscreen', 'insertdatetime', 'media', 'table'
		],
		toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | code',
		setup: (editor) => {
			editor.on('change', () => editor.save());
		}
	});

	const form = document.getElementById('post-form');
	if (form) {
		form.addEventListener('submit', (event) => {
			tinymce.triggerSave();
			const editor = tinymce.get('content');
			const content = editor ? editor.getContent({ format: 'text' }).trim() : '';
			if (!content) {
				event.preventDefault();
				alert('Veuillez saisir le contenu de l\'article.');
				if (editor) {
					editor.focus();
				}
			}
		});
	}
</script>